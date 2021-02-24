<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Nama_Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

class ApiControl extends Controller
{
    // protected $userTable;
    //     function __construct() 
    //     {
    //         $this->userTable = new Nama_Barang;
    //     }


        public function upload(Request $req) 
        {
            $date = Date('Y-m-d-His');
            $img = $req->file('image');
            $ext =  $img->extension();
            $fileName = $date.'.'.$ext;
            $path = $req->file('image')->move(public_path("docs_api"), $fileName);
            $barang  = new Nama_Barang;
            $barang->image = $fileName ;
            $barang->kode_barang = $req->kode_barang ;
            $barang->nama_barang = $req->nama_barang ;
            $barang->stock = $req->stock;
            $barang->deskripsi = $req->deskripsi;
            
            $photoUrl = url('/'.$fileName);

            $status = $barang->save();

            if($status){
                $isSuccess = true;
                $message = "Berhasil Menambah Barang";
                $response_status = 200;
                $data = $barang;
            }
            else{
            $isSuccess = false;
            $message = "Gagal Menambah Barang";
            $response_status = 404;
            $data = null;
            }

            

            return response()->json(
                    [
                        'isSuccess' => $isSuccess,
                        'status' => $response_status,
                        'message' => $message,
                        'data' => $data

                    ], 200);
        }
        public function getProduk(Request $request) {
            $data = Nama_Barang::orderBy('id', 'DESC')->get();
            $isSuccess = true;
            $response_status = 200; 
            $message = "Berhasil Mendapat Produk";

        if (empty($data)) {
            $isSuccess = false;
            $response_status = 404;
            $message = "Tidak ada data untuk ditampilkan !";

        }
        return response()->json(compact('isSuccess', 'response_status', 'message', 'data'));
        }

        public function searchProduk(Request $request) 
        {
            $keyword = $request->q;
            $data = Nama_Barang::where('nama_barang', 'LIKE', '%'.$keyword.'%')
                                ->orWhere('kode_barang', 'LIKE', '%'.$keyword.'%')
                                ->get();
            if(!empty($data)) {
                $isSuccess = true;
                $response_status = 200;
                $message = "Berhasil mendapatkan produk";
            } else {
                $isSuccess = false;
                $response_status = 200;
                $message = "Gagal mendapat Data";
            }
            $data = $data;
            return response()->json(compact('isSuccess', 'response_status', 'message', 'data'));
        }

        public function deleteProduk(Request $r) 
        {
            $data = Nama_Barang::where('id', $r->id )->delete();

            if($data)  {
            $isSuccess = true;
            $message = "Berhasil dihapus";
            $response_status = 200;
        }
        else {
            $isSuccess = false;
            $message = "Gagal dihapus";
            $response_status = 404;
        }
        return response()->json(compact('isSuccess', 'message', 'response_status'));
        }

        public function editProduk(Request $request, $id) 

        {

            $data = Nama_Barang::find($id);
            $input = $request->all();
            // $isSuccess = false;
            // $message = "Gagal update";
            // $updateData = null;

            if(!empty($data)) {
            $kodebarang = $request->kode_barang;
            $namabarang = $request->nama_barang;
            $stock = $request->stock;
            $deskripsi = $request->deskripsi;
            
                try {
                    $updateData = $data->update([
                        'kodebarang'=>$kodebarang,
                        'namabarang'=>$namabarang, 
                        'stock'=>$stock,
                        'deskripsi'=>$deskripsi
                        ]);
                } catch (\Exception $e) {
                    $errorCode = $e->getMessage();
                // if($errorCode == 1062) {
                    $isSuccess = false;
                    $message =  $errorCode;
                    $data = null;
                
                    //throw $th;
                }
                if($updateData) {
                    $isSuccess = true;
                    $message = "Berhasil Update";
                    $data = Nama_Barang::find($data->id);
                }
            }
            return response()->json(compact('isSuccess',  'message', 'data'));
        }

        
    }
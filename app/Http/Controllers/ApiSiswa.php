<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiSiswa extends Controller
{
    public function addSiswa(Request $request) 
    {
        $input = $request->all();
        $save = Siswa::create($input)->save();

        // $status = $siswa->save();


        if($save) {
                $isSuccess = true;
                $message = "Berhasil Menambah siswa";
                $response_status = 200;
                $data = $save;
        }else {
                $isSuccess = false;
                $message = "Berhasil Menambah siswa";
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

    public function getSiswa(Request $request) 
    {
            $data = Siswa::orderBy('id', 'DESC')->get();
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

    public function searchSiswa(Request $request) 
    {
        $searchProduk = $request->searchProduk; 
        $data = Siswa::where('NIK', 'LIKE', '%'.$searchProduk.'%')  
                    ->orWhere('Nama', 'LIKE', '%'.$searchProduk.'%')
                    ->get();

        if(!empty($data)) 
        {
            $isSuccess = true;
            $message   = "Berhasil mencari data siswa";
            $response_status = 200;
        }else{
            $isSuccess = false;
            $message = "Gagal mencari data siswa";
            $response_status = 404;
        }
        // $searchProduk = $data;

        return response()->json(compact('isSuccess', 'response_status', 'message', 'data'));
    }

    public function deleteSiswa(Request $request) 
    {
        $data = Siswa::where('id', $request->id )->delete();

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

    public function editSiswa(Request $request) 
    {
        // $input = $request->all();
        $input = Siswa::find($request->id);

        if(!empty($input)) {
            $nik = $request->NIK;
            $nama = $request->Nama;
            $alamat = $request->Alamat;
            $nohp = $request->No_hp;

            // $halo = "rafi";

            try {
                // $update = $input->update(compact('nik', 'halo', 'alamat', 'nohp'));
//         'NIK', 
//         'Nama', 
//         'Alamat', 
//         'No_hp'
                $update = $input->update([
                    'NIK' => $nik , 
                    'Nama' => $nama, 
                    'Alamat' => $alamat, 
                    'No_hp' => $nohp
                    ]);

                if ($update) {
                $isSuccess = true;
                $message = "Data siswa berhasil diubah";
                $input = Siswa::find($input->id);
            }
            } catch (\Exception $e) {
                $errorCode = $e->getMessage();
                // if($errorCode == 1062) {
                    $isSuccess = false;
                    $message = $errorCode;
                    $input = null;
                // }
            
            }

            return response()->json(compact('isSuccess',  'message', 'input'));
        }
    }
}

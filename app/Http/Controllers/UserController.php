<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function tambahUser (Request $request) 
    {
        try{
            $request->validate([
                'nama' => ["required","String", "max:255"],
                'alamat' =>["required","String", "max:255"],
                'jenis_kelamin' => ["required","String", "max:255"],
                'hobi' => ["required","String", "max:255"],
                'agama' => ["required","String", "max:255"],
            ]);
                $input = $request ->all();
                $save = User1::create($input)->save();
                $isSuccess = true;
                $message = "Berhasil Menambah user";
                $response_status = 200;
                $data = $save;
                
        }catch(Exception $error){
                $isSuccess = false;
                $message = $error;
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
        // $input = $request ->all();
        // $save = User1::create($input)->save();

        // if($save) {
        //         $isSuccess = true;
        //         $message = "Berhasil Menambah siswa";
        //         $response_status = 200;
        //         $data = $save;
        // }else {
        //         $isSuccess = false;
        //         $message = "Berhasil Menambah siswa";
        //         $response_status = 404;
        //         $data = null;
        // }

        // return response()->json(
        //             [
        //                 'isSuccess' => $isSuccess,
        //                 'status' => $response_status,
        //                 'message' => $message,
        //                 'data' => $data

        //             ], 200);
    }
    public function updateUser(Request $request) 
    {
        $input = User1::find($request->id);
        if (!empty($input)) {
            $nama = $request->nama;
            $alamat = $request->alamat;
            $jeniskelamin = $request->jenis_kelamin;
            $hobi = $request->hobi;
            $agama = $request->agama;

            try {
                $update = $input->update([
                    'nama'=> $nama,
                    'alamat' => $alamat,
                    'jenis_kelamin' => $jeniskelamin,
                    'hobi' => $hobi,
                    'agama' => $agama
                ]);

                if ($update) {
                    $isSuccess = true;
                    $message = "Data User telah diperbarui";
                    $input = User1::find($input->id);
                }

            } catch (\Exception $e) {
                $errorcode = $e->getMessage();
                    $isSuccess = false;
                    $message = $errorCode;
                    $input = null;
            }

            return response()->json(compact('isSuccess',  'message', 'input'));
        }
        
    }

    public function getUser(Request $request)
    {
        $data = User1::orderBy('id', 'DESC')->get();
        $isSuccess = true;
        $response_status = 200;
        $message = "Berhasil mendapat User";

        if(empty($data)){
            $isSuccess = false;
            $response_status = 404;
            $message = "Tidak ada data untuk ditampilkan !";
        }
        return response()->json(compact('isSuccess', 'response_status', 'message', 'data'));
    }
    


}
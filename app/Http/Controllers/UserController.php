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
                $message = "Berhasil Menambah siswa";
                $response_status = 200;
                $data = $save;
                return response()->json(
                    [
                        'isSuccess' => $isSuccess,
                        'status' => $response_status,
                        'message' => $message,
                        'data' => $data

                    ], 200);
        }catch(Exception $error){
                $isSuccess = false;
                $message = $error;
                $response_status = 404;
                $data = null;
        }
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


}
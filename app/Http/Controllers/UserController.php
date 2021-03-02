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
        $input = $request ->all();
        $save = User1::create($input)->save();

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
}

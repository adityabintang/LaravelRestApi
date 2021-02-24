<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{

    public $status_noauth = 401;

    // protected $usertable;
    // function __construct()
    // {
    //     $this->usertable = new User;
    // }

    //function untuk menambah data 
        // public function addData(Request $request)
        // {
        //     $user = new User;
        //     $name = $request->name;
        //     $email =  $request->email;

        //     $isSuccess = false;
        //     $message = "Gagal menambah data!";
        //     $data = null;
        //     $response_status = 200;
        //     $create = null;

        // try {
        //     //memasukkan data ke table
        //     $create = $user->create(compact('name', 'email'));
        // } catch (\Exception $e) {
        //     $errorCode = $e->errorInfo[1];
        //         if($errorCode == 1062){
        //             $isSuccess = false;
        //             $message = "Email telah terdaftar";
        //             $data = null;
        //         }
        // }
        // if (!is_null($create)) {
        //     $isSuccess = true;
        //     $message = "Berhasil menambah data";
        //     $data = $create;
        // }
        // return response()->json(compact('isSuccess', 'response_status', 'message'));
        // }

        public function login()
    {
        if (Auth::attempt(['email' => request('email') , 'password' => request('password') ]))
        {
            
            // $user = Auth::guard('user')->user();

            // if ($user) {
            //    $this->isSuccess = true;                
                            // $this->message = "Login success"200

                $isSuccess = true;
                $status = 200;
                $message = "Berhasil login";

                return response()->json(
                    [
                        'isSuccess' => $isSuccess,
                        'status' => $status,
                        'message' => $message,

                    ], 200);

            // return response()->json(json('isSuccess','response_status', 'message', 'data'));
                            // $this->data = $data;
            //                 return $this->commitResponseJson();
            // } else {
            //     $this->isSuccess = false;                
            //                 $this->message = "Login failed";
            //                 $this->data = $data;
            //                 return $this->commitResponseJson();
            // }
            
            //get data company
            // $data = User::where('id',$user->id)->first();
            
            // if($user->payment_status == "PAID"){
                
            //     if($user->user_status == "ACCEPTED"){
                
            //         if($user->is_active == "YES"){
                        
            //             $dateExpired = new \DateTime($user->user_expired);
            //             $dateNow = new \DateTime(date('Y-m-d'));
                        
                        // if($dateExpired >= $dateNow){
                            // $data['token'] = $user->createToken('nApp')->accessToken;
                            // $data['company'] = $company->company_name;
                            // $data['user'] = $user;
                            
                        //     $this->isSuccess = true;                
                        //     $this->message = "Login success";
                        //     $this->data = $data;
                        //     return $this->commitResponseJson();
                        // // } else {
                        //     $this->isSuccess = false;                
                        //     $this->message = "Login failed, account expired";
                        //     return $this->commitResponseJson();
                        // }
                    
            //         } else {
            //             $this->isSuccess = false;                
            //             $this->message = "Login failed, account inactive";
            //             return $this->commitResponseJson();
            //         }
                    
            //     } else {
            //         $this->isSuccess = false;                
            //         $this->message = "Login failed, account status pending";
            //         return $this->commitResponseJson();
            //     }
                
            // } else {
            //     $this->isSuccess = false;                
            //     $this->message = "Login failed, account not subscribed yet";
            //     return $this->commitResponseJson();
            // }
    
        }
        else
        {
            // return response()
            //     ->json(['error' => 'Unauthorised'], 401);

                return response()->json(
                    [
                        'isSuccess' => false,
                        'status' => 401,
                        'message' => 'Email atau password salah'

                    ], 401);
        }
    }

        //daftar data
        public function register(Request $request)
        {
        // $validator = User::make($request->all() , ['user_name' => 'required', 'user_email' => 'required|email', 'user_password' => 'required', 'c_password' => 'required|same:user_password', ]);

        // if ($validator->fails())
        // {
        //     return response()
        //         ->json(['error' => $validator->errors() ], 401);
        // }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        
        $token = Str::random(60);

        // return response()->json($data);

        if ($user){
            $isSuccess = true;
            $status = 200;
            $message = "Berhasil register";
            $data = $user;
        } else {
            $isSuccess = false;
            $status = 200;
            $message = "Gagal register";
            $data = null;
        }

        return response()->json(
                    [
                        'isSuccess' => $isSuccess,
                        'status' => $status,
                        'message' => $message,
                        'data' => $data

                    ], 200);

        
    }

        //menampilkan data
        public function getData(Request $request)
        {
            $data = User::orderBy('id', 'DESC')->get();
                $isSuccess = true;
                $response_status = 200;
                $message = "Berhasil mendapatkan data";

            if(empty($data)) {
                $isSuccess = false;
                $response_status = 404;
                $message = "Tidak ada data untuk ditampilkan !";
            }

            return response()->json(compact('isSuccess', 'message', 'data'));
        }

        //fitur search untuk mencari data diapilkasi android
        public function searchData(Request $request) 
        {
            $keyword = $request->q;
            $data = User::where('name', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('email', 'LIKE', '%'.$keyword.'%')
                    ->get();
            if(!empty($data)) {
                $isSuccess = true;
                $response_status = 200;
                $message = "Berhasil mendapatkan data";
            } else {
                $isSuccess = false;
                $response_status = 200;
                $message = "Gagal mendapatkan data";
            }
            $data = $data;


            return response()->json(compact('isSuccess', 'response_status', 'message', 'data'));
        }

        //menghapus data
        public function deleteData(Request $r)
        {
            // $data = User::find($request->id);

            $data = User::where('id', $r ->id)->delete();

        if($data) {
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

        //Edit Data
        public function editData(Request $request)
        {
            $data = User::find($request->id);
            $isSuccess = false;
            $message = "Gagal update";
            $updateData = null;

            if(!empty($data)) {
                $name = $request->name;
                $email = $request->email;


                try {
                    $updateData = $data->update(compact('name', 'email'));
                } catch (\Exception $e) {
                    $errorCode = $e->errorInfo[1];
                if($errorCode == 1062) {
                    $isSuccess = false;
                    $message = "Email telah terdaftar, silahkan untuk menggunakan email lain.";
                    $data = null;
                }
                    //throw $th;
                }
                if($updateData) {
                    $isSuccess = true;
                    $message = "Berhasil Update";
                    $data = User::find($data->id);
                }
            }
            return response()->json(compact('isSuccess',  'message', 'data'));
        }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validate = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Username dan password wajib diisi',
                'content' => null,
            ];
            return response()->json($respon, 200);
        } else {
            $user = User::where('email', $request->email)->first();
            if($user==null){
                $respon = [
                    'status' => 'error',
                    'msg' => 'Username atau password salah',
                    'content' => null,
                ];
                return response()->json($respon, 200);
            }
            else{
                if (!\Hash::check($request->password, $user->password, [])) {
                    $respon = [
                        'status' => 'error',
                        'msg' => 'Username atau password salah',
                        'content' => null,
                    ];
                    return response()->json($respon, 200);
                }
            }

            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = [
                'status' => 'success',
                'msg' => 'Login successfully',
                'content' => [
                    'status_code' => 200,
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'user_id' => $user->id,
                ]
            ];
            return response()->json($respon, 200);
        }
    }  
}

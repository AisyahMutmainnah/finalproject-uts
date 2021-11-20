<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        /**
         * fitur register
         * ambil input name, email, dan password
         * input data nya ke database menggunnakan User Model
         */

        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)              //$request->password ini sblum nya sprti ini tetapi untuk melindungi pass maka mnenggunakan hashing
        ];

        $user = User::create($input);

        $data = [
            'message' => 'Register id successfully'
        ];

        return response()->json($data, 200);
    }

    public function login(Request $request)
    {
        /**
         * fitur login
         * ambil input email dan password dari user
         * ambil input email dan password dari database berdasarkan email
         * bandingkan data input user dan data dari database
         */

        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = User::where('email', $input['email'])->first();

        //ini kita bandingkan apakah email user sama dengan email database
        //dan apakah password yg diipnut user sama dengan password yang dari database
        if ($input['email'] = $user->email && Hash::check($input['password'], $user->password)) {
            $token = $user->createToken('auth_token');

            $data = [
                'message' => 'Login is successfully',
                'token' => $token->plainTextToken
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Login id invalid'
            ];

            return response()->json($data, 401);
        }
    }
}

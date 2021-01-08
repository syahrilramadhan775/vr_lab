<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ErrorResources;
use App\Http\Resources\User\LoginResources;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $pass_hash = Hash::make($password);

        if (Hash::check($password, $pass_hash)) {
            $user_logins = User::where('username', $username)
                ->first();
        }

        if ($user_logins) {
            return new LoginResources($user_logins);
        } else {
            return new ErrorResources($user_logins);
        }
    }

    // public function login(Request $request)
    // {
    //     $username = $request->username;
    //     $password = $request->password;

    //     $passwordd = User::where('username', $username)
    //         ->first()->password;

    //     $user_logins = User::where('username', $username)
    //         ->first();
    //     if ($passwordd == $password) {

    //         return new LoginResources($user_logins);
    //     } else {
    //         return new ErrorResources($user_logins);
    //     }
    // }
}

<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ErrorResources;
use App\Http\Resources\User\LoginResources;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = User::where('username', $request->username)->first();
        $users = Auth::attempt(['username' => $request->username, 'password' => $request->password]);
        if (Auth::check($users == $user->password)) {
            if ($users) {
                return new LoginResources($user);
            }
        } else {
            return new ErrorResources($user);
        }
    }
}

<?php

namespace App\Http\Controllers\Backpack;

use Alert;
use App\Models\User;
use App\Http\Requests\AccountInfoRequest;
use App\Utils\UI;
use Backpack\CRUD\app\Http\Requests\ChangePasswordRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    /**
     * Show the user a form to change his personal information & password.
     */
    public function getAccountInfoForm()
    {
        $this->data['title'] = trans('backpack::base.my_account');
        $this->data['user'] = $this->guard()->user();
        $this->data['subscribe'] = $this->data['user']->UserSubcription->SubcriptionType->type;
        $this->data['theme'] = UI::subscribeColorTheme($this->data['subscribe']);

        return view(backpack_view('my_account'), $this->data);
    }

    /**
     * Save the modified personal information for a user.
     */
    public function postAccountInfoForm(AccountInfoRequest $request)
    {
        $userField = $request->only(['email', 'username']);
        $detailField = $request->only(['name', 'no_telp']);



        $user = $this->guard()->user()->update($userField);
        $userDetail = $this->guard()->user()->Detail()->update($detailField);

        if ($user && $userDetail) {
            Alert::success(trans('backpack::base.account_updated'))->flash();
        } else {
            Alert::error(trans('backpack::base.error_saving'))->flash();
        }

        return redirect()->back();
    }

    /**
     * Save the new password for a user.
     */
    public function postChangePasswordForm(ChangePasswordRequest $request)
    {
        /** @var User */
        $user = $this->guard()->user();
        $user->password = Hash::make($request->new_password);

        if ($user->save()) {
            Alert::success(trans('backpack::base.account_updated'))->flash();
        } else {
            Alert::error(trans('backpack::base.error_saving'))->flash();
        }

        return redirect()->back();
    }

    /**
     * Get the guard to be used for account manipulation.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return backpack_auth();
    }
}

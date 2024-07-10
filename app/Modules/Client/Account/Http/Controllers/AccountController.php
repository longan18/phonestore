<?php

namespace App\Modules\Client\Account\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Modules\Client\Account\Http\Requests\AccountLoginRequest;
use App\Modules\Client\Account\Http\Requests\AccountRegisterRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Client\Account\Http\Requests\AccountRequest;
use App\Modules\Client\Account\Http\Requests\ForgotPasswordRequest;
use App\Modules\Client\Account\Interfaces\AccountUserInterface;
use App\Modules\Client\Account\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

/**
 * @AccountController
 */
class AccountController extends Controller
{
    protected $account;

    /**
     * @param AccountUserInterface $account
     */
    public function __construct(AccountUserInterface $account)
    {
        $this->account = $account;
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function pageLogin()
    {
        return view('client.auth.login');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function pageRegister()
    {
        return view('client.auth.register');
    }

    public function forgotPassword()
    {
        return view('client.auth.forgot-password');
    }

    public function forgotPasswordSendEmail(ForgotPasswordRequest $request)
    {
        $result = $this->account->forgotPassword($request);
        $message = 'Thất bại. Hãy thử lại sau';
        if ($result) {
            $message = 'Đã gửi password mới về email. Vui lòng kiểm tra email!';
        }

        return redirect()->back()->with('status', $message);
    }

    /**
     * @param AccountRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(AccountRegisterRequest $request)
    {
        $result = $this->account->handle($request);
        $route = $result ? 'client.page-login' : 'client.page-register';

        return to_route($route)->with('status', $result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $result = $this->account->handle($request);
        return redirect()->back()->with('status', $result);
    }

    /**
     * @param AccountLoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(AccountLoginRequest $request)
    {
        $auth = $this->account->login($request);
        return $auth ? redirect()->route('client.home')
            : redirect()->back()->with('status', false);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->account->logout();
        return redirect()->back();
    }
}

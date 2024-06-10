<?php

namespace App\Modules\Client\Account\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Client\Account\Http\Requests\AccountLoginRequest;
use App\Modules\Client\Account\Http\Requests\AccountRegisterRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Client\Account\Http\Requests\AccountRequest;
use App\Modules\Client\Account\Interfaces\AccountUserInterface;
use App\Modules\Client\Account\Models\User;
use Illuminate\Support\Facades\Auth;

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
        Auth::guard(GUARD_WEB)->logout();
        return redirect()->back();
    }
}

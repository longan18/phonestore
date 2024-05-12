<?php

namespace App\Modules\Admin\Account\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Account\Http\Requests\LoginRequest;
use App\Modules\Admin\Account\Http\Requests\UpdatePasswordRequest;
use App\Modules\Admin\Account\Http\Requests\UpdateProfileRequest;
use App\Modules\Admin\Account\Interfaces\AccountAdminInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class AccountController
 *
 * @package App\Modules\Admin\Account\Http\Controllers
 */
class AccountController extends Controller
{
    protected AccountAdminInterface $accountAdminInterface;

    /**
     * AccountController constructor.
     *
     * @param AccountAdminInterface $accountAdminInterface
     */
    public function __construct(AccountAdminInterface $accountAdminInterface)
    {
        $this->accountAdminInterface = $accountAdminInterface;
    }

    /**
     * @param LoginRequest $request
     *
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $auth = $this->accountAdminInterface->login($request);
        if ($auth) {
            return redirect()->route('admin.dashboard.index');
        }

        return redirect()->back()->with('error', __('Thông tin tài khoản hoặc mật khẩu không chính xác.'));
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }

    /**
     * @return Application|Factory|View
     */
    public function profile(): View|Factory|Application
    {
        return view('admin.profile.index');
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return JsonResponse
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        try {
            $this->accountAdminInterface->updateProfile($request);
            return $this->responseSuccess(message: __('Cập nhật hồ sơ thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return $this->responseFailed(message: __('Cập nhật hồ sơ thất bại!'));
        }
    }

    /**
     * @param UpdatePasswordRequest $request
     *
     * @return JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        try {
            $this->accountAdminInterface->updatePassword($request);
            return $this->responseSuccess(message: __('Đổi mật khẩu thành công!'));
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
            return $this->responseFailed(message: __('Đổi mật khẩu thất bại!'));
        }
    }
}

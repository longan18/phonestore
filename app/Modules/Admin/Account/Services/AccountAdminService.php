<?php

namespace App\Modules\Admin\Account\Services;

use App\Enums\TagMediaEnum;
use App\Modules\Admin\Account\Interfaces\AccountAdminInterface;
use App\Modules\Admin\Account\Models\Admin;
use App\Modules\Media\Interfaces\MediaInterface;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AccountAdminService
 *
 * @package App\Modules\Admin\Account\Services
 */
class AccountAdminService extends BaseService implements AccountAdminInterface
{
    protected MediaInterface $mediaInterface;

    /**
     * AccountAdminService constructor.
     *
     * @param Admin          $admin
     * @param MediaInterface $mediaInterface
     */
    public function __construct(Admin $admin, MediaInterface $mediaInterface)
    {
        $this->model = $admin;
        $this->mediaInterface = $mediaInterface;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function login(Request $request): bool
    {
        return Auth::guard('admin')->attempt($request->only('email', 'password'));
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function updateProfile(Request $request): bool
    {
        $admin = $this->getById(adminInfo()->id());
        $update = $admin->update($request->except('file'));

        return $this->uploadAvatar($update, $request, $admin);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function updatePassword(Request $request): bool
    {
        $admin = $this->getById(adminInfo()->id());

        return $admin->update($request->only('password'));
    }
}

<?php

namespace App\Modules\Client\Account\Services;

use App\Enums\StatusAccountEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Client\Account\Interfaces\AccountUserInterface;
use App\Modules\Client\Account\Models\User;
use App\Services\BaseService;

/**
 * @AccountService
 */
class AccountUserService extends BaseService implements AccountUserInterface
{
    /**
     * @param User $account
     */
    public function __construct(User $user) {
        $this->model = $user;
    }

    public function handle($request)
    {
        $data = $request->only($this->model->getFillable());
        $data['id'] = (int) $request->id ?? null;

        if (empty($data['password'] )) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        DB::beginTransaction();
        try {
            $this->model->updateOrCreate(['id' => $data['id']], $data);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            Log::error("{$e->getMessage()} --line: {$e->getLine()} --file: {$e->getFile()}");
            DB::rollBack();
        }

        return false;
    }

    public function login($request)
    {
        $data = $request->only($this->model::AUTH);
        if (Auth::guard(GUARD_WEB)->attempt($data)) {
            userInfo()->update(['status' => StatusAccountEnum::ACTIVE->value]);
            return true;
        }

        return false;
    }

    public function logout()
    {
        userInfo()->update(['status' => StatusAccountEnum::IN_ACTIVE->value]);
        Auth::guard(GUARD_WEB)->logout();

        return true;
    }

    public function getAddressByUser($id)
    {
        return $this->model->with(['addressShippings.address'])
            ->where('id', $id)->first();
    }
}

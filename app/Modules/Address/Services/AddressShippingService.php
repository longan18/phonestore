<?php

namespace App\Modules\Address\Services;

use App\Modules\Address\Enums\AddressShippingEnum;
use App\Modules\Address\Interfaces\AddressShippingInterface;
use App\Modules\Address\Models\AddressShipping;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddressShippingService extends BaseService implements AddressShippingInterface
{
    public function __construct(AddressShipping $addressShipping)
    {
        $this->model = $addressShipping;
    }

    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            parent::deleteById($id);

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }

    public function getAddressActByUserId($id)
    {
        return $this->where('user_id', $id)
            ->where('active', AddressShippingEnum::ACTIVE)
            ->first();
    }

    public function actAddressShipping($id)
    {
        try {
            $q = $this->model->where('user_id', userInfo()->id);
            $q->update(['active' => AddressShippingEnum::IN_ACTIVE]);
            $q->where('id', $id)->update(['active' => AddressShippingEnum::ACTIVE]);

            return true;
        } catch (Exception $exception) {
            Log::error("--msg: {$exception->getMessage()} \n--line: {$exception->getLine()} \n--file: {$exception->getFile()}");
        }

        return false;
    }
}

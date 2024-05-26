<?php

namespace App\Modules\Admin\StorageCapacity\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Modules\Admin\StorageCapacity\Http\Requests\StorageCapacityRequest;
use App\Modules\Admin\StorageCapacity\Interfaces\StorageCapacityInterface;
use App\Modules\Admin\StorageCapacity\Models\StorageCapacity;

/**
 * @StorageCapacityController
 */
class StorageCapacityController extends Controller
{
    protected $storagecapacity;

    /**
     * @param StorageCapacityInterface $storagecapacity
     */
    public function __construct(StorageCapacityInterface $storagecapacity)
    {
        $this->storagecapacity = $storagecapacity;
    }
}

<?php

namespace App\Services;

use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Hash;
use App\Models\Merchant as MerchantModel;
use App\Models\User as UserModel;
use Carbon\Carbon;

class MerchantService
{

    const PRIMARY_KEY = 'id';
    const DEFAULT_PER_PAGE = 25;
    private $merchantModel;
    private $userModel;

    public function __construct(MerchantModel $merchantModel, UserModel $userModel)
    {
        $this->merchantModel = $merchantModel;
        $this->userModel = $userModel;
    }

    public function create($data)
    {
        return $this->merchantModel::create($data)->id;
    }

    public function getByUser($id)
    {
        return $this->userModel::where('id', $id)->with(['merchant'])->first();
    }

    public function delete($id)
    {
        return $this->merchantModel::where(self::PRIMARY_KEY, $id)->delete();
    }

    public function update($id, $data)
    {
        return $this->merchantModel::where('id', $id)->update($data);
    }
}

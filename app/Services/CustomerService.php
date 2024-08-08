<?php

namespace App\Services;

use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer as CustomerModel;
use App\Models\User as UserModel;
use Carbon\Carbon;

class CustomerService
{

    const PRIMARY_KEY = 'id';
    const DEFAULT_PER_PAGE = 25;
    private $customerModel;
    private $userModel;

    public function __construct(CustomerModel $customerModel, UserModel $userModel)
    {
        $this->customerModel = $customerModel;
        $this->userModel = $userModel;
    }

    public function create($data)
    {
        return $this->customerModel::create($data)->id;
    }

    public function getByUser($id)
    {
        return $this->userModel::where('id', $id)->with(['customer'])->first();
    }

    public function delete($id)
    {
        return $this->customerModel::where(self::PRIMARY_KEY, $id)->delete();
    }

    public function update($id, $data)
    {
        return $this->customerModel::where('id', $id)->update($data);
    }
}

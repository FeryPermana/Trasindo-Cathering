<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel;


class UserService
{

    const PRIMARY_KEY = 'id';
    CONST DEFAULT_PER_PAGE = 25;
    private $userModel;

    public function __construct(UserModel $userModel){
        $this->userModel = $userModel;
    }

    public function delete($id) {
        return $this->userModel::where(self::PRIMARY_KEY, $id)->delete();
    }

    public function update($id,$data) {
        return $this->userModel::where(self::PRIMARY_KEY, $id)->update($data);
    }
}

<?php

namespace App\Services;

use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Hash;
use App\Models\Menu as MenuModel;
use Carbon\Carbon;

class MenuService
{
    const PRIMARY_KEY = 'id';
    const DEFAULT_PER_PAGE = 25;
    private $menuModel;

    public function __construct(MenuModel $menuModel)
    {
        $this->menuModel = $menuModel;
    }

    public function create($data)
    {
        return $this->menuModel::create($data)->id;
    }

    public function get($id)
    {
        return $this->menuModel::where('id', $id)->first();
    }

    public function getPaginate($per_page, $keyword, $merchant_id)
    {
        $container = $this->menuModel;

        if ($keyword) {
            $container = $container->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
                $q->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        return $container->where('merchant_id', $merchant_id)->latest()->paginate($per_page ?? self::DEFAULT_PER_PAGE);
    }

    public function getCustomerPaginate($per_page, $keyword)
    {
        $container = $this->menuModel;

        if ($keyword) {
            $container = $container->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
                $q->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        return $container->latest()->paginate($per_page ?? self::DEFAULT_PER_PAGE);
    }

    public function delete($id)
    {
        return $this->menuModel::where(self::PRIMARY_KEY, $id)->delete();
    }

    public function update($id, $data)
    {
        return $this->menuModel::where('id', $id)->update($data);
    }
}

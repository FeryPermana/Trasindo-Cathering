<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    const DEFAULT_PER_PAGE = 25;
    private $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $keyword = @$request->keyword;
        $per_page = @$request->per_page;

        $menus = $this->menuService->getCustomerPaginate($per_page, $keyword);

        return view('customer.menu.index', compact('menus'));
    }
}

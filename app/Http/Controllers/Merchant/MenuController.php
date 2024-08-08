<?php

namespace App\Http\Controllers\Merchant;

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
        $merchant_id = auth()->user()->id;

        $keyword = @$request->keyword;
        $per_page = @$request->per_page;

        $menus = $this->menuService->getPaginate($per_page, $keyword, $merchant_id);

        return view('merchant.menu.index', compact('menus'));
    }

    public function create(Request $request)
    {
        $data = [
            "action" => "Create",
            "title" => "Create Menu",
            "menu" => [],
            "url" => route('merchant.menu.store')
        ];

        return view('merchant.menu.cru', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $menu = $request->only(Schema::getColumnListing('menus'));

        return DB::transaction(function () use ($menu) {
            $menu['merchant_id'] = auth()->user()->merchant->id;
            $menu['photo'] = '/assets/image/default-menu.jpeg';

            $queryResultMenu = $this->menuService->create($menu);

            if (!$queryResultMenu) {
                toastr()->error('Database fail to edit a new menu');
                return redirect()->back();
            }

            toastr()->success('Database success to create a new menu');
            return redirect()->route('merchant.menu.index');
        });
    }

    public function edit(Request $request, $id)
    {

        $menu = $this->menuService->get($id);

        $data = [
            "action" => "Edit",
            "title" => "Edit Menu",
            "menu" => $menu,
            "url" => route('merchant.menu.update', $id)
        ];

        return view('merchant.menu.cru', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $menu = $request->only(Schema::getColumnListing('menus'));

        return DB::transaction(function () use ($menu, $id) {
            $menu['merchant_id'] = auth()->user()->merchant->id;
            $menu['photo'] = '/assets/image/default-menu.jpeg';

            $queryResultMenu = $this->menuService->update($id, $menu);

            if (!$queryResultMenu) {
                toastr()->error('Database fail to edit a new menu');
                return redirect()->back();
            }

            toastr()->success('Database success to edit a new menu');
            return redirect()->back();
        });
    }

    public function delete($id)
    {
        $this->menuService->delete($id);

        toastr()->success('Deleted menu is successfully');
        return redirect()->route('merchant.menu.index');
    }
}

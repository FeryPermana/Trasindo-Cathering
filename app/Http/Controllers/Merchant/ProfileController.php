<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Services\MerchantService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    const DEFAULT_PER_PAGE = 25;
    private $merchantService;

    public function __construct(MerchantService $merchantService, UserService $userService)
    {
        $this->merchantService = $merchantService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $id = auth()->user()->id;
        $data = $this->merchantService->getByUser($id);

        return view('merchant.profile.index', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'contact' => 'required|numeric',
            'description' => 'required',
        ]);

        $user = $request->only(Schema::getColumnListing('users'));
        $merchant = $request->only(Schema::getColumnListing('merchants'));

        return DB::transaction(function () use ($id, $user, $merchant) {
            $merchant['user_id'] = $id;

            $queryResultUser = $this->userService->update($id, $user);

            $merchantExist = $this->merchantService->getByUser($id);

            if($merchantExist->merchant) {
                $queryResultMerchant = $this->merchantService->update($merchantExist->merchant->id, $merchant);
            } else {
                $queryResultMerchant = $this->merchantService->create($merchant);
            }

            if (!$queryResultMerchant) {
                toastr()->error('Database fail to edit a new merchants');
                return redirect()->back();
            }

            toastr()->success('Database success to edit a new merchants');
            return redirect()->back();
        });
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Services\CustomerService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    const DEFAULT_PER_PAGE = 25;
    private $customerService;

    public function __construct(CustomerService $customerService, UserService $userService)
    {
        $this->customerService = $customerService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $id = auth()->user()->id;
        $data = $this->customerService->getByUser($id);

        return view('customer.profile.index', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'contact' => 'required|numeric',
        ]);

        $user = $request->only(Schema::getColumnListing('users'));
        $customer = $request->only(Schema::getColumnListing('customers'));

        return DB::transaction(function () use ($id, $user, $customer) {
            $customer['user_id'] = $id;

            $queryResultUser = $this->userService->update($id, $user);

            $customerExist = $this->customerService->getByUser($id);

            if($customerExist->customer) {
                $queryResultcustomer = $this->customerService->update($customerExist->customer->id, $customer);
            } else {
                $queryResultcustomer = $this->customerService->create($customer);
            }

            if (!$queryResultcustomer) {
                toastr()->error('Database fail to edit a new customers');
                return redirect()->back();
            }

            toastr()->success('Database success to edit a new customers');
            return redirect()->back();
        });
    }
}

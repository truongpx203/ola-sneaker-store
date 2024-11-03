<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherRequest;
use App\Models\User;
use App\Models\VoucerHistory;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::query()->get();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allUsers = User::where('status', 'active')->get();
        return view('admin.vouchers.create', compact('allUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoucherRequest $request)
    {
        $voucher = Voucher::create($request->all());
        return redirect()->route('voucher.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $allUsers = User::where('status', 'active')->get();
        $voucher = Voucher::find($id);
        return view('admin.vouchers.edit', compact('voucher', 'allUsers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoucherRequest $request, $id)
    {
        $voucher = Voucher::find($id);
        $data = [
            "value" => $request->value,
            "quantity" => $request->quantity,
            "max_price" => $request->max_price,
            "start_datetime" => $request->start_datetime,
            "end_datetime" => $request->end_datetime,
            "description" => $request->description,
        ];
        if (is_null($request->for_user_ids)) {
            $data["user_use"] = $request->user_use;
        } else {
            $data["for_user_ids"] = $request->for_user_ids;
        }
        $voucher->update($data);
        return redirect()->route('voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $voucher = Voucher::find($id);
        $voucerHistory = VoucerHistory::query()->where('voucher_id', $id)->first();
        if ($voucerHistory) {
            return redirect()->route('voucher.index')->withErrors(['error_voucher' => 'Voucher này đang có ràng buộc không thể xóa']);
        } else {
            $voucher->delete();
            return redirect()->route('voucher.index');
        }
    }
}

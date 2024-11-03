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
        $allUsers = User::where('id', '!=', Auth::user()->id)
                             ->where('status', 'active') 
                             ->get();
        return view('admin.vouchers.create',compact('allUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoucherRequest $request)
    {
        $productSizes = Voucher::create($request->all());
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
    public function edit(Voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        //
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

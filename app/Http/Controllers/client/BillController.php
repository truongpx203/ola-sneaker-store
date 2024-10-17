<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function user_bills()
    {
        $user = auth()->user();
        $bills = $user->bills;
        return view('client.account', compact('user', 'bills'));
    }
}

<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Auth::user()->bills()->orderBy('created_at', 'desc')->get();

        return view('client.bill-list', compact('bills'));
    }
}

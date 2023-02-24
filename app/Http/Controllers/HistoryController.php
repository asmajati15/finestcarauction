<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $auth_user = Auth::id();
        $bid = Bid::where('user_id', $auth_user)->pluck('lot_id');
        $lots = Lot::whereIn('id', $bid)->get();
        $lots2 = Lot::whereNotIn('id', $bid)->get();
        return view('auction.history', compact('lots','lots2','current_time'));
    }

    public function invoice($id) {
        $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $lots = Lot::where('id', $id)->first();
        $pdf = PDF::loadView('auction/invoice', compact('lots','current_time'));

        return $pdf->download('finestcarauction-invoice.pdf');
    }

}

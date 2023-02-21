<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index() {
        $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $a = Auth::id();
        $b = Bid::where('user_id', $a)->pluck('lot_id');
        $d = User::where('id', $a)->value('name');
        // $c = Lot::whereIn('id', $b)->where('end_time' ,'<=',Carbon::now('Asia/Jakarta'))->get();
        $c = Lot::whereIn('id', $b)->get();
        // $c = Lot::with('user')->get();
        $ca = Lot::whereNotIn('id', $b)->get();
        return view('auction.history', [
            'c' => $c ,
            'ca' => $ca,
            'nama' => $d,
            'current_time' => $current_time,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function newBid(Request $request, $lot_id)
    {
        $request->validate([
            'bid_price' => 'required',
        ]);

        // $user_id = Auth::user();
        // $bid = $request->all();
        // $bid = Auth::user();
        // $bid = $request->input('bid');

        Bid::create([
            'bid_price' => $request->bid_price,
            'lot_id' => $lot_id,
            'user_id' => Auth::id(),
        ]);

        Lot::where('id' ,$lot_id)->update([
            'final_price' => $request->bid_price,
            'user_id' => Auth::id(),
        ]);

        // dd($bid);
        // Bid::create($bid);

        return redirect()->route('lot.index')->with('success', 'Items has been bidded!');
    }
    
    public function destroy($id) {
        Bid::select('user_id')->where('lot_id',$id)->delete();

        return redirect()->back()->with('success', 'Bid delete successfully!');
    }

}

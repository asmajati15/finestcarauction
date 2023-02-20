<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // date_                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  default_timezone_set('Jakarta');
        $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $lots = Lot::with('user')->get();
        return view('auction.dashboard', compact('lots','current_time'));
    }

    public function sell()
    {
        // date_                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  default_timezone_set('Jakarta');
        $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $lots = Lot::get();
        return view('auction.sell', compact('lots','current_time'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_price' => 'required',
            // 'max_price' => 'required',
            'bid_increment' => 'required',
            'end_time' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'lot-images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        // Lot::create($input);
        Lot::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_price' => $request->start_price,
            'final_price' => $request->start_price,
            'bid_increment' => $request->bid_increment,
            'end_time' => $request->end_time,
            'image' => $profileImage,
            'category_id' => $request->category_id,
            // 'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Lots created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // // Ambil data lelang dari database
        // $auction = Auction::find($auction_id);

        // // Periksa apakah lelang sudah berakhir
        // if ($auction->end_time < now()) {

        //     // Ambil semua penawaran pada lelang ini
        //     $bids = Bid::where('auction_id', $auction->id)->get();

        //     // Urutkan penawaran dari nilai tertinggi ke terendah
        //     $bids = $bids->sortByDesc('value');

        //     // Ambil penawaran tertinggi
        //     $winner = $bids->first();

        //     // Simpan pemenang lelang ke database
        //     $auction->winner_id = $winner->user_id;
        //     $auction->save();

        //     // Lakukan tindakan lain, misalnya mengirim email ke pemenang lelang dan pengguna lainnya

        // } else {

        //     // Lelang masih berjalan, lakukan tindakan lain yang diperlukan

        // }

        $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $lots = Lot::where('id', $id)->first();
        if ($lots) {
            return view('auction.detail', compact('lots','current_time'));
        } else {
            return response()->view(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function edit(Lot $lot)
    {
        return view('auction.edit', compact('lots'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lot $lot)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'min_price' => 'required',
            'max_price' => 'required',
            'buyout_price' => 'required',
            'end_time' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->except(['_token', '_method' ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'lot-images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        Lot::where('id', $lot)->update($input);
        // dd($input);

        return redirect()->back()->with('success', 'Lots updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lot $lot, $id)
    {
        $lot = Lot::find($id);

        if ($lot) {
            // Hapus gambar dari folder public
            $imagePath = public_path('lot-images/' . $lot->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Hapus field dari database
            $lot->where('id', $id)->delete();

            return redirect()->back()->with('success', 'Lots deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Lots deleted failed!');
        }


        // $lot->where('id', $id)->delete();
     
        // return redirect()->route('lot.sell')->with('success','Product deleted successfully');
    }
}

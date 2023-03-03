<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\User;
use App\Models\Bid;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\Midtrans\CreateSnapTokenService;
use Carbon\Carbon;

class LotController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

        if(isset($_GET['q'])){
            $lots = Lot::with('user')->where('name', 'Like', '%' . $_GET['q'] . '%')->get();
        }
        else{
        // date_                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    default_timezone_set('Jakarta');
            $lots = Lot::with('user')->get();
        }
        return view('auction.dashboard', compact('lots','current_time'))->with('i', (request()->input('page',1)*5));
    }

    public function sell()
    {
        // date_                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  default_timezone_set('Jakarta');
        $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s', 'Asia/Jakarta');
        $categories = Category::get();
        $lots = Lot::with('user')->get();
        return view('manager.sell', compact('lots','categories','current_time'));
    }

    public function open(Request $request, $id)
    {
        // $request->validate([
        //     'status' => 'required',
        //     'end_time' => 'required',
        // ]);

        // $input = $request->all();
        Lot::where('id', $id)->update([
            'status' => $request->status,
            'end_time' => $request->end_time,
        ]);

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function close(Request $request, $id)
    {
        // $input = $request->all();
        Lot::where('id', $id)->update([
            'status' => $request->status,
            'end_time' => Carbon::now('Asia/Jakarta'),
        ]);

        return redirect()->back()->with('success', 'Status updated successfully!');
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
            'category_id' => 'required',
            'description' => 'required',
            'start_price' => 'required',
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
    // public function show($id)
    // {
    //     $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
    //     $lots = Lot::where('id', $id)->with('bid')->first();
    //     if ($lots) {
    //         return view('auction.detail', compact('lots','current_time'));
    //     } else {
    //         return response()->view(404);
    //     }
    // }

    public function show(Bid $bid, $id) {
        $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $lots = Lot::where('id', $id)->with('bid')->first();
        if ($lots->end_time <= $current_time) {
            $bid = Bid::where('lot_id',$lots->id)->orderBy('bid_price', 'DESC')->first();
            $snapToken = $bid->snap_token;
            if (empty($snapToken)) {
                // Jika snap token masih NULL, buat token snap dan simpan ke database

                $midtrans = new CreateSnapTokenService($bid);
                $snapToken = $midtrans->getSnapToken();

                $bid->snap_token = $snapToken;
                $bid->save();
            }
            // return response()->json(['snapToken' => $snapToken, 'bid' => $id], 200);
            return view('auction.detail', compact('lots','current_time','bid','snapToken'));
        } else {
            return view('auction.detail', compact('lots','current_time'));
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
            'start_price' => 'required',
            'bid_increment' => 'required',
            'end_time' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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
        // $bid = Bid::find($lot->id);

        if ($lot) {
            $imagePath = public_path('lot-images/' . $lot->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

                $lot->where('id', $id)->delete();
                // $bid->where('lot_id', $id)->delete();

            return redirect()->back()->with('success', 'Lots deleted successfully!');

        } else {

            return redirect()->back()->with('error', 'Lots deleted failed!');

        }
    }
}

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
            'min_price' => 'required',
            'max_price' => 'required',
            'buyout_price' => 'required',
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
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'buyout_price' => $request->buyout_price,
            'end_time' => $request->end_time,
            'image' => $profileImage,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('lot.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'lot-images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $lot->update($input);

        return redirect()->route('lot.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lot  $lot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lot $lot, $id)
    {
        $lot->where('id', $id)->delete();
     
        return redirect()->route('lot.sell')->with('success','Product deleted successfully');
    }
}

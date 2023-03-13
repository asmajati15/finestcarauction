<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lot;
use App\Models\Bid;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $lots = Lot::get();
        $bids = Bid::groupBy('lot_id')->orderBy('lot_id', 'desc')->get();
        $categories = Category::get();
        return view('admin.dashboard', compact('categories','bids', 'lots', 'current_time'));
    }

    public function manager()
    {
        $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $lots = Lot::get();
        $bids = Bid::groupBy('lot_id')->orderBy('lot_id', 'desc')->get();
        $categories = Category::get();
        return view('manager.dashboard', compact('categories','bids', 'lots', 'current_time'));
    }

    public function report() {
        $current_time = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $lots = Lot::get();
        $bids = Bid::get();
        $pdf = PDF::loadView('pdf/report', compact('lots','bids','current_time'));

        return $pdf->download('finestcarauction-admin-report.pdf');
    }

    public function userList()
    {
        $users = User::get();
        return view('admin.userList', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 1,
        ]);

        return redirect()->back()->with('success', 'Account created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 1,
        ]);

        return redirect()->back()->with('success', 'Account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Account delete successfully');
    }

    public function blacklist(Request $request, $id)
    {
        User::where('id', $id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Account updated successfully');
    }

    public function unblacklist(Request $request, $id)
    {
        User::where('id', $id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Account updated successfully');
    }
}

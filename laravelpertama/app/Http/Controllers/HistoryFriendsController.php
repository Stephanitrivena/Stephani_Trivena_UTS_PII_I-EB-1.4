<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\history_friends;
use Illuminate\Http\Request;

class HistoryFriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // menampilkan data history
    public function index()
    {
        $hfriends = history_friends::with('groups')->get();
        $hfriends = history_friends::all();
        
        $groups = Groups::all();


        // return view('layouts.ppa');
        return view('friends.index', ['hfriends' => $hfriends, 'groups' => $groups]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\history_friends  $history_friends
     * @return \Illuminate\Http\Response
     */
    public function show(history_friends $history_friends)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\history_friends  $history_friends
     * @return \Illuminate\Http\Response
     */
    public function edit(history_friends $history_friends)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\history_friends  $history_friends
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, history_friends $history_friends)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\history_friends  $history_friends
     * @return \Illuminate\Http\Response
     */
    public function destroy(history_friends $history_friends)
    {
        //
    }
}

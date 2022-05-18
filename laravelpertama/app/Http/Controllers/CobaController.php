<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\Groups;
use App\Models\history_friends;
use Illuminate\Http\Request;

class CobaController extends Controller
{
    // menampilkan data pada halaman
    public function index()
    {
        $friends = Friends::with('groups')->get();
        $hfriends = history_friends::all();
        $groups = Groups::all();
        // dd($hfriends);
        return view('friends.index', ['friends' => $friends,'groups' => $groups, 'hfriends'=>$hfriends]);
    }

    public function indexx()
    {
        return view('layouts.index');
    }

    // berpindah halaman ke halaman create
    public function create()
    {
        $groups = [
            'groups' => Groups::all()
        ];
        return view('friends.create',$groups);
    }

    // memasukkan data kedalam database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255|',
            'no_tlp' => 'required|numeric',
            'alamat' => 'required'
        ]);
        
        $friends = new Friends;
 
        $friends->nama = $request->nama;
        $friends->groups_id = 0;
        $friends->no_tlp = $request->no_tlp;
        $friends->alamat = $request->alamat;
 
        $friends->save();
        return redirect('/friends');
    }

    // beralih ke tampilan detail data
    public function show($id){
        $friends = Friends::where('id', $id)->first();
        // $friends = Friends::where('id', $id)->first();
        // $hfriends = history_friends::where('id',$id)->first();
        $hfriends = history_friends::all()->where('id','=',$id);
       
        // dd($friends);
        return view('friends.show', ['friends' => $friends, 'hfriends'=>$hfriends]);
    }

    // beralih ke tampilan edit data
    public function edit($id)
    {
        $friends = Friends::where('id', $id)->first();
        // dd($friends);
        return view('friends.edit', ['friends' => $friends]);
        return redirect('/#edit');
    }

    // mengupdate data ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255|',
            'no_tlp' => 'required|numeric',
            'alamat' => 'required'
        ]);
        
        $friends = Friends::find($id);
        $friends->nama = $request->nama;
        $friends->no_tlp = $request->no_tlp;
        $friends->alamat = $request->alamat;

        $friends->save();

        return redirect('/friends/#about');
    }

    // hapus data
    public function destroy($id)
    {
        $friends = Friends::find($id);
        $friends->delete();

        return redirect('/friends');
    }
}
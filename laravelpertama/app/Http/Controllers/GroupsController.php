<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\Groups;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // menampilkan data pada halaman
    public function index()
    {
        $groups = Groups::all();
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // beralih tampilan ke tampilan create 
    public function create()
    {
        return view('Groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // membuat data kedalam database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:groups|max:255|',
            'description' => 'required'
        ]);
 
        $group = new groups;
 
        $group->name = $request->name;
        $group->description = $request->description;
 
        $group->save();
        return redirect('/groups/#portfolio');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // beralih ke tampilan detail data 
    public function show($id)
    {
        $friends = Friends::where('groups_id','=', $id)->get();
        $group = Groups::where('id', $id)->first();
        return view('groups.show', ['group' => $group, 'friends' => $friends]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // pindah ke tampilan edit data 
    public function edit($id)
    {
        $group = Groups::where('id', $id)->first();
        return view('groups.edit', ['groups' => $group]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // mengupdate data group 
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|',
            'description' => 'required'
        ]);
        $groups = Groups::find($id);
        $groups->name = $request->name;
        $groups->description = $request->description;

        $groups->save();

        return redirect('/groups/#portfolio');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // menghapus data group
    public function destroy($id)
    {   
        Groups::find($id)->delete();

        return redirect('/groups/#portfolio');
    }

    // menambahkan member
    public function addmember($id)
    {
        $friends = Friends::where('groups_id','=', 0)->get();
        
        $group = Groups::where('id', $id)->first();

        return view('groups.addmember', ['group' => $group, 'friends' => $friends]);
    }
    
    // mengupdate data member
    public function updatemember(Request $request, $id)
    {
        $friends = Friends::where('id', $request->friend_id)->first();
        Friends::find($friends->id)->update([
            'groups_id' => $id
        ]);

        return redirect('/groups/#portfolio' );
    }
    // menghapus data member
    public function deletemember($id)
    {
        Friends::find($id)->update([
            'groups_id' => 0
        ]);
        return redirect('/groups/#portfolio');
    }
}

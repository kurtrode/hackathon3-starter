<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    
    public function detail($id)
    {
        $search = Owner::findorfail($id);
       

        return view('owner-detail.owner-details', compact('search'));

    }
    public function results()
    {
        
        $search = $_GET['owner']?? '';

        $result = Owner::query()->where('surname', 'like', '%' . $search . '%')->orderBy('surname')->limit(20)->get();

        return view('owner', compact('result'));

    }
    public function create()
    {
        $owner = new Owner;
        return view('owners-create',compact('owner'));
    }
    public function insert(Request $request)
    {
        $owner= new Owner();
        $owner->first_name = $request->post('name');
        $owner->surname = $request->post('surname');
        $owner->email = $request->post('email');
        $owner->phone = $request->post('phone');
        $owner->address = $request->post('address');

        $owner->save();

        session()->flash('success_message', 'The owner has been registered.');

        return redirect()->route('owner.details', $owner->id);
    }

    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
        return view('owners-create',compact('owner'));
        return redirect()->route('owner.details',$owner->id);
    }
    public function update($id, Request $request)
    {
        $owner= Owner::findOrFail($id);

        $owner->first_name = $request->post('name');
        $owner->surname = $request->post('surname');
        $owner->email = $request->post('email');
        $owner->phone = $request->post('phone');
        $owner->address = $request->post('address');

        $owner->save();

        session()->flash('success_message', 'The owner has been registered.');

        return redirect()->route('owner.update', $id);
    }
    
}

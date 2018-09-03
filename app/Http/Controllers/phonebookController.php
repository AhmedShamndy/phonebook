<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhonebookRequest;
use App\Phonebook;

class phonebookController extends Controller
{
    public function index()
    {
        return view('phonebook');
    }

    public function create()
    {
        //
    }

    public function store(PhonebookRequest $request)
    {
        //return $request->name;
        $pb = new Phonebook;
        $pb->name = $request->name;
        $pb->phone = $request->phone;
        $pb->email = $request->email;
        $pb->age = $request->age;
        $pb->save();
        return $pb;
    }
    public function getData()
    {
        return Phonebook::orderBy('name','ASC')->get();
    }
    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(PhonebookRequest $request)
    {
        $pb = Phonebook::find($request->id);
        $pb->name = $request->name;
        $pb->phone = $request->phone;
        $pb->email = $request->email;
        $pb->age = $request->age;
        $pb->save();
    }

    public function destroy(Phonebook $phonebook)
    {
        Phonebook::where('id',$phonebook->id)->delete();
    }
}

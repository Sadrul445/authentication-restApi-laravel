<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        return Client::all();
    }

    public function store(Request $request)
    {
        //validation
        $client = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'bio'  => 'required',
            'number'  => 'required',
            'country'  => 'required',
            'address'  => 'required',
        ]);
        return Client::create($request->all()); //create
    }
    public function show(Request $request,$id)
    {
        return Client::find($id);
    }
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->update($request->all());
        return $client;
    }
    public function destroy($id)
    {
        return Client::destroy($id);
    }
}

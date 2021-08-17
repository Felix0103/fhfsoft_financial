<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\IdentificationType;
use App\Models\Partner;
use App\Models\SubAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.clients.index')->only('index');
        $this->middleware('can:admin.clients.create')->only('create','store');
        $this->middleware('can:admin.clients.edit')->only('edit','update');
        $this->middleware('can:admin.clients.destroy')->only('destroy');

    }
    public function index()
    {
        return view('admin.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $identificationTypes = IdentificationType::orderBy('description')->pluck('description','id');
        $partners = Partner::select(DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"), "id")
        ->orderBy('first_name')->pluck('full_name','id');
        return view('admin.clients.create', compact('identificationTypes','partners'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {

        $client = Client::create($request->all());

        $client->address()->create($request->all());
        $client->contact()->create($request->all());
        $account = SubAccount::create(['description' => "$client->first_name $client->last_name"  , 'account_id'=> 2, 'code' => '11-20-'.$client->id]);
        $client->sub_account_id = $account->id;
        $client->update();
        return redirect()->route('admin.clients.edit',$client)->with('info', 'El cliente se creo exitosamente');

    }
    public function show(Client $client)
    {
        //
    }
    public function edit(Client $client)
    {
        $identificationTypes = IdentificationType::orderBy('description')->pluck('description','id');
        $partners = Partner::select(DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"), "id")
        ->orderBy('first_name')->pluck('full_name','id');
        return view('admin.clients.edit', compact('identificationTypes','partners','client'));
    }
    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->all());
        $account = SubAccount::find($client->sub_account_id);
        $account->description = "$client->first_name $client->last_name";

        if($client->address){
            $client->address->update($request->all());
        }else{
            $client->address()->create($request->all());
        }
        if($client->contact){
            $client->contact->update($request->all());
        }else{
            $client->contact()->create($request->all());
        }
        return redirect()->route('admin.clients.edit',$client)->with('info', 'El cliente se actualizo correctamente');

    }
    public function destroy(Client $client)
    {
       $client->active = $client->active ==1?0:1;
       $client->update();

        return redirect()->route('admin.clients.index')->with('info', 'El cliente se '.($client->active ==1? 'activo' : 'desactivo').' exitosamente');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollectorRequest;
use App\Models\Collector;
use App\Models\IdentificationType;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectorController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.collectors.index')->only('index');
        $this->middleware('can:admin.collectors.create')->only('create','store');
        $this->middleware('can:admin.collectors.edit')->only('edit','update');
        $this->middleware('can:admin.collectors.destroy')->only('destroy');

    }
    public function index()
    {
        return view('admin.collectors.index');
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
        return view('admin.collectors.create', compact('identificationTypes','partners'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollectorRequest $request)
    {

        $collector = Collector::create($request->all());

        $collector->address()->create($request->all());
        $collector->contact()->create($request->all());

        return redirect()->route('admin.collectors.edit',$collector)->with('info', 'El cobrador se creo exitosamente');

    }
    public function show(Collector $collector)
    {
        //
    }
    public function edit(Collector $collector)
    {
        $identificationTypes = IdentificationType::orderBy('description')->pluck('description','id');
        $partners = Partner::select(DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"), "id")
        ->orderBy('first_name')->pluck('full_name','id');
        return view('admin.collectors.edit', compact('identificationTypes','partners','collector'));
    }
    public function update(CollectorRequest $request, Collector $collector)
    {
        $collector->update($request->all());
        if($collector->address){
            $collector->address->update($request->all());
        }else{
            $collector->address()->create($request->all());
        }
        if($collector->contact){
            $collector->contact->update($request->all());
        }else{
            $collector->contact()->create($request->all());
        }
        return redirect()->route('admin.collectors.edit',$collector)->with('info', 'El cobrador se actualizo correctamente');

    }
    public function destroy(Collector $collector)
    {
       $collector->active = $collector->active ==1?0:1;
       $collector->update();

        return redirect()->route('admin.collectors.index')->with('info', 'El cobrador se '.($collector->active ==1? 'activo' : 'desactivo').' exitosamente');
    }
}


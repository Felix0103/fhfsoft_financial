<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Models\IdentificationType;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.partners.index')->only('index');
        $this->middleware('can:admin.partners.create')->only('create','store');
        $this->middleware('can:admin.partners.edit')->only('edit','update');
        $this->middleware('can:admin.partners.destroy')->only('destroy');

    }
    public function index()
    {
        return view('admin.partners.index');
    }

    public function create()
    {
        $identificationTypes = IdentificationType::orderBy('description')->pluck('description','id');
        return view('admin.partners.create', compact('identificationTypes'));

    }
    public function store(PartnerRequest $request)
    {

        $partner = Partner::create($request->all());

        $partner->address()->create($request->all());
        $partner->contact()->create($request->all());

        return redirect()->route('admin.partners.edit',$partner)->with('info', 'El socio se creo exitosamente');

    }
    public function show(Partner $partner)
    {
        //
    }
    public function edit(Partner $partner)
    {
        $identificationTypes = IdentificationType::orderBy('description')->pluck('description','id');
        return view('admin.partners.edit', compact('identificationTypes','partner'));
    }
    public function update(PartnerRequest $request, Partner $partner)
    {
        $partner->update($request->all());
        if($partner->address){
            $partner->address->update($request->all());
        }else{
            $partner->address()->create($request->all());
        }
        if($partner->contact){
            $partner->contact->update($request->all());
        }else{
            $partner->contact()->create($request->all());
        }
        return redirect()->route('admin.partners.edit',$partner)->with('info', 'El socio se actualizo correctamente');

    }
    public function destroy(Partner $partner)
    {
       $partner->active = $partner->active ==1?0:1;
       $partner->update();

        return redirect()->route('admin.partners.index')->with('info', 'El socio se '.($partner->active ==1? 'activo' : 'desactivo').' exitosamente');
    }
}

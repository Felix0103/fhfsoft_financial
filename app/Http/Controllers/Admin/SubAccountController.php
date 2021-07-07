<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubAccount;
use Illuminate\Http\Request;

class SubAccountController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $request->validate([
            'description2' => 'required'
        ], [], ['description2' => 'nombre de la sub cuenta']);


        SubAccount::create(['description' => $request->input('description2'), 'account_id'=> $request->input('account_id') ]);
        return redirect()->route('admin.accounts.edit',$request->input('account_id'))->with('info', 'La sub cuenta se creo correctamente');

    }
    public function show(SubAccount $subaccount)
    {
        //
    }
    public function edit(SubAccount $subaccount)
    {
        //
    }
    public function update(Request $request, SubAccount $subaccount)
    {
        $subaccount->update($request->all());
        return redirect()->route('admin.accounts.edit',$subaccount->account_id)->with('info', 'La sub cuenta se actualizo correctamente');

    }

    public function destroy(SubAccount $subaccount)
    {
        $subaccount->active = $subaccount->active ==1?0:1;
        $subaccount->update();
        return redirect()->route('admin.accounts.edit',$subaccount->account_id)->with('info', 'La sub cuenta '.($subaccount->active ==1? 'activo' : 'desactivo').' exitosamente');

    }
}

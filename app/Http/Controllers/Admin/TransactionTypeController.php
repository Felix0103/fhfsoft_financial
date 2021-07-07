<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionTypeRequest;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.transactiontypes.index')->only('index');
        $this->middleware('can:admin.transactiontypes.create')->only('create','store');
        $this->middleware('can:admin.transactiontypes.edit')->only('edit','update');
        $this->middleware('can:admin.transactiontypes.destroy')->only('destroy');
    }
    public function index()
    {
        return view('admin.transaction_types.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.transaction_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionTypeRequest $request)
    {
        $account = TransactionType::create($request->all());
        return redirect()->route('admin.transactiontypes.edit',$account)->with('info', 'El tipo de transaction  se creo exitosamente');
    }
    public function show($id)
    {
        //
    }
    public function edit(TransactionType $transactiontype)
    {
        return view('admin.transaction_types.edit', compact('transactiontype'));
    }
    public function update(TransactionTypeRequest $request, TransactionType $transactiontype)
    {
        $transactiontype->update($request->all());

        return redirect()->route('admin.transactiontypes.edit',$transactiontype)->with('info', "El tipo de transaccion ($request->description) se actualizo correctamente");
    }

    public function destroy(TransactionType $transactiontype)
    {
        $transactiontype->active = $transactiontype->active ==1?0:1;
        $transactiontype->update();

         return redirect()->route('admin.transactiontypes.index')->with('info', 'El tipo de transaccion se '.($transactiontype->active ==1? 'activo' : 'desactivo').' exitosamente');
    }
}

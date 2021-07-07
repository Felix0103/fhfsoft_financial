<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.accounts.index')->only('index');
        $this->middleware('can:admin.accounts.create')->only('create','store');
        $this->middleware('can:admin.accounts.edit')->only('edit','update');
        $this->middleware('can:admin.accounts.destroy')->only('destroy');

    }
    public function index()
    {
        return view('admin.accounts.index');

    }
    public function create()
    {
        return view('admin.accounts.create');
    }

    public function store(AccountRequest $request)
    {
        $account = Account::create($request->all());
        return redirect()->route('admin.accounts.edit',$account)->with('info', 'La cuenta se creo exitosamente');
    }
    public function show(Account $account)
    {

    }

    public function edit(Account $account)
    {
        return view('admin.accounts.edit', compact('account'));
    }

    public function update(AccountRequest $request, Account $account)
    {
        $account->update($request->all());

        return redirect()->route('admin.accounts.edit',$account)->with('info', 'La cuenta se actualizo correctamente');

    }
    public function destroy(Account $account)
    {
        $account->active = $account->active ==1?0:1;
        $account->update();

         return redirect()->route('admin.accounts.index')->with('info', 'La cuenta se '.($account->active ==1? 'activo' : 'desactivo').' exitosamente');
    }
}

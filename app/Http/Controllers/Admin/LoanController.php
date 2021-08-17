<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.loans.index')->only('index');
        $this->middleware('can:admin.loans.create')->only('create','store');
        $this->middleware('can:admin.loans.edit')->only('edit','update');
        $this->middleware('can:admin.loans.destroy')->only('destroy');

    }
    public function index()
    {
        return view('admin.loans.index');

    }
    public function create()
    {
        return view('admin.loans.create');
    }
    public function store(Request $request)
    {
        //
    }
    public function show(Loan $loan)
    {
        //
    }
    public function edit(Loan $loan)
    {
        //
    }
    public function update(Request $request, Loan $loan)
    {
        //
    }
    public function destroy(Loan $loan)
    {
        //
    }
}

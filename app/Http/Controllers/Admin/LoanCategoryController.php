<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanCategoryRequest;
use App\Models\BillingCycle;
use App\Models\LoanCategory;
use App\Models\LoanType;
use Illuminate\Http\Request;

class LoanCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.loancategories.index')->only('index');
        $this->middleware('can:admin.loancategories.create')->only('create','store');
        $this->middleware('can:admin.loancategories.edit')->only('edit','update');
        $this->middleware('can:admin.loancategories.destroy')->only('destroy');
    }
    public function index()
    {
        return view('admin.loan_types.index');

    }
    public function create()
    {
        $loanTypes = LoanType::orderBy('description')->pluck('description','id');
        $billingCycles= BillingCycle::orderBy('description')->pluck('description','id');

        return view('admin.loan_types.create', compact('loanTypes', 'billingCycles'));
    }
    public function store(LoanCategoryRequest $request)
    {
        $loanCategory = LoanCategory::create($request->all());

        return redirect()->route('admin.loancategories.edit',$loanCategory)->with('info', 'El tipo de prestamo se creo exitosamente');

    }
    public function show(LoanCategory $loancategory)
    {
    }
    public function edit(LoanCategory $loancategory)
    {
        $loanTypes = LoanType::orderBy('description')->pluck('description','id');
        $billingCycles= BillingCycle::orderBy('description')->pluck('description','id');
        return view('admin.loan_types.edit', compact('loancategory','loanTypes', 'billingCycles' ));
    }
    public function update(LoanCategoryRequest $request, LoanCategory $loancategory)
    {
        $loancategory->update($request->all());

        return redirect()->route('admin.loancategories.edit',$loancategory)->with('info', 'El tipo de prestamo se actualizo correctamente');

    }
    public function destroy(LoanCategory $loancategory)
    {
        $loancategory->active = $loancategory->active ==1?0:1;
        $loancategory->update();

         return redirect()->route('admin.loancategories.index')->with('info', 'El tipo de prestamo se '.($loancategory->active ==1? 'activo' : 'desactivo').' exitosamente');
    }
}

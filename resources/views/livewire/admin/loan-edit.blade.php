<div>
    <form wire:submit.prevent="save">
        <div class="card small">

            <div class="card-body">

                <div>
                    @if (session()->has('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                    @endif
                </div>

                {{-- Informacion del cliente --}}
                <div class="row">
                    @if ($current_client)
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre Completo:</label> <br>
                                    <label>{{$current_client?->first_name}} {{$current_client?->last_name}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Telefono & Celular:</label> <br>
                                    <label>{{$current_client?->contact?->phone}}
                                        {{$current_client?->contact?->cell_phone??''}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Numero de documento :</label> <br>
                                    <label>{{$current_client?->identification??'N/A'}} </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dirección:</label> <br>
                                    <label>{{$current_client?->address?->description??'N/A'}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="col-md-2">
                        <div class="form-group">
                            <button wire:click="showModalClient" type="button" class="btn btn-primary">Buscar
                                cliente</button>
                        </div>
                    </div>
                </div>
                {{-- Informacion Generales --}}
                @if ($current_client)
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="creation_date">Creacion & Desembolso</label>
                            <input type="date" wire:model='creation_date' class="form-control">
                        </div>
                        @error('creation_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="start_date">Fecha de primera cuota</label>
                            <input type="date" wire:model='start_date' class="form-control">
                        </div>
                        @error('start_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="loanCategory">Pantilla de Prestamo</label>
                            <select wire:model="loanCategory" class="form-control">
                                <option value="">Selecciona un tipo de prestamo</option>
                                @foreach ($loanCategories as $item)
                                <option value="{{$item->id}}">{{$item->description}}</option>
                                @endforeach
                            </select>

                        </div>
                        @error('loanCategory')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subAccountId">Cuenta Caja/Banco</label>
                            <select wire:model="subAccountId" class="form-control">
                                <option value="">Selecciona cuenta de caja/banco</option>
                                @foreach ($subAccounts as $subAccount)
                                <option value="{{$subAccount->id}}">{{$subAccount->description}}</option>
                                @endforeach
                            </select>

                        </div>
                        @error('subAccountId')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @endif


                <hr>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="loanTypeId">Categoria de Prestamo</label>
                            <select wire:model="loanTypeId" class="form-control">
                                <option value="">Selecciona una categoria de prestamo</option>
                                @foreach ($loanTypes as $loanType)
                                <option value="{{$loanType->id}}">{{$loanType->description}}</option>
                                @endforeach
                            </select>

                        </div>
                        @error('loanTypeId')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="billing_cycle_id">Frecuencia de pago</label>
                            <select wire:model="billing_cycle_id" class="form-control">
                                <option value="">Selecciona una frecuencia de pago</option>
                                @foreach ($billingCycles as $billiCycle)
                                <option value="{{$billiCycle->id}}">{{$billiCycle->description}}</option>
                                @endforeach
                            </select>

                        </div>
                        @error('billing_cycle_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rate">Tasa</label>
                            <input type="number" wire:model='rate' class="form-control">
                        </div>
                        @error('rate')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="amount">Monto del prestamo</label>
                            <input type="number" wire:model='amount' class="form-control">
                        </div>
                        @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fees_quantity">Cantidad de Cuotas</label>
                            <input type="number" wire:model='fees_quantity' class="form-control"
                                {{$loanTypeId==3?'disabled':''}}>
                        </div>
                        @error('fees_quantity')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cuota">Monto del cuota</label>
                            <input type="number" wire:model='cuota' class="form-control" disabled>
                        </div>
                        @error('cuota')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
        </div>
        @if ($current_client && $loanCategory)
        <div class="div">
            <button type="submit" class="btn btn-primary">Crear prestamo</button>
        </div>
        @endif
        <br>
        @if ($loanCategory && $loanTypeId ==3)
        <p class="badge badge-warning">Los prestamos a redito no tienen tabla de amortización, el interes dependera del
            monto adeudado al momento de realizar el pago </p>
        @elseif ($loanCategory && $loanTypeId == 2)
        <p class="badge badge-warning">El monto de la cuota para los prestamos tipo san sera igual al porcentaje por el
            capital. Ejemplo: <strong>5,000.00*10% la cuota es 500.00 </strong> </p>
        @endif
        <div>
            @if (session()->has('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </form>
    <div class="modal fade small" style="zindex:2000; opacity:100; display: {{$showClienteList?" block":"none"}}; ">
        <div class=" modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lista de Clientes</h4>
                <button wire:click="showModalClient" type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @include('admin.loans.partials.client_list')

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>

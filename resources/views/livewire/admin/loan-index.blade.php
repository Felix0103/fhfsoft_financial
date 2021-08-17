<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text"  class="form-control" placeholder='Ingrese el nombre o apellido de un cliente' />
        </div>
        @if ($loans->count())
             <div class="card-body">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th wire:click="order('id')" class="pointer" style="width:15%">
                                 Codigo
                                 @if ($sort == 'id')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th wire:click="order('clients.first_name')">
                                 Cliente
                                 @if ($sort == 'clients.first_name')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th>
                                Monto Prestamo
                            </th>
                             <th >
                                Proximo pago
                            </th>
                             <th colspan="2"></th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($loans as $loan)
                             <tr>
                                 <td  >{{$loan->doc_entry}}</td>
                                 <td >{{$loan->full_name}}</td>
                                 <td >{{ number_format( $loan->amount, 2,".",",")}}</td>
                                 <td style="text-align: center;"><strong>{{$loan->next_payment_date}}<br>({{$loan->next_payment_amount}})</strong></td>

                                 <td style="width:5%">
                                     @can('admin.accounts.edit')
                                         <a class="btn btn-primary btn-sm" href="{{route('admin.loans.edit', $loan)}}">Editar</a>
                                     @endcan
                                 </td>
                                 <td style="width:5%">
                                    @can('admin.payments.create')
                                        <a class="btn btn-primary btn-sm" href="{{route('admin.payments.show', Crypt::encrypt($loan->id))}}">Aplicar Pago</a>
                                    @endcan
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                     </table>
             </div>
             <div class="card-footer">
                 {{$loans->links()}}
             </div>
        @else
              <div class="card-body">
                  <strong>No hay registros</strong>
              </div>
        @endif
    </div>

 </div>

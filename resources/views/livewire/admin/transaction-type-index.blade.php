<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text"  class="form-control" placeholder='Ingrese el nombre o apellido de un cliente' />
        </div>
        @if ($transaction_types->count())
             <div class="card-body">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th wire:click="order('id')" class="pointer">
                                 ID
                                 @if ($sort == 'id')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th wire:click="order('description')">
                                 Descripción
                                 @if ($sort == 'description')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th wire:click="order('type')"  class="d-none d-sm-block">
                                 Categoria
                                 @if ($sort == 'type')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th colspan="2"></th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($transaction_types as $transaction_type)
                             <tr>
                                 <td >{{$transaction_type->id}}</td>
                                 <td >{{$transaction_type->description}}</td>
                                 <td class="d-none d-sm-block">{{($transaction_type->type==1?"Credito":"Debito")}}</td>
                                 <td width="10px">
                                     @can('admin.transactiontypes.edit')
                                         <a class="btn btn-primary btn-sm" href="{{route('admin.transactiontypes.edit', $transaction_type)}}">Editar</a>
                                     @endcan
                                 </td>
                                 <td width="10px">
                                    @can('admin.transactiontypes.destroy')
                                        {!! Form::open(['route'=>['admin.transactiontypes.destroy', $transaction_type], 'method'=>'delete']) !!}
                                            {!! Form::submit( ($transaction_type->active==1?'Desactivar':'Activar'), ['class'=> "btn btn-".($transaction_type->active==0?'success':'danger')." btn-sm"] ) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                     </table>
             </div>
             <div class="card-footer">
                 {{$transaction_types->links()}}
             </div>
        @else
              <div class="card-body">
                  <strong>No hay registros</strong>
              </div>
        @endif
    </div>

 </div>

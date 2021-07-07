<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text"  class="form-control" placeholder='Ingrese el nombre o apellido de un accounte' />
        </div>
        @if ($accounts->count())
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
                                 Nombre de Cuenta
                                 @if ($sort == 'description')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>

                             <th colspan="2"></th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($accounts as $account)
                             <tr>
                                 <td >{{$account->id}}</td>
                                 <td >{{$account->description}}</td>
                                 <td width="10px">
                                     @can('admin.accounts.edit')
                                         <a class="btn btn-primary btn-sm" href="{{route('admin.accounts.edit', $account)}}">Editar</a>
                                     @endcan
                                 </td>
                                 <td width="10px">
                                    @can('admin.accounts.destroy')
                                        {!! Form::open(['route'=>['admin.accounts.destroy', $account], 'method'=>'delete']) !!}
                                            {!! Form::submit( ($account->active==1?'Desactivar':'Activar'), ['class'=> "btn btn-".($account->active==0?'success':'danger')." btn-sm"] ) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                     </table>
             </div>
             <div class="card-footer">
                 {{$accounts->links()}}
             </div>
        @else
              <div class="card-body">
                  <strong>No hay registros</strong>
              </div>
        @endif
    </div>

 </div>

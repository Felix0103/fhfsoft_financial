<div>
    <div class="card">
        <div class="card-header">

            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <input wire:model="search" type="text"  class="form-control" placeholder='Ingrese el nombre o apellido de un cliente' />
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="custom-control form-check">
                        {!! Form::label('include_inactive', 'Inactivos',['class'=>'form-check-label']) !!}
                        {!! Form::checkbox('include_inactive', null, $includeInactive, ['wire:model'=>'includeInactive']) !!}

                    </div>

                </div>
            </div>
        </div>
        @if ($clients->count())
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
                             <th wire:click="order('first_name')">
                                 Nombre
                                 @if ($sort == 'first_name')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th wire:click="order('last_name')"  class="d-none d-sm-block">
                                 Apellido
                                 @if ($sort == 'last_name')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th colspan="2"></th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($clients as $client)
                             <tr>
                                 <td >{{$client->id}}</td>
                                 <td >{{$client->first_name}}</td>
                                 <td class="d-none d-sm-block">{{$client->last_name}}</td>
                                 <td width="10px">
                                     @can('admin.clients.edit')
                                         <a class="btn btn-primary btn-sm" href="{{route('admin.clients.edit', $client)}}">Editar</a>
                                     @endcan
                                 </td>
                                 <td width="10px">
                                    @can('admin.clients.destroy')
                                        {!! Form::open(['route'=>['admin.clients.destroy', $client], 'method'=>'delete']) !!}
                                            {!! Form::submit( ($client->active==1?'Desactivar':'Activar'), ['class'=> "btn btn-".($client->active==0?'success':'danger')." btn-sm"] ) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                     </table>
             </div>
             <div class="card-footer">
                 {{$clients->links()}}
             </div>
        @else
              <div class="card-body">
                  <strong>No hay registros</strong>
              </div>
        @endif
    </div>

 </div>

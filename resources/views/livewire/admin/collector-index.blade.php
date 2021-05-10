<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text"  class="form-control" placeholder='Ingrese el nombre o apellido de un cobrador' />
        </div>
        @if ($collectors->count())
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
                         @foreach ($collectors as $collector)
                             <tr>
                                 <td >{{$collector->id}}</td>
                                 <td >{{$collector->first_name}}</td>
                                 <td class="d-none d-sm-block">{{$collector->last_name}}</td>
                                 <td width="10px">
                                     @can('admin.collectors.edit')
                                         <a class="btn btn-primary btn-sm" href="{{route('admin.collectors.edit', $collector)}}">Editar</a>
                                     @endcan
                                 </td>
                                 <td width="10px">
                                    @can('admin.collectors.destroy')
                                        {!! Form::open(['route'=>['admin.collectors.destroy', $collector], 'method'=>'delete']) !!}
                                            {!! Form::submit( ($collector->active==1?'Desactivar':'Activar'), ['class'=> "btn btn-".($collector->active==0?'success':'danger')." btn-sm"] ) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                     </table>
             </div>
             <div class="card-footer">
                 {{$collectors->links()}}
             </div>
        @else
              <div class="card-body">
                  <strong>No hay registros</strong>
              </div>
        @endif
    </div>

 </div>

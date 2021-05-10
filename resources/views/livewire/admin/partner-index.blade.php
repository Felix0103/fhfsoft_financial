<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text"  class="form-control" placeholder='Ingrese el nombre o apellido de un socio' />
        </div>
        @if ($partners->count())
             <div class="card-body">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th wire:click="order('id')">
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
                         @foreach ($partners as $partner)
                             <tr>
                                 <td >{{$partner->id}}</td>
                                 <td >{{$partner->first_name}}</td>
                                 <td class="d-none d-sm-block">{{$partner->last_name}}</td>
                                 <td width="10px">
                                     @can('admin.partners.edit')
                                         <a class="btn btn-primary btn-sm" href="{{route('admin.partners.edit', $partner)}}">Editar</a>
                                     @endcan
                                 </td>
                                 <td width="10px">
                                    @can('admin.partners.destroy')
                                        {!! Form::open(['route'=>['admin.partners.destroy', $partner], 'method'=>'delete']) !!}
                                            {!! Form::submit( ($partner->active==1?'Desactivar':'Activar'), ['class'=> "btn btn-".($partner->active==0?'success':'danger')." btn-sm"] ) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                     </table>
             </div>
             <div class="card-footer">
                 {{$partners->links()}}
             </div>
        @else
              <div class="card-body">
                  <strong>No hay registros</strong>
              </div>
        @endif
    </div>

 </div>

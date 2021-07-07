<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" type="text"  class="form-control" placeholder='Ingrese el nombre o apellido de un accounte' />
        </div>
        @if ($loanCategories->count())
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
                                 Tipo de prestamo
                                 @if ($sort == 'description')
                                 <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                 @endif
                                 <i class="fas fa-sort float-right mt-1"></i>
                             </th>
                             <th wire:click="order('loan_types.description')">
                                Tipo de prestamo
                                @if ($sort == 'loan_types.description')
                                <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                @endif
                                <i class="fas fa-sort float-right mt-1"></i>
                            </th>

                             <th colspan="2"></th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($loanCategories as $loanCategory)
                             <tr>
                                 <td >{{$loanCategory->id}}</td>
                                 <td >{{$loanCategory->description}}</td>
                                 <td >{{$loanCategory->loan_type->description}}</td>
                                 <td width="10px">
                                     @can('admin.loancategories.edit')
                                         <a class="btn btn-primary btn-sm" href="{{route('admin.loancategories.edit', $loanCategory)}}">Editar</a>
                                     @endcan
                                 </td>
                                 <td width="10px">
                                    @can('admin.loancategories.destroy')
                                        {!! Form::open(['route'=>['admin.loancategories.destroy', $loanCategory], 'method'=>'delete']) !!}
                                            {!! Form::submit( ($loanCategory->active==1?'Desactivar':'Activar'), ['class'=> "btn btn-".($loanCategory->active==0?'success':'danger')." btn-sm"] ) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                             </tr>
                         @endforeach
                     </tbody>
                     </table>
             </div>
             <div class="card-footer">
                 {{$loanCategories->links()}}
             </div>
        @else
              <div class="card-body">
                  <strong>No hay registros</strong>
              </div>
        @endif
    </div>

 </div>

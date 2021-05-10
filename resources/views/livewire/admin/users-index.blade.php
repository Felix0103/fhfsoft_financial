<div>
   <div class="card">
       <div class="card-header">
           <input wire:model="search" type="text"  class="form-control" placeholder='Ingrese el nombre o correo de un usuario' />

       </div>
       @if ($users->count())
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
                            <th wire:click="order('name')">
                                Nombre
                                @if ($sort == 'name')
                                <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                @endif
                                <i class="fas fa-sort float-right mt-1"></i>
                            </th>
                            <th wire:click="order('email')"  class="d-none d-sm-block">
                                Email
                                @if ($sort == 'email')
                                <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                @endif
                                <i class="fas fa-sort float-right mt-1"></i>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td >{{$user->id}}</td>
                                <td >{{$user->name}}</td>
                                <td class="d-none d-sm-block">{{$user->email}}</td>
                                <td width="10px">
                                    @can('admin.users.edit')
                                        <a class="btn btn-primary btn-sm" href="{{route('admin.users.edit', $user)}}">Editar</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
            </div>
            <div class="card-footer">
                {{$users->links()}}
            </div>
       @else
             <div class="card-body">
                 <strong>No hay registros</strong>
             </div>
       @endif
   </div>

</div>

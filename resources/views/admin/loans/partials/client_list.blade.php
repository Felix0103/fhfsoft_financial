<div class="card">
    <div class="card-header">
        <input wire:model="searh_client" type="text" class="form-control"
            placeholder='Ingrese el nombre o apellido de un cliente' />
    </div>
    @if ($clients->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="pointer" style="width:15%">
                            Codigo
                        </th>
                        <th>
                            Cliente
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td> {{$client->sub_account->code}} </td>
                            <td> {{$client->sub_account->description}} </td>
                            <td width="10%"><button type="button" wire:click="selectClient({{$client}})"  class="btn btn-primary btn-sm">Seleccionar</button> </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $clients->links() }}
        </div>
    @else
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>No hay registros</strong>
                </div>
                <div class="col-md-6">
                    @can('admin.clients.create')
                        <a class="btn btn-secondary btn-sm float-right mr-1" href="{{route('admin.clients.create')}}">Crear nuevo cliente</a>
                    @endcan
                </div>
            </div>

        </div>
    @endif
</div>

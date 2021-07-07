<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-primary btn-sm float-right mr-1" data-toggle="modal" data-target="#sub-account-create">
            Nueva sub cuenta
        </button>
    </div>
         <div class="card-body">
            @if ($account->sub_accounts->count())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="pointer">
                                ID
                            </th>
                            <th>
                                Nombre de Sub Cuenta
                            </th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($account->sub_accounts as $sub_account)
                            <tr>
                                <td >@php echo $i++;          @endphp</td>
                                <td >{{$sub_account->description}}</td>
                                <td width="10px">
                                    @can('admin.accounts.edit')
                                        <button  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sub-account-edit{{$sub_account->id}}">
                                            Editar
                                        </button>
                                    @endcan
                                </td>
                                <td width="10px">
                                    @can('admin.accounts.destroy')
                                        {!! Form::open(['route'=>['admin.subaccounts.destroy', $sub_account], 'method'=>'delete']) !!}
                                            {!! Form::submit( ($sub_account->active==1?'Desactivar':'Activar'), ['class'=> "btn btn-".($sub_account->active==0?'success':'danger')." btn-sm"] ) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            <div class="modal fade" id="sub-account-edit{{$sub_account->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Actualizar de sub cuenta ({{$sub_account->description}})</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    {!! Form::model( $sub_account,['route'=>(['admin.subaccounts.update', $sub_account]), 'method'=>'put']) !!}
                                        <div class="modal-body">

                                        {!! Form::text('description', null, ['class'=>'form-control','placeholder' => "Digite el nombre de la sub cuenta de $account->description" ]) !!}
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        {!! Form::submit( 'Actualizar sub cuenta', ['class'=> "btn btn-primary"] ) !!}
                                        </div>
                                    {!! Form::close() !!}
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center"><strong >No hay sub cuentas</strong></p>
            @endif
         </div>

</div>

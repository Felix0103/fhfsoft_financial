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
                    <div class="custom-control">
                        <button wire:click="activeAll" class="btn btn-{{(!$onlyActive?'success':'danger')}}">{{(!$onlyActive?'Mostrar Activos':'Mostrar Inactivos')}}</button>
                    </div>

                </div>
            </div>

        </div>
        @if ($loans->count())
        @csrf
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
                             <th wire:click="order('loans.amount')">
                                Monto Prestamo
                                @if ($sort == 'loans.amount')
                                <i class="fas fa-sort-alpha-{{$direction=="desc"?"down":"up"}}-alt float-right mt-1"></i>
                                @endif
                                <i class="fas fa-sort float-right mt-1"></i>
                            </th>
                             <th >
                                Proximo pago
                            </th>
                             <th colspan="3"></th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($loans as $loan)
                             <tr id="loan_{{$loan->id}}">
                                 <td  >{{$loan->doc_entry}}</td>
                                 <td >{{$loan->full_name}}</td>
                                 <td >{{ number_format( $loan->amount, 2,".",",")}}</td>
                                 @if ($loan->active>0)
                                    <td style="text-align: center;"><strong>{{$loan->next_payment_date}}<br>({{$loan->next_payment_amount}})</strong></td>
                                    <td style="width:5%">
                                        @can('admin.loans.edit')
                                            <a class="btn btn-secondary btn-sm" href="{{route('admin.loans.edit', $loan)}}">Editar</a>
                                        @endcan
                                    </td>
                                    <td style="width:5%">
                                    @can('admin.payments.create')
                                        <a class="btn btn-primary btn-sm" href="{{route('admin.payments.show', Crypt::encrypt($loan->id))}}">Pago</a>
                                    @endcan
                                </td>
                                <td style="width:5%">
                                    @can('admin.loans.destroy')
                                        <a class="btn btn-danger btn-sm" onclick="deleted_loan({{$loan->id}})" href="#">Cancelar</a>
                                    @endcan
                                </td>
                                @else
                                    <td colspan="4"></td>
                                @endif
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
 @section('js')


 <script  language="javascript">

     function deleted_loan(loan_id){

        Swal.fire({
        title: 'Usted esta seguro?',
        text: "Usted no podra reversar esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Cancelalo!'
        }).then((result) => {
        if (result.isConfirmed) {


            fetch('/admin/loans/'+loan_id, {
                method: 'DELETE',
                headers: {
                'Content-Type': 'application/json'
                },
                body: '{"_token": "'+$('[name="_token"]').val()+'"}'
            })
            .then(response => {

                $('#loan_'+loan_id).hide();
                Swal.fire(
                'Desactivado!',
                'Este Prestamo ah sido desactivado.',
                'success'
                )
                // return response.json( )
            })




        }
        })
     }
 </script>


  @stop

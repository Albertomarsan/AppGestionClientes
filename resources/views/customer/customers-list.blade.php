@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-12 text-center mt-5">
        <h1>Lista de clientes</h1>
    </div>
</div>

<div class="row">
    <div class="col-12 text-center mt-3">
        <a type="button" href="{{ url('customers/create') }}" class="btn btn-primary" >Nuevo cliente</a>
    </div>
</div>

<div class="row">
    <div class="col-12 text-center mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Hobbies</th>
                    <th>Fecha creación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>
                        <a type="button" class="btn btn-sm btn-warning" href="{{ url("customers/edit/$customer->id") }}">Editar</a>
                        <a type="button" href="javascript:void(0)" data-id="{{ $customer->id }}" class="delete-customer btn btn-sm btn-danger">Borrar</a>
                    </td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->surname }}</td>
                    <td><ul>
                        @foreach($customer->hobbies as $hobbie)
                            <li>{{ $hobbie->name }}</li>
                        @endforeach
                    </ul></td>
                    <td>{{ $customer->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $( document ).ready(function() {
        $('.delete-customer').click(function() {
            let customerId = $(this).data('id');
            Swal.fire({
                title: '¿Seguro que desea borrar el cliente con id ' + customerId + '?',
                text: "La operación será irreversible",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirmar"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: "customers/delete/"+customerId,
                        dataType: 'json',
                        data: {'_token': "{{csrf_token()}}"},
                        success: function(data){
                            Swal.fire({
                                title: "Cliente borrado!",
                                icon: "success",
                                willClose: () => {
                                    window.location.reload();
                                }
                            });
                            
                        }
                    });
                }
            });            
        });
    });


</script>

@endsection
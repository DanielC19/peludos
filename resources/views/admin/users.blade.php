@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card m-5">
                    <div class="card-header">
                        <h2 class="center w-100">
                            Usuarios
                        </h2>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
										<th>Nombre</th>
										<th>Email</th>
										<th>Celular</th>
										<th>Código referido</th>
										<th>Fecha registro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->id }}</td>
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->cellphone }}</td>
											<td>{{ $user->referred }}</td>
											<td>{{ $user->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection

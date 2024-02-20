@extends('layouts.page')

@section('title','Usuarios')

@section('create-action-content')
<a href="#modalCrearUsuario" id="crearUser"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Usuario</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="usuarios" class="table invoice-data-table white border-radius-4 pt-1">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th><span>Id#</span></th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>CI</th>
            <th>Fecha de Nacimiento</th>
            <th>Departamento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td></td>
            <td></td>
            <td>
                <a href="{{ route('users.show') }}">{{ $user->id }}</a>
            </td>
            <td>{{ $user->name }} </td>
            <td>{{ $user->apellidos }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->ci }}</td>
            <td>{{ $user->fecha_nacimiento }}</td>
            <td>{{ $user->departamento() }}</td>
            <td>
                <a href="#modalCrearUsuario" id="editarUser" class="btn btn-floating orange modal-trigger"
                    data-user="{{ $user }}" title="Editar Usuario">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $user->id }}" title="Eliminar Usuario">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</section>
@endsection

@section('additional-components')
@include('users.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 10;
    let searchString = 'Buscar Usuario';
    //For Destroy
    let key_id ='user_id';
    //For Edit
    let user_id = null;
</script>
<script>
    let ruta_update_user = "{{ route('users.update') }}";
    let ruta_guardar_user = "{{ route('users.store') }}"
    let ruta_show_user = "{{ route('users.show') }}";
    let ruta_eliminar = "{{ route('users.deleteUser') }}";
    let ruta_index = "{{ route('users.index') }}";
</script>
<script>
    let nombres = document.getElementById("nombres");
    let apellidos = document.getElementById("apellidos");
    let ci = document.getElementById("ci");
    let fecha_nacimiento = document.getElementById("fecha_nacimiento");
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let avatar = document.getElementById("avatar");
    let departamento_id = document.getElementById("departamento_id");
</script>
<script src="{{asset('js/scripts/users/submitForm.js')}}"></script>
<script src="{{asset('js/scripts/users/create.js')}}"></script>
<script src="{{asset('js/scripts/users/edit.js')}}"></script>
@endsection
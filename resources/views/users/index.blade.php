{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Usuarios')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/dataTables.checkboxes.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
@endsection

@section('content')
<section class="invoice-list-wrapper section">
    <div class="invoice-create-btn">
        <a href="#modalCrearUsuario" id="crearUser"
            class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
            <i class="material-icons">add</i>
            <span class="hide-on-small-only">Crear Usuario</span>
        </a>
    </div>
    <div class="filter-btn">
        <a class='dropdown-trigger btn waves-effect waves-light purple darken-1 border-round' href='#'
            data-target='btn-filter'>
            <span class="hide-on-small-only">Filtros</span>
            <i class="material-icons">keyboard_arrow_down</i>
        </a>
        <ul id='btn-filter' class='dropdown-content px-2'>
            <li><a href="#!">Todos</a></li>
            <li><a href="#!">Baneados</a></li>
        </ul>
    </div>
    <div class="responsive-table">
        <table class="table invoice-data-table white border-radius-4 pt-1">
            <thead>
                <tr>
                    <!-- data table responsive icons -->
                    <th></th>
                    <!-- data table checkbox -->
                    <th></th>
                    <th>
                        <span>Id#</span>
                    </th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>CI</th>
                    <th>Fecha de Nacimiento</th>
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
                    <td>
                        <a href="#modalCrearUsuario" id="editarUser" class="btn btn-floating orange modal-trigger"
                            data-user="{{ $user }}" title="Editar Usuario">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="#" id="eliminarUser" class="btn btn-floating red" data-user="{{ $user }}"
                            title="Eliminar Usuario">
                            <i class="material-icons delete">delete</i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('users.modals.form')
</section>

@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/js/datatables.checkboxes.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script>
    let ruta_index_user = "{{ route('users.index') }}";
    let ruta_update_user = "{{ route('users.update') }}";
    let ruta_guardar_user = "{{ route('users.store') }}"
    let ruta_eliminar_user = "{{ route('users.deleteUser') }}";
    let ruta_show_user = "{{ route('users.show') }}";
</script>
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{asset('js/scripts/users/index.js')}}"></script>
<script src="{{asset('js/scripts/users/create.js')}}"></script>
<script src="{{asset('js/scripts/users/edit.js')}}"></script>
<script src="{{asset('js/scripts/users/destroy.js')}}"></script>
@endsection
{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Listado Tipos Precios')

{{-- vendors styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/page-users.css') }}">
@endsection

{{-- page content --}}
@section('content')
<!-- users list start -->
<section class="users-list-wrapper section">

    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <!-- datatable start -->
                <div class="responsive-table">
                    <table id="users-list-datatable" class="table">
                        <thead>
                            <tr>
                                <th>Fecha Sincronizacion</th>
                                <th>Cliente Sincronizado</th>
                                <th>Tipo Precio Sincronizado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->created_at }}</td>
                                <td> <span class="green-text">{{ $cliente->nombre_cliente }}</span>
                                    </span> </td>

                                <td>
                                    @foreach (\App\Enums\TiposPrecios::cases() as $case)
                                    @if ($case->value == $cliente->tipo_precio)
                                    <span class="red-text">{{ $case->name }}</span>
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('catalogos_productos.tipo_precio_edit', $cliente) }}"><i
                                            class="material-icons">cached</i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
        </div>
    </div>
</section>
<!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{ asset('js/scripts/tipos_precios/index.js') }}"></script>
<script>

</script>
@endsection
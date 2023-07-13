{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Listado Configuraciones Impuestos')

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
        <div class="users-list-filter">
            <div class="card-panel">
                <div class="row">
                    <form>
                        <div class="col s12 m6 l3">
                            <label for="users-list-verified">Verified</label>
                            <div class="input-field">
                                <select class="form-control" id="users-list-verified">
                                    <option value="">Any</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col s12 m6 l3">
                            <label for="users-list-role">Role</label>
                            <div class="input-field">
                                <select class="form-control" id="users-list-role">
                                    <option value="">Any</option>
                                    <option value="User">User</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            </div>
                        </div>
                        <div class="col s12 m6 l3">
                            <label for="users-list-status">Status</label>
                            <div class="input-field">
                                <select class="form-control" id="users-list-status">
                                    <option value="">Any</option>
                                    <option value="Active">Active</option>
                                    <option value="Close">Close</option>
                                    <option value="Banned">Banned</option>
                                </select>
                            </div>
                        </div>
                        <div class="col s12 m6 l3 display-flex align-items-center show-btn">
                            <button type="submit" class="btn btn-block indigo waves-effect waves-light">Show</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="users-list-table">
            <div class="card">
              <div class="card-content">
                <!-- datatable start -->
                <div class="responsive-table">
                  <div class="row">
                    <div class="col s12">
                      <div class="right-align">
                        <!-- create invoice button-->
                        <div class="invoice-create-btn">
                          <a href="{{ route('configuraciones_impuestos.create') }}"
                            class="btn waves-effect waves-light invoice-create border-round z-depth-4">
                            <i class="material-icons">add</i>
                            <span class="hide-on-small-only">Create Configuracion</span>
                          </a>
                        </div> <br>
                      </div>
                    </div>
                  </div>

                        <table id="users-list-datatable" class="table">

                            <thead>
                                <tr>
                                    <th></th>
                                    <th>id</th>
                                    <th>Nombre Sistema</th>
                                    <th>Fecha Registro</th>
                                    <th>Codigo Sistema</th>
                                    <th>Empresa Asociada</th>
                                    <th>edit</th>
                                    <th>view</th>
                                    <th>delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taxesConfigurations as $taxConfiguration)
                                    <tr>
                                        <td></td>
                                        <td>{{ $taxConfiguration->id }}</td>
                                        <td><a href="{{ asset('page-users-view') }}">{{ $taxConfiguration->nombre_sistema }}</a></td>
                                        <td>{{ $taxConfiguration->created_at }}</td>
                                        <td>{{ $taxConfiguration->codigo_sistema }}</td>
                                        <td> <span class="green-text">{{ $taxConfiguration->empresa->nombre_empresa }}</span>
                                            </span> </td>
                                        <td><a href="{{ asset('page-users-edit') }}"><i class="material-icons">edit</i></a>
                                        </td>
                                        <td><a href="{{ asset('page-users-view') }}"><i
                                                    class="material-icons">remove_red_eye</i></a></td>
                                        <td><span><a onclick="eliminar('{{ $taxConfiguration->id }}')"><i
                                                        class="material-icons">delete_outline</i></a></span></td>
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
    <script src="{{ asset('js/scripts/configuraciones_impuestos/index.js') }}"></script>
    <script>
        let ruta_index_configuraciones_impuestos = "{{ route('configuraciones_impuestos.index') }}";
        let ruta_eliminar_configuraciones_impuestos = "{{ route('configuraciones_impuestos.destroy') }}";
    </script>
@endsection

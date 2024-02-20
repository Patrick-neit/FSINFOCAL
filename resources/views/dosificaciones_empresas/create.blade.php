{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Dosificacion Empresa ')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/select2-materialize.css') }}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/page-users.css') }}">
@endsection

{{-- page content --}}
@section('content')
<!-- users edit start -->
<div class="section users-edit">
    <div class="card">
        <div class="card-content">
            <!-- <div class="card-body"> -->
            <ul class="tabs mb-2 row">
                <li class="tab">
                    <a class="display-flex align-items-center active" id="account-tab" href="#account">
                        <i class="material-icons mr-1">person_outline</i><span>Account</span>
                    </a>
                </li>
                <li class="tab">
                    <a class="display-flex align-items-center" id="information-tab" href="#information">
                        <i class="material-icons mr-2">error_outline</i><span>Information</span>
                    </a>
                </li>
            </ul>
            <div class="divider mb-3"></div>
            <div class="row">
                <div class="col s12" id="account">
                    <!-- users edit media object start -->
                    <div class="media display-flex align-items-center mb-2">
                        <a class="mr-2" href="#">
                            <img src="{{ asset('images/avatar/avatar-11.png') }}" alt="users avatar"
                                class="z-depth-4 circle" height="64" width="64">
                        </a>
                        <div class="media-body">
                            <h5 class="media-heading mt-0">Asignar Dosificacion Empresa</h5>
                            <div class="user-edit-btns display-flex">
                                <a href="#" class="btn-small indigo">Change</a>
                                <a href="#" class="btn-small btn-light-pink">Reset</a>
                            </div>
                        </div>
                    </div>
                    <!-- users edit media object ends -->
                    <!-- users edit account form start -->
                    <form>
                        <div class="row">
                            <input type="hidden" value="{{$empresa->id}}" id="empresa_id">
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s6 input-field">
                                        <input id="empresa_nombre" name="empresa_nombre" type="text" class="validate"
                                            value="{{ $empresa->nombre_empresa }}" data-error=".errorTxt1" readonly
                                            required>
                                        <label for="empresa_nombre">Empresa Usuario</label>
                                        <small class="errorTxt1"></small>
                                    </div>

                                    <div class="col s12 m6">
                                        <div class="col s12 input-field">
                                            <label>Tipos Facturas</label>
                                            <select name="tipo_factura_id" id="tipo_factura_id"
                                                class="select2 browser-default">
                                                @foreach ($tiposFacturas as $tipoFactura )
                                                <option value="{{$tipoFactura->codigo_clasificador}}">
                                                    {{$tipoFactura->descripcion}}</option> @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m6">
                                    <div class="col s12 input-field">
                                        <label>Documento Sector Empresa</label>
                                        <select name="documento_sector_id" id="documento_sector_id"
                                            onchange="handleChange()" class="select2 browser-default">
                                            @foreach ($documentoSectores as $documento )
                                            <option value="{{$documento->codigo_clasificador}}">
                                                {{$documento->descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s6 m4">
                                    <div class="col s12 input-field">
                                        <label>Numeracion Inicio Facturas</label>
                                        <input id="nro_inicio_factura" name="nro_inicio_factura" type="text"
                                            class="validate" data-error=".errorTxt1">
                                    </div>
                                </div>
                                <div class="col s6 m4">
                                    <div class="col s12 input-field">
                                        <label>Numeracion Fin Facturas</label>
                                        <input id="nro_fin_factura" name="nro_fin_factura" type="text" class="validate"
                                            data-error=".errorTxt1">
                                    </div>
                                </div>
                                <div class="col s6 m4 input-field">
                                    <input id="empresa_cafc" name="empresa_cafc" type="text" class="validate"
                                        data-error=".errorTxt1">
                                    <label for="empresa_cafc">CAFC</label>
                                    <small class="errorTxt1"></small>
                                </div>
                            </div>



                            <div class="col s12">
                                <table class="mt-1">
                                    <thead>
                                        <tr>
                                            <th>Empresa Dosificacion</th>
                                            <th>Descripcion DS</th>
                                            <th>Tipo Factura DS</th>
                                            <th>ACCION</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @if (session('dosificaciones_sucursales_detalle'))
                                        @foreach (session('dosificaciones_sucursales_detalle') as $indice => $item)
                                        <tr>
                                            <td style="text-align: center;">
                                                {{ $item['empresa_nombre'] }}
                                            </td>
                                            <td style="text-align: center;"> {{ $item['descripcion_ds'] }} </td>
                                            <td style="text-align: center;"> {{ $item['tipo_factura_ds'] }} </td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-danger" onclick="eliminar(i);">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button id="storeDosificacionButton" class="btn indigo">
                                    Asignar Dosificacion</button>
                                <button type="button" class="btn btn-light">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit account form ends -->
                </div>
                <div class="col s12" id="information">
                    <!-- users edit Info form start -->
                    <form id="infotabForm">
                        <div class="row">
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12">
                                        <h6 class="mb-2"><i class="material-icons mr-1">link</i>Social Links</h6>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input class="validate" type="text" value="https://www.twitter.com/">
                                        <label>Twitter</label>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input class="validate" type="text" value="https://www.facebook.com/">
                                        <label>Facebook</label>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input class="validate" type="text">
                                        <label>Google+</label>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="linkedin" name="linkedin" class="validate" type="text">
                                        <label for="linkedin">LinkedIn</label>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input class="validate" type="text" value="https://www.instagram.com/">
                                        <label>Instagram</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12">
                                        <h6 class="mb-4"><i class="material-icons mr-1">person_outline</i>Personal
                                            Info</h6>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="datepicker" name="datepicker" type="text"
                                            class="birthdate-picker datepicker" placeholder="Pick a birthday"
                                            data-error=".errorTxt4">
                                        <label for="datepicker">Birth date</label>
                                        <small class="errorTxt4"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <select id="accountSelect">
                                            <option>USA</option>
                                            <option>India</option>
                                            <option>Canada</option>
                                        </select>
                                        <label>Country</label>
                                    </div>
                                    <div class="col s12">
                                        <label>Languages</label>
                                        <select class="browser-default" id="users-language-select2" multiple="multiple">
                                            <option value="English" selected>English</option>
                                            <option value="Spanish">Spanish</option>
                                            <option value="French">French</option>
                                            <option value="Russian">Russian</option>
                                            <option value="German">German</option>
                                            <option value="Arabic" selected>Arabic</option>
                                            <option value="Sanskrit">Sanskrit</option>
                                        </select>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="phonenumber" type="text" class="validate" value="(+656) 254 2568">
                                        <label for="phonenumber">Phone</label>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="address" name="address" type="text" class="validate"
                                            data-error=".errorTxt5">
                                        <label for="address">Address</label>
                                        <small class="errorTxt5"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12">
                                <div class="input-field">
                                    <input id="websitelink" name="websitelink" type="text" class="validate">
                                    <label for="websitelink">Website</label>
                                </div>
                                <label>Favourite Music</label>
                                <div class="input-field">
                                    <select class="browser-default" id="users-music-select2" multiple="multiple">
                                        <option value="Rock">Rock</option>
                                        <option value="Jazz" selected>Jazz</option>
                                        <option value="Disco">Disco</option>
                                        <option value="Pop">Pop</option>
                                        <option value="Techno">Techno</option>
                                        <option value="Folk" selected>Folk</option>
                                        <option value="Hip hop">Hip hop</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col s12">
                                <label>Favourite movies</label>
                                <div class="input-field">
                                    <select class="browser-default" id="users-movies-select2" multiple="multiple">
                                        <option value="The Dark Knight" selected>The Dark Knight
                                        </option>
                                        <option value="Harry Potter" selected>Harry Potter</option>
                                        <option value="Airplane!">Airplane!</option>
                                        <option value="Perl Harbour">Perl Harbour</option>
                                        <option value="Spider Man">Spider Man</option>
                                        <option value="Iron Man" selected>Iron Man</option>
                                        <option value="Avatar">Avatar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col s12 display-flex justify-content-end mt-1">
                                <button type="submit" class="btn indigo">
                                    Save changes</button>
                                <button type="button" class="btn btn-light">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit Info form ends -->
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
</div>
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{ asset('vendors/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{ asset('js/scripts/dosificaciones_empresas/create.js') }}"></script>
<script>
    let ruta_eliminar_detalle_dosificacion = "{{ route('dosificaciones_empresas.eliminarDetalle') }}";
        let ruta_dosificacion_empresa = "{{ route('dosificaciones_empresas.getDataDocumentoSector') }}";
        let ruta_index_dosificacion = "{{ route('dosificaciones_empresas.index') }}";
        let ruta_store_dosificacion = "{{ route('dosificaciones_empresas.store') }}";


</script>
@endsection
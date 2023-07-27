{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Usuarios Registrados')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-sidebar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-contacts.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- Add new contact popup -->
<div class="contact-overlay"></div>
<div style="bottom: 54px; right: 19px;" class="fixed-action-btn direction-top">
  <a class="btn-floating btn-large primary-text gradient-shadow contact-sidebar-trigger" href="#modal1">
    <i class="material-icons">person_add</i>
  </a>
</div>
<!-- Add new contact popup Ends-->

<!-- Sidebar Area Starts -->
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">perm_identity</i> Usuarios
          </h5>
          <div class="mt-10 pt-2">
            <p class="m-0 subtitle font-weight-700">Total number of users</p>
            <p class="m-0 text-muted">1457 users</p>
          </div>
        </div>
      </div>
      <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1">
        <div class="sidebar-list-padding app-sidebar sidenav" id="contact-sidenav">
          <ul class="contact-list display-grid">
            <li class="sidebar-title">Filters</li>
            <li class="active"><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2">
                  perm_identity </i> All
                Contact</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> history </i> Frequent</a>
            </li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> star_border </i> Starred
                Contacts</a></li>
            <li class="sidebar-title">Options</li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> keyboard_arrow_down </i>
                Import</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> keyboard_arrow_up </i>
                Export</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="material-icons mr-2"> print </i> Print</a></li>
            <li class="sidebar-title">Department</li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="purple-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Engineering</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i class="amber-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Sales</a></li>
            <li><a href="javascript:void(0)" class="text-sub"><i
                  class="light-green-text material-icons small-icons mr-2">
                  fiber_manual_record </i> Support</a></li>
          </ul>
        </div>
      </div>
      <a href="#" data-target="contact-sidenav" class="sidenav-trigger hide-on-large-only"><i
          class="material-icons">menu</i></a>
    </div>
  </div>
</div>
<!-- Sidebar Area Ends -->

<!-- Content Area Starts -->
<div class="content-area content-right">
  <div class="app-wrapper">
    <div class="datatable-search">
      <i class="material-icons mr-2 search-icon">search</i>
      <input type="text" placeholder="Search Contact" class="app-filter" id="global_filter">
    </div>
    <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
      <div class="card-content p-0">
        <table id="data-table-contact" class="display" style="width:100%">
          <thead>
            <tr>
              <th class="background-image-none center-align">
                <label>
                  <input type="checkbox" onClick="toggle(this)" />
                  <span></span>
                </label>
              </th>
              <th>User</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Empresa Asignada</th>
              <th>Favorite</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user )
            <tr>
                <td class="center-align contact-checkbox">
                <label class="checkbox-label">
                  <input type="checkbox" name="foo" />
                  <span></span>
                </label>
              </td>
              <td><span class="avatar-contact avatar-online"><img src="{{asset('images/avatar/avatar-1.png')}}"
                    alt="avatar"></span></td>
              <td>{{$user->name}} </td>
              <td>{{$user->email}}</td>
              <td><span class="chip lighten-5 orange orange-text">S/A</span></td>


              <td><span class="favorite"><i class="material-icons"> star_border </i></span></td>
              <td><span>
                <a onclick="eliminar('{{$user->id}}')">
                    <i class="material-icons delete">delete_outline</i>
                </a>

            </span></td>
            </tr>
            @endforeach


          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Content Area Ends -->

<!--  Contact sidebar -->
<div class="contact-compose-sidebar">
  <div class="card quill-wrapper">
    <div class="card-content pt-0">
      <div class="card-header display-flex pb-2">
        <h3 class="card-title contact-title-label">Registra Nuevo Usuario</h3>
        <div class="close close-icon">
          <i class="material-icons">close</i>
        </div>
      </div>
      <div class="divider"></div>
      <!-- form start -->
      <form class="edit-contact-item mb-5 mt-5">

        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix"> perm_identity </i>
            <input id="first_name" type="text" name="nombre" value="{{old('nombre')}}" class="validate">
            <label for="first_name">Nombre Completo</label>
          </div>


        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix"> email </i>
            <input id="email" type="email" name="email" class="validate">
            <label for="email">Email</label>
          </div>

          <div class="input-field col s12">
            <select id="estado">
              <option value="" disabled selected>Choose your option</option>
              <option value="A">Activo</option>
              <option value="I">Inactivo </option>
            </select>
            <label> Selecciona Estado</label>
        </div>
        </div>
        <div class="card-action pl-0 pr-0 right-align">
            <button  id="registrarDocente" class="btn-small waves-effect waves-light add-contact">
                <span>Registrar</span>
            </button>
            <button class="btn-small waves-effect waves-light update-contact display-none">
                <span>Actualizar</span>
            </button>
        </div>
        </form>
      <!-- form start end-->
    </div>
  </div>
</div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/docentes/index.js')}}"></script>
<script>
    let ruta_guardar_docente = "{{route('docentes.store')}}";
    let ruta_index_docente   = "{{route('docentes.index')}}";
    let ruta_eliminar_docente = "{{route('docentes.destroy')}}";
</script>
@endsection

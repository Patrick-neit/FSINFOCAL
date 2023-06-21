{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Ejemplo')

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

<div class="section">
    <div class="card">
      <div class="card-content">
        <h4 class="caption">TITULOS</h4>
      </div>
    </div>

    <div class="row">
      <div class="col s12">
        <div id="tap-target" class="card card-tabs">
          <div class="card-content">
            <div class="card-title">
              <div class="row">
                <div class="col s12 m6 l6">
                  <h4 class="card-title">Tap Target</h4>
                </div>
              </div>
            </div>
            <div id="view-tap-target">
              <div class="row">
                <div class="col s12">
                  <p>JHONA Y PATRICIO GATITAS </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/css-grid.js')}}"></script>
@endsection

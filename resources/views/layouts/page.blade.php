@extends('layouts.contentLayoutMaster')

{{-- Title Page --}}

@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/dataTables.checkboxes.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/select2-materialize.css') }}">
@endsection

@section('page-style')
<style>
    label:after {
        transition-property: all !important;
        font-size: 0.8rem;
        transform: none;
    }

    label:not(.active):after {
        transform: translateY(-140%);
    }
</style>
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection

@section('content')
<section class="invoice-list-wrapper section">
    <div class="invoice-create-btn">
        @yield('create-action-content')
    </div>
    <div class="responsive-table">
        @yield('table-content')
    </div>
    @include('common.modalConfirmDelete')
    @yield('additional-components')
</section>
@endsection

@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/js/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('vendors/select2/select2.full.min.js') }}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{asset('vendors/jquery-validation/additional-methods.js') }}"></script>
<script src="{{asset('vendors/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{asset('vendors/jquery-validation/localization/messages_es.js') }}"></script>
@endsection

@section('page-script')
@yield('page-custom-scripts')
<script>
    const csrfToken = document.head.querySelector(
        "[name~=csrf-token][content]"
        ).content;
</script>
<script>
    $(document).ready(function(){
        $('select').formSelect()
    })
</script>
<script src="{{ asset('js/scripts/advance-ui-modals.js') }}"></script>
<script src="{{ asset('js/scripts/common/table.js') }}"></script>
<script src="{{ asset('js/scripts/common/actions/destroy.js') }}"></script>
@endsection
@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.list') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
  <div class="container-fluid">
    <h2>
      <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
      {{-- <small id="datatable_info_stack">{!! $crud->getSubheading() ?? '' !!}</small> --}}
    </h2>
  </div>
@endsection

@section('content')
  <!-- Default box -->
  <div class="container">

      <div class="row mt-3">
          @include('admin.upgrade.subscribeCard')
          
    </div>
        
  </div>

@endsection

@extends(backpack_view('blank'))

@section('after_styles')
<style media="screen">
    .backpack-profile-form .required::after {
        content: ' *';
        color: red;
    }

</style>
@endsection

@php
$breadcrumbs = [
trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
"Content" => false,
];
@endphp

@section('header')
<section class="content-header">
    <div class="container-fluid mb-3">
        <h1>Content</h1>
    </div>
</section>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card subscripion-card">
            <div class="card-body">
                <h3 class="card-title"> lorem </h3>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus ex quasi assumenda nulla voluptatibus
                minima omnis sint eos! Sed sunt vel odit modi accusamus quaerat iusto optio assumenda, dignissimos
                dicta.

                <button class="btn btn-outline-primary btn-block mt-4" data-video-url="holdon">
                   <i class="nav-icon las la-play mr-1"></i>    Video
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

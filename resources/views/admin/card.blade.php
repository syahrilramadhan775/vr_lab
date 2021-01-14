@php 

$tools = [
    [
        'style' => 'bg-success',
        'label' => 'Medium',
],
[
        'style' => 'bg-primary',
        'label' => 'High',
]
]
@endphp
<div class="row">
    @foreach(range(1,5) as $r)
    @php
    $rad = $tools[array_rand($tools)];
    @endphp
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card card-content">

            <div class="card-cover">
                <div class="lock-content-cover">
                    <i class="icon nav-icon las la-lock"></i>
                </div>
            <img src="https://www.shutterstock.com/blog/wp-content/uploads/sites/5/2017/08/facebook-cover-photo-header.jpg?w=1440&h=960&crop=1&s=1" class="bd-placeholder-img card-img-top">
            </div>

            <div class="card-body">
                
                <span class="px-2 py-1 bg-success rounded">Medium</span>
                <h5 class="mt-3 text-overflow"> indah nya menabung bersama part ({{$r}}) ...
                </h5>
                <div class="card-subtitle text-muted mb-3">Dessert</div>

                
                <p class="card-text text-muted">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus ex quasi assumenda nulla voluptatibus
                    minima omnis sint eos! Sed sunt vel odit modi accusamus quaerat iusto optio assumenda, dignissimos
                    dicta.
                </p>

                

                <button class="btn btn-primary btn-block mt-4" data-video-url="holdon">
                    <i class="nav-icon las la-eye mr-1"></i> Details
                </button>

                {{-- <a href="javascript:void(0)" class="card-link">Lihat Lebih Banyak...</a> --}}
            </div>
        </div>
    </div>
    @endforeach
</div>

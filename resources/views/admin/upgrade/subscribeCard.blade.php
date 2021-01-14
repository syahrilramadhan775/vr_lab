@section('after_styles')
<style>
    .btn h5 {
        margin: 0px;
    }

</style>
@endsection
@php
$userSubs =  backpack_user()->UserSubcription->SubcriptionType->order;
@endphp
{{--  LOW CARD SUBSCRIPTION --}}
<div class="col-12 col-md-4">
    <!-- Card -->
    <div class="card mb-6 mb-md-0 card-subscription">
        <div class="card-body">

            <!-- Preheading -->
            <div class="text-center mb-3">
                <h3 class="badge badge-pill badge-info-soft badge-dark px-3">
                    <span class="h6 text-uppercase">Low</span>
                </h3>
            </div>

            <!-- Price -->
            <div class="d-flex justify-content-center">
                {{-- <span class="price display-2 mb-0">0</span>
                <span class="h2 mb-2 mt-auto">k</span> --}}
                <span class="price display-3 mb-3">Free</span>

                

                <!-- <span class="h2 align-self-end mb-1">/project</span> -->
            </div>

            <div class="d-flex text-muted">
                <i class="las la-check my-auto mr-2 text-success"></i>
                (example)50 contents
            </div>

            <p class="mb-6 mt-3"><small class="text-muted">Kamu Mendapat kan 50 example konten yang dapat membuat siswa
                    / siswa lebih giat belajar di karenakan menyenangkan nya pembelajaran </small></p>

            <!-- Button -->
            <a href="https://backpackforlaravel.com/user/my-licenses/commercial-license/form"
                class="btn btn-block btn-primary lift py-3  @if($userSubs <= 3  ) disabled @endif"   >
                <h5>
                    Subcribe Now <i class="las la-arrow-right ml-3"></i>
                </h5>
            </a>
        </div>
    </div>

</div>

{{--  LOW CARD SUBSCRIPTION --}}
<div class="col-12 col-md-4">
  <!-- Card -->
  <div class="card mb-6 mb-md-0 card-subscription">
      <div class="card-body">

          <!-- Preheading -->
          <div class="text-center mb-3">
              <h3 class="badge badge-pill badge-success px-3">
                  <span class="h6 text-uppercase">Medium</span>
              </h3>
          </div>

          <!-- Price -->
          <div class="d-flex justify-content-center">
              <span class="price display-2 mb-0">?</span>
              <span class="h2 mb-2 mt-auto">k</span>

              <!-- <span class="h2 align-self-end mb-1">/project</span> -->
          </div>

          <div class="d-flex text-muted">
              <i class="las la-check my-auto mr-2 text-success"></i>
              (example)300 contents
          </div>

          <p class="mb-6 mt-3"><small class="text-muted">Kamu Mendapat kan 300 example konten yang dapat membuat siswa
                  / siswa lebih giat belajar di karenakan menyenangkan nya pembelajaran </small></p>

          <!-- Button -->
          <a href="https://backpackforlaravel.com/user/my-licenses/commercial-license/form"
              class="btn btn-block btn-primary lift py-3 @if($userSubs <= 2 ) disabled @endif">
              <h5>
                  Subcribe Now <i class="las la-arrow-right ml-3"></i>
              </h5>
          </a>

      </div>
  </div>

</div>

{{-- HIGH CARD SUBSCRIPTION --}}
<div class="col-12 col-md-4">
  <!-- Card -->
  <div class="card mb-6 mb-md-0 card-subscription">
      <div class="card-body">

          <!-- Preheading -->
          <div class="text-center mb-3">
              <h3 class="badge badge-pill badge-info-soft badge-primary px-3">
                  <span class="h6 text-uppercase">HIGH</span>
              </h3>
          </div>

          <!-- Price -->
          <div class="d-flex justify-content-center">
              <span class="price display-2 mb-0">?</span>
              <span class="h2 mb-2 mt-auto">k</span>

              <!-- <span class="h2 align-self-end mb-1">/project</span> -->
          </div>

          <div class="d-flex text-muted">
              <i class="las la-check my-auto mr-2 text-success"></i>
              (example)500 contents
          </div>

          <p class="mb-6 mt-3"><small class="text-muted">Kamu Mendapat kan 500 example konten yang dapat membuat siswa
                  / siswa lebih giat belajar di karenakan menyenangkan nya pembelajaran </small></p>

          <!-- Button -->
          <a href="https://backpackforlaravel.com/user/my-licenses/commercial-license/form"
              class="btn btn-block btn-primary lift py-3 @if($userSubs <= 1 ) disabled @endif">
              <h5>
                  Subcribe Now <i class="las la-arrow-right ml-3"></i>
              </h5>
          </a>

      </div>
  </div>

</div>

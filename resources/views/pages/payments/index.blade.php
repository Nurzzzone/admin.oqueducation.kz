@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', trans('pages.payments'))

@section('content')
<!-- error 500 -->
<section class="row flexbox-container justify-content-center mt-4">
  <div class="col-xl-6 col-md-7 col-9">
      <!-- w-100 for IE specific -->
    <div class="card bg-transparent shadow-none"> 
      <div class="card-content">
      <div class="card-body text-center bg-transparent miscellaneous">
          <img src="{{asset('images/pages/500.png')}}" class="img-fluid my-3" alt="branding logo">
          <h1 class="error-title mt-1">{{ trans('errors.maintenance.title') }}</h1>
          <p class="px-2">
            {{ trans('errors.maintenance.message') }}
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- error 500 end -->
@endsection
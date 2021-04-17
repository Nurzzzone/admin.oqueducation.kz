@extends('layouts.fullLayoutMaster')
{{-- page title --}}
@section('title','Not-authorized')

@section('content')
<!-- not authorized start -->
  <section class="row flexbox-container">
    <div class="col-xl-7 col-md-8 col-12 mx-auto">
      <div class="card bg-transparent shadow-none">
        <div class="card-content">
          <div class="card-body text-center">
            <img src="{{asset('images/pages/not-authorized.png')}}" class="img-fluid" alt="not authorized" width="400">
            <h1 class="error-title">{{ __('locale.'.'403-1') }}</h1>
            <p>{{ __('locale.'.'403-2') }}</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary round glow mt-2">{{ __('locale.'.'BackHome') }}</a>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- not authorized end -->
@endsection
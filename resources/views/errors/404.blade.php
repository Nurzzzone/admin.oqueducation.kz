@extends('layouts.fullLayoutMaster')
{{-- page title --}}
@section('title','Error 404')

@section('content')
<!-- error 404 -->
<section class="row flexbox-container">
  <div class="col-xl-6 col-md-7 col-9 mx-auto">
    <div class="card bg-transparent shadow-none">
      <div class="card-content">
        <div class="card-body text-center bg-transparent miscellaneous">
          <h1 class="error-title mb-2 ml-4">Page Not Found :(</h1>
          <img class="img-fluid" src="{{asset('images/pages/404.png')}}" alt="404 error">
          <a href="{{ route('dashboard') }}" class="btn btn-primary round glow mt-3">BACK TO HOME</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- error 404 end -->
@endsection
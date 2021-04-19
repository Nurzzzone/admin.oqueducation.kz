@extends('layouts.contentLayoutMaster')

@section('title', __('locale.pages.classes_free'))

@section('content')
<section >

  {{-- create new free-class --}}
  <div class="col-12 mb-2">
    <div class="row align-items-center">
      <a class="btn btn-success" href="{{ route('classes-free.create') }}">
        <span>@lang('locale.buttons.create')</span>
        <i class="ficon bx bx-plus"></i>  
      </a>
    </div>
  </div>
  
</section>
@endsection
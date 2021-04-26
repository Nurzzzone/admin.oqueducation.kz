@extends('layouts.contentLayoutMaster')

@section('title', __('pages.teachers'))

@section('content')
<section >

  <div class="card mt-2">
    <div class="card-content">
      <div class="card-body">
        {{ Form::model($teacher, ['url' => route('teachers.store'), 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) }}
          @include('pages.teachers.partials.form')
          @include('pages.teachers.partials.register')
          <div class="col-md-12 d-flex mt-2 justify-content-end">
            {{ Form::submit(__('buttons.create'), ['class' => 'btn btn-success']) }}
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
  
</section>
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/forms/form-repeater.js')}}"></script>
@endsection
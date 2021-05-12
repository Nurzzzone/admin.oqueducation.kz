@extends('layouts.contentLayoutMaster')

@section('title', __('locale.pages.teachers'))

@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/editors/quill/katex.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/editors/quill/monokai-sublime.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/editors/quill/quill.snow.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/editors/quill/quill.bubble.css')}}">
@endsection

@section('content')
<section >

  <div class="card mt-2">
    <div class="card-content">
      <div class="card-body">
        {{ Form::model($teacher, ['url' => route('teachers.update', $teacher->id), 'method' => 'PATCH', 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) }}
          @include('pages.teachers.partials.form')
          @include('pages.teachers.partials.reset')
          <div class="col-md-12 d-flex mt-2 justify-content-end">
            {{ Form::submit(__('buttons.save'), ['class' => 'btn btn-success']) }}
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
<script src="{{asset('vendors/js/editors/quill/katex.min.js')}}"></script>
<script src="{{asset('vendors/js/editors/quill/highlight.min.js')}}"></script>
<script src="{{asset('vendors/js/editors/quill/quill.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/jquery.steps.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('vendors/js/inputmask/jquery.inputmask.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/forms/form-repeater.js')}}"></script>
<script src="{{asset('js/scripts/editors/editor-quill.js')}}"></script>
@endsection
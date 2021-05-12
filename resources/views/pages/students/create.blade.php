@extends('layouts.contentLayoutMaster')

@section('title', trans('pages.students'))

@section('content')
<section >
  <div class="card mt-2">
    <div class="card-content">
      <div class="card-body">
        {{ Form::model($student, ['url' => route('students.store'), 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) }}
          @include('pages.students.partials.form')
          @include('pages.students.partials.register')
          <div class="col-md-12 d-flex mt-2 justify-content-end">
            {{ Form::submit(__('buttons.create'), ['class' => 'btn btn-success']) }}
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</section>
@endsection

@section('page-scripts')
<script src="{{asset('assets/js/scripts.js')}}"></script>
@endsection
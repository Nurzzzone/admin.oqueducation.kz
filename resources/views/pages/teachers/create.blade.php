@extends('layouts.contentLayoutMaster')

@section('title', __('pages.teachers'))

@section('content')
<section >

  <div class="card mt-2">
    <div class="card-content">
      <div class="card-body">
        {{ Form::model($teacher, ['url' => route('teachers.store'), 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data']) }}
          @include('pages.teachers.form')
          <div class="d-flex justify-content-end">
            {{ Form::submit(__('buttons.create'), ['class' => 'btn btn-success']) }}
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
  
</section>
@endsection
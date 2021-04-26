@extends('layouts.contentLayoutMaster')

@section('title', __('locale.pages.teachers'))

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
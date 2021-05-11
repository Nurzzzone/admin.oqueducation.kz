@extends('layouts.contentLayoutMaster')

@section('title', trans('pages.users'))

@section('content')
<section >

  <div class="card mt-2">
    <div class="card-content">
      <div class="card-body">
        @php
            $options = [
              'url' => route('users.store'), 
              'class' => 'form form-horizontal', 
              'enctype' => 'multipart/form-data', 
            ];
        @endphp
        {{ Form::model($user, $options) }}
          @include('pages.users.partials.form')
          @include('pages.users.partials.register')
          <div class="col-md-12 d-flex mt-2 justify-content-end">
            {{ Form::submit(trans('buttons.create'), ['class' => 'btn btn-success']) }}
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
  
</section>
@endsection
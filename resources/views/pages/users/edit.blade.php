@extends('layouts.contentLayoutMaster')

@section('title', trans('pages.users'))

@section('content')
<section >

  <div class="card mt-2">
    <div class="card-content">
      <div class="card-body">
        @php
            $options = [
              'url' => route('users.update', $user->id), 
              'method' => 'PATCH', 
              'class' => 'form form-horizontal', 
              'enctype' => 'multipart/form-data'
            ];
        @endphp
        {{ Form::model($user, $options) }}
          @include('pages.users.partials.form')
          @include('pages.users.partials.reset')
          <div class="col-md-12 d-flex mt-2 justify-content-end">
            {{ Form::submit(trans('buttons.save'), ['class' => 'btn btn-success']) }}
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>

</section>
@endsection
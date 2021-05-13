@extends('layouts.contentLayoutMaster')

@section('title', trans('pages.classes'))

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/wizard.css')}}">
@endsection

@section('content')
  <section id="icon-tabs">
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
                <li class="font-small-1 text-white">{{ $error }}</li>
            @endforeach
          </ul>
      </div>
    @endif
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body" id="class-content" style="display:none">
              @php
                $options = [
                  'id' => 'update-class',
                  'url' => route('classes.update', $data['class']->id),
                  'method' => 'PATCH',
                  'class' => 'wizard-horizontal form form-horizontal', 
                  'enctype' => 'multipart/form-data'
                ];
              @endphp
              {{ Form::model($data['class'], $options) }}
                @include('pages.classes.partials.1-index')
                @include('pages.classes.partials.2-index')
                @include('pages.classes.partials.3-index')
              {{ Form::close() }}
            </div>
            @include('pages.classes.partials.loader')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('vendor-scripts')
<script src="{{asset('vendors/js/extensions/jquery.steps.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/forms/wizard-steps.js')}}"></script>
<script src="{{asset('js/scripts/forms/form-repeater.js')}}"></script>
<script src="{{asset('assets/js/update-class.js')}}"></script>
@endsection
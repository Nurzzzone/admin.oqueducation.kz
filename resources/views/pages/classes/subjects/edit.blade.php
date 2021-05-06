@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title', trans('pages.subjects'))

@section('content')
  <section>
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body" id="class-content" style="display:none">
              @php
                $options = [
                  'method' => 'PATCH',
                  'url' => route('subjects.update', $subject->id), 
                  'class' => 'form form-horizontal', 
                ];
              @endphp
              {{ Form::model($subject, $options) }}
                @include('pages.classes.subjects.partials.form')
                <div class="col-md-12 d-flex mt-2 justify-content-end">
                  {{ Form::submit(__('buttons.save'), ['class' => 'btn btn-success']) }}
                </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
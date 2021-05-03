@extends('layouts.contentLayoutMaster')

@section('title', trans('locale.pages.classes'))

@php
  $id             = $class['id'];
  $title          = $class['title'];
  $source_url     = $class['source_url'];
  $type           = $class->type->name;
  $questions      = $class->questions;
  $hometask       = $class->hometasks;
  $default_image  = asset('images/profile/default.png');
@endphp

@section('content')
  <section class="mt-2">
  
    <div class="row mb-2">
      {{-- link: edit-class --}}
      <div class="col-12 col-sm-5 px-0 d-flex align-items-start px-1 mb-2">
        <a href="{{ route('classes.edit', $id) }}" class="btn btn-success">
          <i class="fitcon bx bx-pencil"></i> {{ trans('buttons.edit') }}</a>
      </div>
      {{-- end-link: edit-class --}}
    </div>
  
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header pb-0">
            <h4 class="py-50">Тема: {{ $title }}</h4>
          </div>
          <div class="card-content mt-2">
            <div class="card-body wizard-horizontal">


                <!-- body content step 1 -->
                <fieldset>
                  <div class="row">

                  </div>
                  <div class="row">

                  </div>
                </fieldset>
                <!-- body content step 1 end-->


                <!-- body content of step 2 -->
                <fieldset>
                  <div class="row">
                    <div class="col-12">
                      <h6 class="py-50">Вопросы:</h6>
                    </div>
                    @foreach ($questions as $questionKey => $question)
                      <div class="col-sm-6 d-flex align-items-center">
                        <span>{{$questionKey + 1}})</span>
                        <span>{{ $question->name }}</span>
                        <img 
                          src="@if($question->image !== null) {{ $question->image }} @else {{ $default_image }} @endif" 
                          alt="users view avatar"
                          class="users-avatar-shadow img-fluid" 
                          height="240" 
                          width="240"
                        >
                      </div>
                      <h6 class="py-50">Ответы:</h6>
                      @foreach ($question->answers as $answerKey => $answer)
                          <span>{{ $answer->name }}</span>
                      @endforeach
                    @endforeach
                  </div>
                </fieldset>
                <!-- body content of step 2 end-->


                <!-- body content of Step 3 -->
                <fieldset>
                  <div class="row">
                    <div class="col-12">
                      <h6 class="py-50">Домашнее задание:</h6>
                    </div>
                    <div class="col-md-12">
                      <span>{{ $hometask->name }}</span>
                    </div>
                    <div class="col-12">
                      <h6 class="py-50">Задачи:</h6>
                    </div>
                    @foreach ($hometask->tasks as $task)

                    @endforeach
                  </div>
                </fieldset>
                <!-- body content of Step 3 end-->
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- <div class="card">
      <div class="card-content">
        <div class="card-body">

          <div class="row">
            <div class="col-12 col-md-8">

              <table class="table table-borderless">
                <tbody>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.title') }}:</td>
                    <td>{{ $teacher['name'] ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.home_address') }}:</td>
                    <td>{{ $teacher['home_address'] }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td class="d-flex justify-content-start">
                      <span>{{ trans('fields.description') }}:</span>
                    </td>
                    <td>
                      <p class="card-text">{{ $teacher['description'] ?? '-' }}</p>
                    </td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.job_title') }}:</td>
                    <td>{{ $teacher['position'] ?? '-' }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
  </section>
@endsection
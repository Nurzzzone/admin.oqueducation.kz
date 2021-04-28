@extends('layouts.contentLayoutMaster')

@section('title', __('locale.pages.students'))
@php
  $id            = $student['id'];
  $default_image = asset('images/profile/default.png');
  $image         = asset('images/students/' . $student['image']);
  $name          = $student['name'];
  $surname       = $student['surname'];
  $middle_name   = $student['middle_name'];
  $full_name     = $name .' '. $surname .' '. ( $middle_name ?? '');
  $phone         = $student['phone_number'];
  $email         = $student['email_address'];
  $address       = $student['home_address'];
  $birthday      = \Carbon\Carbon::create($student['birth_date'])->translatedFormat('j F Y');
  $edit          = route('students.edit', $id);
@endphp

@section('content')
  <section class="mt-2">
  
    <div class="row mb-2">
      <div class="col-12 col-sm-7">
        <div class="media">
          <a class="mr-1" href="#">
            <img 
              src="@if($student->image !== null) {{ $image }} @else {{ $default_image }} @endif" 
              alt="users view avatar"
              class="users-avatar-shadow img-fluid" 
              height="128" 
              width="128">
          </a>
          <div class="media-body pt-25">
            <h4 class="media-heading">
              <span class="text-primary">{{ $full_name }}</span>
            </h4>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-start px-1 mb-2">
        <a href="{{ $edit }}" class="btn btn-primary">
          <i class="fitcon bx bx-pencil"></i> {{ trans('buttons.edit') }}</a>
      </div>
    </div>
  
    <div class="card">
      <div class="card-header">
        <div class="card-title">
          <h5 class="mt-1"><i class="bx bx-info-circle"></i> {{ __('locale.'.'PersonalInfo') }}</h5>
        </div>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-8">
              <table class="table table-borderless">
                <tbody>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.name') }}:</td>
                    <td>{{ $name ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.surname') }}:</td>
                    <td>{{ $surname ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.middle_name') }}:</td>
                    <td>{{ $middle_name ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.birth_date') }}:</td>
                    <td>{{ $birthday ?? '-'}} </td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.phone_number') }}:</td>
                    <td>{{ $phone ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.email_address') }}:</td>
                    <td>{{ $email ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.home_address') }}:</td>
                    <td>{{ $address ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.p1_full_name') }}:</td>
                    <td>{{ $student->parent->p1_full_name ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.p1_phone_number') }}:</td>
                    <td>{{ $student->parent->p1_phone_number ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.p2_full_name') }}:</td>
                    <td>{{ $student->parent->p2_full_name ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.p2_phone_number') }}:</td>
                    <td>{{ $student->parent->p2_phone_number ?? '-' }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
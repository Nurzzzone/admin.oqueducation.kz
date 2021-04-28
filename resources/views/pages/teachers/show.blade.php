@extends('layouts.contentLayoutMaster')

@section('title', __('locale.pages.teachers'))

@php
  $default_image     = asset('images/profile/default.png');
  $teacher_image     = asset('images/teachers/' . $teacher['image']);
  $teacher_full_name = $teacher['name'] . $teacher['surname'] . ( $teacher['middle_name'] ?? '');
  $teacher_id        = $teacher['id'];
  $teacher_birthday  =  \Carbon\Carbon::create($teacher['birth_date'])->translatedFormat('j F Y');
  $teacher_jobs      = $teacher->jobHistory()->get();
@endphp

@section('content')
<section >
  <section class="mt-2">
  
    <div class="row mb-2">
      <div class="col-12 col-sm-7">
        <div class="media">
          <a class="mr-1" href="#">
            <img 
              src="@if($teacher !== null) {{ $teacher_image }} @else {{ $default_image }} @endif" 
              alt="users view avatar"
              class="users-avatar-shadow img-fluid" 
              height="128" 
              width="128">
          </a>
          <div class="media-body pt-25">
            <h4 class="media-heading">
              <span class="text-primary">{{ $teacher_full_name }}</span>
            </h4>
            <div>
              <span class="text-primary">{{ trans('fields.display') }}: </span>
              @if ($teacher['is_active'])
                <span class="text-success">Активировано</span>
              @else
                <span class="text-danger">Не активно</span>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-start px-1 mb-2">
        <a href="{{ route('teachers.edit', $teacher_id) }}" class="btn btn-primary">
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
                    <td>{{ $teacher['name'] ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.surname') }}:</td>
                    <td>{{ $teacher['surname'] ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.middle_name') }}:</td>
                    <td>{{ $teacher['middle_name'] ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.birth_date') }}:</td>
                    <td>{{ $teacher_birthday ?? '-'}} </td>
                  </tr>
                  {{-- <tr>
                    <td>{{ __('locale.'.'Address') }}:</td>
                    <td>{{ $teamMember['address'] }}</td>
                  </tr> --}}
                  <tr class="font-small-3">
                    <td>{{ trans('fields.phone_number') }}:</td>
                    <td>{{ $teacher['phone_number'] ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.email_address') }}:</td>
                    <td>{{ $teacher['email_address'] ?? '-' }}</td>
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
                  <tr class="font-small-3">
                    <td class="d-flex justify-content-start">
                      <span>{{ trans('fields.work') }}:</span>
                    </td>
                    <td>
                      @foreach ($teacher_jobs as $job)
                        <span>{{ $job['position'] ?? '-' }}</span> <br>
                        <span>{{ $job['workplace'] }}</span><br>
                        <span>{{ $job['start_date'] }}</span><span>{{ $job['end_date'] }}</span><br>
                      @endforeach
                    </td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.facebook') }}:</td>
                    <td>{{ $teacher->socials->facebook_url ?? '-' }}</td>
                  </tr>
                  <tr class="font-small-3">
                    <td>{{ trans('fields.instagram') }}:</td>
                    <td>{{ $teacher->socials->instagram_url ?? '-' }}</td>
                  </tr>
                  {{-- <tr>
                    <td>{{ __('locale.'.'Status.Name') }}:</td>
                    @if (isset($teamMember['employment_date']) && $teamMember['termination_date'] === null)
                      <td class="text-success">{{ __('locale.'.'Status.Active')}}</td>
                    @elseif (!is_null($teamMember['employment_date']) && $teamMember['termination_date'] < $now) 
                      <td class="text-danger">{{ __('locale.'.'Status.Fired')}}</td>
                    @elseif (is_null($teamMember['employment_date']) && is_null($teamMember['termination_date']))
                      <td class="text-muted">{{ __('locale.'.'Status.Trainees')}}</td>
                  @endif
                  </tr> --}}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
</section>
@endsection
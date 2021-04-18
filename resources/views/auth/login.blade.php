@extends('layouts.fullLayoutMaster')
{{-- title --}}
@section('title', __('locale.pages.login'))
{{-- page scripts --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('content')
<!-- login page start -->
<section id="auth-login" class="row flexbox-container">
  <div class="col-xl-8 col-11 mx-auto">
    <div class="card bg-authentication mb-0">
      <div class="row m-0">
        <!-- left section-login -->
        <div class="col-md-6 col-12 px-0">
          <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
            <div class="card-header pb-1">
              <div class="card-title">
                <h4 class="text-center">@lang('locale.pages.login')</h4>
              </div>
            </div>

            <div class="card-content">
              <div class="card-body">
                <hr class="mt-0"/>

                {{ Form::model(['url' => route('login')]) }}

                  <div class="form-group mb-50">
                    <label class="font-small-1" for="email">@lang('locale.form_fields.user.email_address')</label>
                    <input id="email" type="email" class="form-control @error('email') border-danger @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="example@example.com">
                    @error('email')
                      <small class="text-danger">{{ $message }}</small class="text-danger">
                    @enderror
                  </div>

                  <div class="form-group">
                    <label class="font-small-1" for="password">@lang('locale.form_fields.user.password')</label>
                    <input id="password" type="password" class="form-control @error('password') border-danger @enderror" name="password"  autocomplete="current-password">
                    @error('password')
                      <small class="text-danger">{{ $message }}</small class="text-danger">
                    @enderror
                  </div>

                  {{ Form::button('<i id="icon-arrow" class="bx bx-right-arrow-alt"></i>'.__('locale.buttons.login'), [
                    'class' => 'btn btn-primary glow w-100 position-relative',
                    'type' => 'submit'
                    ]) 
                  }}
                {{ Form::close() }}

              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
          <div class="card-content">
            <img class="img-fluid" src="{{asset('images/pages/login.png')}}" alt="branding logo">
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<!-- login page ends -->
@endsection

@extends('layouts.contentLayoutMaster')

@section('title', trans('locale.pages.classes'))

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/wizard.css')}}">
@endsection

@php
  $id         = $class['id'];
  $title      = $class['title'];
  $source_url = $class['source_url'];
  $type       = $class->type->name;
  $questions  = $class->questions;
  $hometask   = $class->hometasks;
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
          <div class="card-content mt-2">
            <div class="card-body wizard-horizontal">
                <!-- Step 1 -->
                <h6>
                  <i class="step-icon"></i>
                  <span class="fonticon-wrap">
                    <i class="livicon-evo"
                      data-options="name:morph-doc.svg; size: 50px; style:lines; strokeColor:#adb5bd;"></i>
                  </span>
                </h6>
                <!-- Step 1 end-->
                <!-- body content step 1 -->
                <fieldset>
                  <div class="row">
                    <div class="col-12">
                      <h6 class="py-50">Enter Your Personal Details</h6>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="firstName13">First Name </label>
                        <input type="text" class="form-control" id="firstName13" placeholder="Enter Your First Name">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="lastName12">Last Name</label>
                        <input type="text" class="form-control" id="lastName12" placeholder="Enter Your Last Name">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="emailAddress1">Email</label>
                        <input type="email" class="form-control" id="emailAddress1" placeholder="Enter Your Email">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" placeholder="Enter Your Phone Number">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>age</label>
                        <input type="number" class="form-control" placeholder="Enter Your Age">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="d-block">Gender</label>
                        <div class="custom-control-inline">
                          <div class="radio mr-1">
                            <input type="radio" name="bsradio" id="radio1" checked="">
                            <label for="radio1">Male</label>
                          </div>
                          <div class="radio">
                            <input type="radio" name="bsradio" id="radio2" checked="">
                            <label for="radio2">Female</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <!-- body content step 1 end-->
                <!-- Step 2 -->
                <h6>
                  <i class="step-icon"></i>
                  <span class="fonticon-wrap">
                    <i class="livicon-evo"
                      data-options="name:truck.svg; size: 50px; style:lines; strokeColor:#adb5bd;"></i>
                  </span>
                </h6>
                <!-- Step 2 end-->
                <!-- body content of step 2 -->
                <fieldset>
                  <div class="row">
                    <div class="col-12">
                      <h6 class="py-50">Enter Your Location</h6>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Address Line 1</label>
                        <input type="text" class="form-control" placeholder="Enter House no./ Flate no.">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Address Line 2</label>
                        <input type="text" class="form-control" placeholder="Enter Society name/ Area name">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>LandMark</label>
                        <input type="text" class="form-control" placeholder="Enter A Landmark">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>TOWN/CITY</label>
                        <input type="text" class="form-control" placeholder="Enter Town/City">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>PINCODE</label>
                        <input type="text" class="form-control" placeholder="Enter Your Pincode">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>STATE</label>
                        <input type="text" class="form-control" placeholder="Enter Your State">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Country</label>
                        <select name="country" class="form-control">
                          <option value="">Select</option>
                          <option value="AF">Afghanistan</option>
                          <option value="AX">Åland Islands</option>
                          <option value="AL">Albania</option>
                          <option value="DZ">Algeria</option>
                          <option value="AS">American Samoa</option>
                          <option value="AD">Andorra</option>
                          <option value="AO">Angola</option>
                          <option value="AI">Anguilla</option>
                          <option value="AQ">Antarctica</option>
                          <option value="ZW">Zimbabwe</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 d-flex align-items-center">
                      <div class="form-group">
                        <div class="checkbox">
                          <input type="checkbox" class="checkbox__input" id="checkbox1" checked="">
                          <label for="checkbox1">Permanent Delivery address</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </fieldset>
                <!-- body content of step 2 end-->
                <!-- Step 3 -->
                <h6>
                  <i class="step-icon"></i>
                  <span class="fonticon-wrap">
                    <i class="livicon-evo"
                      data-options="name:home.svg; size: 50px; style:lines; strokeColor:#adb5bd;"></i>
                  </span>
                </h6>
                <!-- Step 3 end-->
                <!-- body content of Step 3 -->
                <fieldset>
                  <div class="row">
                    <div class="col-12">
                      <h6 class="py-50">Enter Your Payment Methods</h6>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <div class="d-flex justify-content-between flex-wrap align-items-center">
                          <div class="vs-radio-con vs-radio-primary">
                            <img src="{{asset('images/pages/bank.png')}}" alt="img-placeholder" height="40">
                            <span>Card 12XX XXXX XXXX 0000</span>
                          </div>
                          <div class="card-holder-name">
                            John Doe
                          </div>
                          <div class="card-expiration-date">
                            11/2020
                          </div>
                          <div>
                            <label>Enter CVV</label>
                            <input type="password" class="form-control" placeholder="Enter Your CVV no.">
                          </div>
                        </div>
                      </div>
                      <hr>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <ul class="other-payment-options list-unstyled">
                          <li class="pb-1">
                            <div class="radio">
                              <input type="radio" name="pyradio" id="radio6" checked="">
                              <label for="radio6">Credit / Debit / ATM Card</label>
                            </div>
                          </li>
                          <li class="pb-1">
                            <div class="radio">
                              <input type="radio" name="pyradio" id="radio7" checked="">
                              <label for="radio7">Net Banking</label>
                            </div>
                          </li>
                          <li class="pb-1">
                            <div class="radio">
                              <input type="radio" name="pyradio" id="radio8" checked="">
                              <label for="radio8"> EMI (Easy Installment)</label>
                            </div>
                          </li>
                          <li class="pb-1">
                            <div class="radio">
                              <input type="radio" name="pyradio" id="radio9" checked="">
                              <label for="radio9"> Cash On Delivery</label>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <hr>
                    </div>
                    <div class="col-12 d-flex">
                      <div class="paypal cursor-pointer d-flex align-items-center">
                        <div class="radio">
                          <input type="radio" name="onlportal" id="paypal" checked="">
                          <label for="paypal"></label>
                        </div>
                        <img src="{{asset('images/pages/PayPal_logo.png')}}" alt="PayPal Logo">
                      </div>
                      <div class="googlepay cursor-pointer pl-1 d-flex align-items-center">
                        <div class="radio">
                          <input type="radio" name="onlportal" id="googlepay" checked="">
                          <label for="googlepay"></label>
                        </div>
                        <img src="{{asset('images/pages/google-pay.png')}}" height="30" alt="google Logo">
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <hr>
                      <div class="form-group">
                        <label>Enter Your Promocode</label>
                        <input type="text" class="form-control" placeholder="Enter Your Promocode">
                      </div>
                    </div>
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

@section('vendor-scripts')
<script src="{{asset('vendors/js/extensions/jquery.steps.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/forms/wizard-steps.js')}}"></script>
@endsection
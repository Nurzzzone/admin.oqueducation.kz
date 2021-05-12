<h5>Авторизация</h5>
<div class="row">
  <div class="col-md-6">
    <div class="col-md-12">
      {{ Form::label('phone_number', trans('fields.phone_number').':', ['class' => 'font-small-1']) }}
      <span class="text-danger">*</span>
    </div>
    <div class="col-md-12">
      @php
          $options = [
            'id' => 'teacherPhoneNumber',
            'class' => ['form-control form-control-sm', $errors->has('phone_number') ? 'border-danger' : '']
          ];
      @endphp
      {{ Form::tel('phone_number', $teacher['phone_numbers'] ?? old('phone_number'), $options) }}
      @error('phone_number')
          <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
  </div>

  <div class="col-md-6">
    <div class="col-md-12">
      {{ Form::label('password', trans('fields.password').':', ['class' => 'font-small-1']) }}
      <span class="text-danger">*</span>
    </div>
    <div class="col-md-12">
      {{ Form::password('password', ['class' => ['form-control form-control-sm', $errors->has('password') ? 'border-danger' : '']]) }}
      @error('password')
          <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
  </div>
</div>
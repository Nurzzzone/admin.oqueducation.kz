<h5>Авторизация</h5>
  <div class="col-md-12">
    {{ Form::label('name', trans('fields.login').':', ['class' => 'font-small-1']) }}
    <span class="text-danger">*</span>
  </div>
  <div class="col-md-12">
    {{ Form::text('name', $user['name'] ?? old('name'), ['class' => ['form-control form-control-sm', $errors->has('name') ? 'border-danger' : '']]) }}
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
  </div>
<div class="row pt-1">
  <div class="col-md-6">
    <div class="col-md-12">
      {{ Form::label('email', trans('fields.email').':', ['class' => 'font-small-1']) }}
      <span class="text-danger">*</span>
    </div>
    <div class="col-md-12">
      {{ Form::email('email', $user['email'] ?? old('email'), ['class' => ['form-control form-control-sm', $errors->has('email') ? 'border-danger' : '']]) }}
      @error('email')
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
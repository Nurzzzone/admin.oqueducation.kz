<h5>Авторизация</h5>
<div class="row">
  <div class="col-md-6">
    <div class="col-md-12">
      {{ Form::label('old_password', trans('locale.password.old').':', ['class' => 'font-small-1']) }}
    </div>
    <div class="col-md-12">
      {{ Form::password('old_password', ['class' => ['form-control form-control-sm', $errors->has('old_password') ? 'border-danger' : '']]) }}
      @error('old_password')
          <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
  </div>

  <div class="col-md-6">
    <div class="col-md-12">
      {{ Form::label('new_password', trans('locale.password.new').':', ['class' => 'font-small-1']) }}
    </div>
    <div class="col-md-12">
      {{ Form::password('new_password', ['class' => ['form-control form-control-sm', $errors->has('new_password') ? 'border-danger' : '']]) }}
      @error('new_password')
          <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
  </div>
</div>
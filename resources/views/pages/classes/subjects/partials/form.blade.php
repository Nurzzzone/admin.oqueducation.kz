<div class="form-body">
  <h6>Новый предмет</h6>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-12">
        {{ Form::label('name', trans('fields.title').':', ['class' => 'font-small-1']) }}
        <span class="text-danger">*</span>
      </div>
      <div class="col-md-12 form-group">
        @php
            $options = ['class' => ['form-control form-control-sm', $errors->has('name') ? 'border-danger' : '']];
        @endphp
        {{ Form::text('name', $subject['name'] ?? old('name'), $options) }}
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
  </div>
</div>
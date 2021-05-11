<div class="form-body">

  <div class="avatar-upload">
    <div class="avatar-edit">
        {{ Form::file('image', ['class' => 'custom-file-input', 'id' => 'imageUpload']) }}
        <label for="imageUpload">
          <i class="ficon bx bxs-pencil my-50 ml-50"></i>
        </label>
    </div>
    <div class="avatar-preview">
      @php
          if ($user->profile !== null) {
            if ($user->profile->image !== null) {
              $image = asset('images/users/'.$user->profile->image);
            }
          } else {
            $image = asset('images/profile/default.png');
          }
      @endphp
        <div id="imagePreview" style="background-image: url({{ $image }});">
        </div>
    </div>
  </div>

  <h5>Личная инфорамация</h5>
  <div class="row px-1">
    {{-- left side --}}
      <div class="col-md-12">
        {{ Form::label('user_name', trans('fields.name').':', ['class' => 'font-small-1']) }}
        <span class="text-danger">*</span>
      </div>
      <div class="col-md-12 form-group">
        @php
          $value = $user->profile->name ?? old('user_name');
          $options = ['class' => ['form-control form-control-sm', $errors->has('user_name') ? 'border-danger' : '']];
        @endphp
        {{ Form::text('user_name', $value, $options) }}
        @error('user_name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('user_surname', trans('fields.surname').':', ['class' => 'font-small-1']) }}
        <span class="text-danger">*</span>
      </div>
      <div class="col-md-12 form-group">
        @php
          $value = $user->profile->surname ?? old('user_surname');
          $options = ['class' => ['form-control form-control-sm', $errors->has('user_surname') ? 'border-danger' : '']];
        @endphp
        {{ Form::text('user_surname', $value, $options) }}
        @error('user_surname')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="col-md-12">
        {{ Form::label('user_middle_name', trans('fields.middle_name').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        @php
          $value = $user->profile->middle_name ?? old('user_middle_name');
          $options = ['class' => ['form-control form-control-sm', $errors->has('user_middle_name') ? 'border-danger' : '']];
        @endphp
        {{ Form::text('user_middle_name', $value, $options) }}
        @error('user_middle_name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
  </div>
</div>

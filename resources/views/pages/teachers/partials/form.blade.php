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
          if ($teacher['image'] !== null) {
            $image = $teacher['image'];
          } else {
            $image = asset('images/profile/default.png');
          }
      @endphp
        <div id="imagePreview" style="background-image: url({{ asset($image) }});">
        </div>
    </div>
  </div>

  <h5>Личная инфорамация</h5>
  <div class="row  mb-2">
    {{-- left side --}}
    <div class="col-6">
      <div class="col-md-12">
        {{ Form::label('name', trans('fields.name').':', ['class' => 'font-small-1']) }}
        <span class="text-danger">*</span>
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('name', $teacher['name'] ?? old('name'), ['class' => ['form-control form-control-sm', $errors->has('name') ? 'border-danger' : '']]) }}
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
  

      <div class="col-md-12">
        {{ Form::label('surname', trans('fields.surname').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('surname', $teacher['surname'] ?? old('surname'), ['class' => ['form-control form-control-sm', $errors->has('surname') ? 'border-danger' : '']]) }}
        @error('surname')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
  

      <div class="col-md-12">
        {{ Form::label('middle_name', trans('fields.middle_name').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('middle_name', $teacher['middle_name'] ?? old('middle_name'), ['class' => ['form-control form-control-sm', $errors->has('middle_name') ? 'border-danger' : '']]) }}
        @error('middle_name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>


      <div class="col-md-12">
        {{ Form::label('birth_date', trans('fields.birth_date').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::date('birth_date', $teacher['birth_date'] ?? old('birth_date'), ['class' => ['form-control form-control-sm', $errors->has('birth_date') ? 'border-danger' : ''], 'placeholder' => trans('fields.birth_date')]) }}
        @error('birth_date')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('description', trans('fields.description').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::textarea('description', $teacher['description'] ?? old('description'), ['id'=>'teacher-textarea','class' => ['form-control', $errors->has('description') ? 'border-danger' : '']]) }}
        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

    </div> {{-- end: left side --}}

    {{-- right side --}}
    <div class="col-6 pl-0">

      <div class="col-md-12">
        {{ Form::label('email_address', trans('fields.email_address').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::email('email_address', $teacher['email_address'] ?? old('email_address'), ['class' => ['form-control form-control-sm', $errors->has('email_address') ? 'border-danger' : '']]) }}
        @error('email_address')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>


      <div class="col-md-12">
        {{ Form::label('home_address', trans('fields.home_address').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('home_address', $teacher['home_address'] ?? old('home_address'), ['class' => ['form-control form-control-sm', $errors->has('home_address') ? 'border-danger' : '']]) }}
        @error('home_address')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('position', trans('fields.job_title').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('position', $teacher['position'] ?? old('position'), ['class' => ['form-control form-control-sm', $errors->has('position') ? 'border-danger' : '']]) }}
        @error('position')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('facebook_url', trans('fields.facebook').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::url('facebook_url', $teacher->socials['facebook_url'] ?? old('facebook_url'), ['class' => ['form-control form-control-sm', $errors->has('facebook_url') ? 'border-danger' : '']]) }}
        @error('facebook_url')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('instagram_url', trans('fields.instagram').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::url('instagram_url', $teacher->socials['instagram_url'] ?? old('instagram_url'), ['class' => ['form-control form-control-sm', $errors->has('instagram_url') ? 'border-danger' : '']]) }}
        @error('instagram_url')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('is_active', trans('fields.display').':', ['class' => 'font-small-1']) }}
      </div>


      <div class="col-md-12">
        <div class="custom-control custom-radio pl-0 mt-50">
          {{ Form::radio('is_active', 1, true, ['id' => 'active', 'class' => ['radio-active', $errors->has('is_active') ? 'border-danger' : '']]) }}
          {{ Form::label('active', trans('fields.active'), ['class' => 'label-active text-success font-small-1 cursor-pointer']) }}
        </div>
        <div class="custom-control custom-radio pl-0">
          {{ Form::radio('is_active', 0, false, ['id' => 'inactive', 'class' => ['radio-active', $errors->has('is_active') ? 'border-danger' : '']]) }}
          {{ Form::label('inactive', trans('fields.inactive'), ['class' => 'label-active text-danger font-small-1 cursor-pointer']) }}
        </div>
        @error('is_active')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

    </div> {{-- end: right side --}}


  </div>

  <h5>Стаж работы</h5>
  <div class="row">
    <div class="col-12 repeater-default">
      <div data-repeater-list="job_history">
        <div data-repeater-item class="col-md-12">
          <div class="row justify-content-between align-items-end">
            <div class="col-md-6">
              {{ Form::label('position', trans('fields.job_title').':', ['class' => 'font-small-1']) }}
              {{ Form::text('position', $teacher->jobHistory['position'] ?? old('position'), ['class' => ['form-control form-control-sm', $errors->has('position') ? 'border-danger' : '']]) }}
              @error('position')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-6">
              {{ Form::label('workplace', trans('fields.job_place').':', ['class' => 'font-small-1']) }}
              {{ Form::text('workplace', $teacher->jobHistory['workplace'] ?? old('workplace'), ['class' => ['form-control form-control-sm', $errors->has('workplace') ? 'border-danger' : '']]) }}
              @error('workplace')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
  
            <div class="col-md-6">
              {{ Form::label('start_date', trans('fields.period.from').':', ['class' => 'font-small-1']) }}
              {{ Form::date('start_date', $teacher['start_date'] ?? old('start_date'), ['class' => ['form-control form-control-sm', $errors->has('start_date') ? 'border-danger' : '']]) }}
              @error('start_date')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
  
            <div class="col-md-6">
                {{ Form::label('end_date', trans('fields.period.to').':', ['class' => 'font-small-1']) }}
                {{ Form::date('end_date', $teacher['end_date'] ?? old('end_date'), ['class' => ['form-control form-control-sm', $errors->has('end_date') ? 'border-danger' : '']]) }}
                @error('end_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
  
              <div class="col-md-12 form-group d-flex justify-content-end align-items-center pt-2">
                <button class="btn btn-danger pt-0 px-1" data-repeater-delete type="button">
                  <i class="bx bx-x align-middle"></i>
                </button>
              </div>
  
          </div>
          <hr>
        </div>
      </div>
      <div class="form-group">
        <div class="col-12 d-flex justify-content-center">
          <button class="btn btn-primary" data-repeater-create type="button">
            <i class="bx bx-plus"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

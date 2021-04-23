<div class="form-body">
  <div class="row">


    <div class="col-6">
      <div class="col-md-12">
        {{ Form::label('name', trans('fields.name').':') }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('name', $teacher['name'] ?? old('name'), ['class' => ['form-control', $errors->has('name') ? 'border-danger' : '']]) }}
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
  

      <div class="col-md-12">
        {{ Form::label('surname', trans('fields.surname').':') }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('surname', $teacher['surname'] ?? old('surname'), ['class' => ['form-control', $errors->has('surname') ? 'border-danger' : '']]) }}
        @error('surname')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
  

      <div class="col-md-12">
        {{ Form::label('middle_name', trans('fields.middle_name').':') }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('middle_name', $teacher['middle_name'] ?? old('middle_name'), ['class' => ['form-control', $errors->has('middle_name') ? 'border-danger' : '']]) }}
        @error('middle_name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>


      <div class="col-md-12">
        {{ Form::label('birth_date', trans('fields.birth_date').':') }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::date('birth_date', $teacher['birth_date'] ?? old('birth_date'), ['class' => ['form-control', $errors->has('birth_date') ? 'border-danger' : ''], 'placeholder' => trans('fields.birth_date')]) }}
        @error('birth_date')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>


      <div class="col-md-12">
        {{ Form::label('email_address', trans('fields.email_address').':') }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('email_address', $teacher['email_address'] ?? old('email_address'), ['class' => ['form-control', $errors->has('email_address') ? 'border-danger' : '']]) }}
        @error('email_address')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>


      <div class="col-md-12">
        {{ Form::label('phone_number', trans('fields.phone_number').':') }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::tel('phone_number', $teacher['phone_numbers'] ?? old('phone_number'), ['class' => ['form-control', $errors->has('phone_number') ? 'border-danger' : '']]) }}
        @error('phone_number')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>


      <div class="col-md-12">
        {{ Form::label('home_address', trans('fields.home_address').':') }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('home_address', $teacher['home_address'] ?? old('home_address'), ['class' => ['form-control', $errors->has('home_address') ? 'border-danger' : '']]) }}
        @error('home_address')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

    </div>


    <div class="col-6">


      <div class="col-md-12">
        {{ Form::label('image', trans('fields.image').':') }}
      </div>
      <div class="col-md-12">
        <fieldset class="form-group">
            <div class="custom-file">
              {{ Form::file('image', ['class' => 'custom-file-label']) }}
              {{ Form::label('image', trans('fields.image'), ['class' => ['custom-file-label', $errors->has('image') ? 'border-danger' : '']]) }}
              @error('image')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
        </fieldset>
      </div>


      <div class="col-md-12">
        {{ Form::label('position', trans('fields.job_title').':') }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('position', $teacher['position'] ?? old('position'), ['class' => ['form-control', $errors->has('position') ? 'border-danger' : '']]) }}
        @error('position')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('description', trans('fields.description').':') }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::textarea('description', $teacher['description'] ?? old('description'), ['class' => ['form-control', $errors->has('description') ? 'border-danger' : '']]) }}
        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('position', trans('fields.display').':') }}
      </div>
      <div class="col-md-12">
        <div class="form-check">
          {{ Form::radio('is_active', true ?? old('is_active'), true, ['id' => 'active', 'class' => ['form-check-input', $errors->has('is_active') ? 'border-danger' : '']]) }}
          @error('is_active')
              <small class="text-danger">{{ $message }}</small>
          @enderror
          {{ Form::label('active', trans('fields.active'), ['class' => 'form-check-label text-success']) }}
        </div>
        <div class="form-check">
          {{ Form::radio('is_active', false ?? old('is_active'), false, ['id' => 'inactive', 'class' => ['form-check-input', $errors->has('is_active') ? 'border-danger' : '']]) }}
          @error('is_active')
              <small class="text-danger">{{ $message }}</small>
          @enderror
          {{ Form::label('inactive', trans('fields.inactive'), ['class' => 'form-check-label text-danger']) }}
        </div>
      </div>

      
    </div>


  </div>
</div>


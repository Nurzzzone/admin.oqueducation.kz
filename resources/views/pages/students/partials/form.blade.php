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
          if ($student['image'] !== null) {
            $image = asset('images/students/'.$student['image']);
          } else {
            $image = asset('images/profile/default.png');
          }
      @endphp
        <div id="imagePreview" style="background-image: url({{ $image }});">
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
        {{ Form::text('name', $student['name'] ?? old('name'), ['class' => ['form-control form-control-sm', $errors->has('name') ? 'border-danger' : '']]) }}
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
  

      <div class="col-md-12">
        {{ Form::label('surname', trans('fields.surname').':', ['class' => 'font-small-1']) }}
        <span class="text-danger">*</span>
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('surname', $student['surname'] ?? old('surname'), ['class' => ['form-control form-control-sm', $errors->has('surname') ? 'border-danger' : '']]) }}
        @error('surname')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
  

      <div class="col-md-12">
        {{ Form::label('middle_name', trans('fields.middle_name').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('middle_name', $student['middle_name'] ?? old('middle_name'), ['class' => ['form-control form-control-sm', $errors->has('middle_name') ? 'border-danger' : '']]) }}
        @error('middle_name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>


      <div class="col-md-12">
        {{ Form::label('birth_date', trans('fields.birth_date').':', ['class' => 'font-small-1']) }}
        <span class="text-danger">*</span>
      </div>
      <div class="col-md-12 form-group">
        {{ Form::date('birth_date', $student['birth_date'] ?? old('birth_date'), ['class' => ['form-control form-control-sm', $errors->has('birth_date') ? 'border-danger' : ''], 'placeholder' => trans('fields.birth_date')]) }}
        @error('birth_date')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>


      <div class="col-md-12">
        {{ Form::label('p1_full_name', trans('fields.p1_full_name').':', ['class' => 'font-small-1']) }}
        <span class="text-danger">*</span>
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('p1_full_name', $student->parent['p1_full_name'] ?? old('p1_full_name'), ['class' => ['form-control form-control-sm', $errors->has('p1_full_name') ? 'border-danger' : '']]) }}
        @error('p1_full_name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('p2_full_name', trans('fields.p2_full_name').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('p2_full_name', $student->parent['p2_full_name'] ?? old('p2_full_name'), ['class' => ['form-control form-control-sm', $errors->has('p2_full_name') ? 'border-danger' : '']]) }}
        @error('p2_full_name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

    </div> {{-- end: left side --}}

    {{-- right side --}}
    <div class="col-6 pl-0">

      
      <div class="col-md-12">
        {{ Form::label('city', trans('fields.city').':', ['class' => 'font-small-1']) }}
        <span class="text-danger">*</span>
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('city', $student['city'] ?? old('city'), ['class' => ['form-control form-control-sm', $errors->has('city') ? 'border-danger' : '']]) }}
        @error('city')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('email_address', trans('fields.email_address').':', ['class' => 'font-small-1']) }}
        <span class="text-danger">*</span>
      </div>
      <div class="col-md-12 form-group">
        {{ Form::email('email_address', $student['email_address'] ?? old('email_address'), ['class' => ['form-control form-control-sm', $errors->has('email_address') ? 'border-danger' : '']]) }}
        @error('email_address')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>


      <div class="col-md-12">
        {{ Form::label('home_address', trans('fields.home_address').':', ['class' => 'font-small-1']) }}
        <span class="text-danger">*</span>
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('home_address', $student['home_address'] ?? old('home_address'), ['class' => ['form-control form-control-sm', $errors->has('home_address') ? 'border-danger' : '']]) }}
        @error('home_address')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('type_id', trans('fields.type').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::select('type_id', ['1' => 'БИЛ/НИШ', '2' => 'ЕНТ'], $student->type->id ?? null, ['class' => ['form-control form-control-sm', $errors->has('type_id') ? 'border-danger' : '']]) }}
        @error('type_id')
          <small>{{ $message }} </small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('p1_phone_number', trans('fields.p1_phone_number').':', ['class' => 'font-small-1']) }}
        <span class="text-danger">*</span>
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('p1_phone_number', $student->parent['p1_phone_number'] ?? old('p1_phone_number'), ['class' => ['form-control form-control-sm', $errors->has('p1_phone_number') ? 'border-danger' : '']]) }}
        @error('p1_phone_number')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-12">
        {{ Form::label('p2_phone_number', trans('fields.p2_phone_number').':', ['class' => 'font-small-1']) }}
      </div>
      <div class="col-md-12 form-group">
        {{ Form::text('p2_phone_number', $student->parent['p2_phone_number'] ?? old('p2_phone_number'), ['class' => ['form-control form-control-sm', $errors->has('p2_phone_number') ? 'border-danger' : '']]) }}
        @error('p2_phone_number')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

    </div> {{-- end: right side --}}


  </div>
</div>

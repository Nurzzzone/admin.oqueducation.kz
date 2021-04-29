<!-- Step 1 -->
<h6><i class="step-icon"></i></h6>

<fieldset>
  <div class="row">
    <div class="col-12">
      <h6 class="py-50">Шаг 1</h6>
    </div>
  </div>

  <div class="border pt-2 mb-2">
    <div class="row">
      <div class="col-md-6">
        <div class="col-12">
          {{ Form::label('title', trans('fields.class_title').':', ['class' => 'font-small-1']) }}
          <span class="text-danger">*</span>
        </div>
        <div class="col-12 form-group">
          @php
              $options = [
                'class' => ['form-control form-control-sm', $errors->has('source_url') ? 'border-danger' : ''],
                'placeholder' => 'Например...',
                'required' => '',
              ];
          @endphp
          {{ Form::text('title', $class['title'] ?? old('title'), $options) }}
          @error('title')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="col-md-6">
        <div class="col-12">
          {{ Form::label('type', trans('fields.type').':', ['class' => 'font-small-1']) }}
          <span class="text-danger">*</span>
        </div>
        <div class="col-12 form-group">
          {{ Form::select('type', ['1' => 'БИЛ', '2' => 'НИШ', '3' => 'ЕНТ'], $student->type->id ?? null, ['class' => ['form-control form-control-sm', $errors->has('type') ? 'border-danger' : '']]) }}
          @error('type')
            <small>{{ $message }} </small>
          @enderror
        </div>
      </div>
    </div>
  
    <div class="row">
      <div class="col-md-6">
        <div class="col-12">
          {{ Form::label('source_url', trans('fields.class_source').':', ['class' => 'font-small-1']) }}
          <span class="text-danger">*</span>
        </div>
        <div class="col-12 form-group">
          @php
              $options = [
                'class' => ['form-control form-control-sm', $errors->has('source_url') ? 'border-danger' : ''],
                'placeholder' => 'https://...'
              ];
          @endphp
          {{ Form::text('source_url', $class['source_url'] ?? old('source_url'), $options) }}
          @error('source_url')
              <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
    </div>
  </div>

  
</fieldset>
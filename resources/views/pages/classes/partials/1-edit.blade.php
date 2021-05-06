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
                'autocomplete' => 'off',
              ];
          @endphp
          {{ Form::text('title', $class['title'] ?? old('title'), $options) }}
        </div>
      </div>
      <div class="col-md-6">
        <div class="col-12">
          {{ Form::label('type', trans('fields.type').':', ['class' => 'font-small-1']) }}
          <span class="text-danger">*</span>
        </div>
        <div class="col-12 form-group">
          {{ Form::select('type', ['БИЛ' => 'БИЛ', 'НИШ' => 'НИШ', 'ЕНТ' => 'ЕНТ'], $class->type->name ?? 'БИЛ', ['class' => ['form-control form-control-sm', $errors->has('type') ? 'border-danger' : '']]) }}
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
                'placeholder' => 'https://...',
                'autocomplete' => 'off',
              ];
          @endphp
          {{ Form::url('source_url', $class['source_url'] ?? old('source_url'), $options) }}
        </div>
      </div>

      <div class="col-md-6">
        <div class="col-12">
          {{ Form::label('is_active', trans('fields.display').':', ['class' => 'font-small-1']) }}
        </div>
  
        <div class="col-12 row align-items-center mt-25">
          <div class="custom-control custom-radio pl-2">
            @php
                $options = ['id' => 'active', 'class' => ['radio-active', $errors->has('is_active') ? 'border-danger' : '']];
            @endphp
            {{ Form::radio('is_active', 1, true, $options) }}
            {{ Form::label('active', trans('fields.active'), ['class' => 'label-active text-success font-small-1 cursor-pointer']) }}
          </div>
          <div class="custom-control custom-radio pl-2">
            @php
              $options = ['id' => 'inactive', 'class' => ['radio-active', $errors->has('is_active') ? 'border-danger' : '']];
            @endphp
            {{ Form::radio('is_active', 0, false, $options) }}
            {{ Form::label('inactive', trans('fields.inactive'), ['class' => 'label-active text-danger font-small-1 cursor-pointer']) }}
          </div>
        </div>
      </div>
    </div>
  </div>

  
</fieldset>



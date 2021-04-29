<!-- Step 3 -->
<h6>
  <i class="step-icon"></i>
</h6>

<fieldset>
  <div class="row">
    <div class="col-12">
      <h6 class="py-50">Шаг 3 — Создание домашнего задания</h6>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-12">
        {{ Form::label('title', trans('fields.hometask').':', ['class' => 'font-small-1']) }}
        <span class="text-danger">*</span>
      </div>
      <div class="col-12 form-group">
        @php
        $options = [
          'class' => ['form-control form-control-sm', $errors->has('answer') ? 'border-danger' : ''],
          'placeholder' => 'Например...'
        ];
        @endphp
        {{ Form::text('title', $class['title'] ?? old('title'), $options) }}
        <div class="text-right">
          {{ Form::label('image', 'прикрепить изображение к вопросу', ['class' => 'cursor-pointer font-small-1', 'style' => "text-decoration: underline;"]) }}
          {{ Form::file('image', ['class' => 'd-none']) }}
        </div>
        @error('title')
            <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 repeater-default">
      <div data-repeater-list="tasks">
        <div data-repeater-item class="col-md-12">
          <div class="row justify-content-between align-items-end">
            <div class="col-md-11">
              {{ Form::label('task', trans('fields.task').':', ['class' => 'font-small-1']) }}
              @php
                $options = [
                  'class' => ['form-control form-control-sm', $errors->has('answer') ? 'border-danger' : ''],
                  'placeholder' => 'Введите ваш вопрос для ученика'
                ];
              @endphp
              {{ Form::text('task', $teacher->jobHistory['task'] ?? old('task'), $options) }}
              <div class="text-right">
                {{ Form::button('добавить подсказку', [
                  'class' => 'btn cursor-pointer font-small-1 m-0 p-0', 
                  'type' => 'button',
                  'style' => "text-decoration: underline;",
                  ]) 
                }}
              </div>
              @error('task')
                  <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-1 d-flex justify-content-center pb-2">
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
</fieldset>
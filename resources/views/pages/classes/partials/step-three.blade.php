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
  
  <div id="hometasks" class="border col-12 pt-2 mb-2">
    <div class="row">
      <div class="col-12 px-0 repeater-default">
        <div data-repeater-list="tasks">
          <div class="col-12">
            {{ Form::label('hometask', trans('fields.hometask').':', ['class' => 'font-small-1']) }}
            <span class="text-danger">*</span>
          </div>
          <div class="col-12 form-group">
            @php
            $options = [
              'class' => ['form-control form-control-sm', $errors->has('answer') ? 'border-danger' : ''],
              'placeholder' => 'Например...',
              'autocomplete' => 'off',
            ];
            @endphp
            {{ Form::text('hometask', $class['hometask'] ?? old('hometask'), $options) }}
            <hr class="mb-0">
          </div>
          <div data-repeater-item class="col-md-12 task">
            <div class="row justify-content-between align-items-end">
              <div class="col-md-11">
                {{ Form::label('name', trans('fields.task').':', ['class' => 'font-small-1']) }}
                @php
                  $options = [
                    'class' => ['pr-3 form-control form-control-sm', $errors->has('answer') ? 'border-danger' : ''],
                    'placeholder' => 'Введите ваш вопрос для ученика',
                    'autocomplete' => 'off',
                  ];
                @endphp
                <div class="position-relative">
                  {{ Form::text('name', $teacher->jobHistory['name'] ?? old('name'), $options) }}
                  @php
                    $options = [
                      'class' => 'position-absolute cursor-pointer', 
                      'style' => "top: 7px; right: 10px;",
                    ];
                  @endphp
                  {{ Form::label('image', '<i class="bx bxs-file-image"></i>', $options, false) }}
                  {{ Form::file('image', ['class' => 'd-none']) }}
                </div>
                
                <div class="hint-box position-relative d-flex justify-content-end">
                  {{ Form::button('добавить подсказку', [
                    'class' => 'hint-button btn cursor-pointer font-small-1 m-0 p-0', 
                    'type' => 'button',
                    'style' => "text-decoration: underline;",
                    ]) 
                  }}
                  <div class="hint-popover position-absolute" style="right: 0px; top: 100%; z-index: 1000; display: none;">
                    @php
                      $options = [
                        'class' => ['pt-1 form-control form-control-sm', $errors->has('hint') ? 'border-danger' : ''],
                        'placeholder' => 'Например...',
                        'autocomplete' => 'off',
                      ];
                    @endphp
                  {{ Form::textarea('hint', $teacher->jobHistory['hint'] ?? old('hint'), $options) }}
                  </div>
                </div>
              </div>


              {{-- button: delete task --}}
              <div class="col-md-1 d-flex justify-content-center pb-2 pr-2">
                <button class="btn btn-danger pt-0 px-1" data-repeater-delete type="button">
                  <i class="bx bx-x align-middle"></i>
                </button>
              </div>
              {{-- end-button: delete task --}}
    

            </div>
          </div>
        </div>


        {{-- button: add task --}}
        <div class="form-group">
          <div class="col-12 d-flex justify-content-center">
            <button id="add-task" class="btn btn-primary" data-repeater-create type="button">
              <i class="bx bx-plus"></i>
            </button>
          </div>
        </div>
        {{-- end-button: add task --}}
      </div>
    </div>
  </div>

</fieldset>
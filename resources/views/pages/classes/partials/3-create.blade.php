<div data-repeater-item class="col-md-12 task">
  <div class="row justify-content-between align-items-end">
    <div class="col-md-11">
      @php
          $value = trans('fields.task').':';
          $options = ['class' => 'font-small-1'];
      @endphp
      {{ Form::label('task_0', $value, $options) }}
      @php
        $value = $task['name'] ?? old('name');
        $options = [
          'id' => 'task_0',
          'class' => ['pr-3 form-control form-control-sm', $errors->has('answer') ? 'border-danger' : ''],
          'placeholder' => 'Введите ваш вопрос для ученика',
          'autocomplete' => 'off',
          'required' => ''
        ];
      @endphp
      <div class="position-relative">
        {{ Form::text('name', $value, $options) }}
        @php
          $value ='<i class="bx bxs-file-image"></i>';
          $options = [
            'class' => 'position-absolute cursor-pointer', 
            'style' => "top: 7px; right: 10px;",
          ];
        @endphp
        {{ Form::label('task-image', $value, $options, false) }}
        {{ Form::file('image', ['class' => 'd-none taskImageUpload', 'id' => 'task-image']) }}
      </div>
      
      <div class="hint-box position-relative d-flex justify-content-end">
        @php
          $options = [
            'id' => 'hint-button',
            'class' => 'hint-button btn cursor-pointer font-small-1 m-0 p-0', 
            'type'  => 'button',
            'style' => "text-decoration: underline;",
          ]
        @endphp
        {{ Form::button('добавить подсказку', $options) }}
        <div id="hint-popover" class="hint-popover position-absolute" style="right: 0px; top: 100%; z-index: 1000; display: none;">
          @php
            $value = $task['hint'] ?? old('hint');
            $options = [
              'class'        => ['pt-1 form-control form-control-sm', $errors->has('hint') ? 'border-danger' : ''],
              'placeholder'  => 'Например...',
              'autocomplete' => 'off',
            ];
          @endphp
        {{ Form::textarea('hint', $value, $options) }}
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
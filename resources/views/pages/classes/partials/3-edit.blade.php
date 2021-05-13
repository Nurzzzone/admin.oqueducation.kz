@foreach ($data['class']->hometasks->tasks as $task)
  <div data-repeater-item class="col-md-12 task" data-tag="task">
    <div class="row justify-content-between align-items-end">
      <div class="col-md-11">

        {{-- task image --}}
        @if ($task->image !== null)
          <div style='background-image: url({{ asset('/images/classes/tasks/'. $task->image) }});' class='taskImage-preview users-avatar-shadow' width="240" height="240">
            <button data-tag="removeTaskImage" type='button' class="btn m-0 remove-task"><i class="bx bx-x align-middle text-danger"></i></button>
          </div>    
        @endif
        {{-- end-task image --}}

        {{-- task id --}}
        {{ Form::hidden('id', $task->id ?? null) }}
        {{-- end-task id --}}

        {{-- label: task name --}}
        @php
          $value = trans('fields.task').':';
          $options = ['class' => 'font-small-1'];
        @endphp
        {{ Form::label('task_0', $value, $options) }}
        {{-- end-label: task name --}}

        {{-- input: task name --}}
        @php
          $value = $task['name'] ?? old('name');
          $options = [
            'id' => 'task_0',
            'class' => ['pr-3 form-control form-control-sm', $errors->has('answer') ? 'border-danger' : ''],
            'placeholder' => 'Введите ваш вопрос для ученика',
            'autocomplete' => 'off',
            'data-tag' => 'taskInput',
            'data-id' => 'taskName',
          ];
        @endphp
        <div class="position-relative">
          {{ Form::text('name', $value, $options) }}
        {{-- end-input: task name --}}

        {{-- label: task image --}}
          @php
            $value ='<i class="bx bxs-file-image"></i>';
            $options = [
              'class' => 'position-absolute cursor-pointer', 
              'style' => "top: 7px; right: 10px;",
            ];
          @endphp
          {{ Form::label('task-image', $value, $options, false) }}
        {{-- end-label: task image --}}

        {{-- input: task image --}}
          @php
            $options = [
              'class' => 'd-none taskImageUpload', 
              'id' => 'task-image', 
              'data-tag' => 'taskImageInput'
            ];
          @endphp
          {{ Form::file('image', $options) }}
        {{-- end-input: task image --}}
        </div>
        
        <div class="hint-box position-relative d-flex justify-content-end">
          {{-- button: show hint textarea --}}
          @php
            $options = [
              'id' => 'hint-button',
              'class' => 'hint-button btn cursor-pointer font-small-1 m-0 p-0', 
              'type'  => 'button',
              'style' => "text-decoration: underline;",
              'data-tag' => 'hintButton',
            ]
          @endphp
          {{ Form::button('добавить подсказку', $options) }}
          {{-- end-button: show hint textarea --}}
          <div data-tag="hintContainer" id="hint-popover" class="hint-popover position-absolute" style="right: 0px; top: 100%; z-index: 1000; display: none;">
            {{-- textarea: task hint --}}
            @php
              $value = $task['hint'] ?? old('hint');
              $options = [
                'class'        => ['pt-1 form-control form-control-sm', $errors->has('hint') ? 'border-danger' : ''],
                'placeholder'  => 'Например...',
                'autocomplete' => 'off',
                'data-tag' => 'taskHintInput',
              ];
            @endphp
          {{ Form::textarea('hint', $value, $options) }}
          {{-- end-textarea: task hint --}}
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
@endforeach   
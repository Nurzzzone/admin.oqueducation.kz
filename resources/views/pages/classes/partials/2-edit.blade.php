@foreach ($data['class']->questions as $question)
  <div data-repeater-item class="col-md-12 px-0 question" data-tag="old-question" data-find="question">
    <div>
      <div class="border mb-1 pb-2">
        @if ($question->image !== null)
          <div style='background-image: url({{ asset('images/classes/questions/'. $question->image) }});' class='quesitonImage-preview users-avatar-shadow' width="240" height="240">
            <button data-tag="removeQuestionImage" type='button' class="btn m-0 remove-question">
              <i class="bx bx-x align-middle text-danger"></i>
            </button>
          </div>
        @endif

        {{-- button: delete question  --}}
        <div class="d-flex justify-content-end">
          <button data-tag="removeQuestion" class="btn p-0 m-0 pr-1 pt-1" data-repeater-delete type="button">
            <i class="bx bx-x align-middle text-danger"></i>
          </button>
        </div>
  
        {{ Form::hidden('id', $question->id ?? null, ['data-tag' => 'questionId']) }}
        {{-- question_name: label --}}
        <div class="col-12">
          {{ Form::label('question_0', trans('fields.question').':', ['class' => 'font-small-1']) }}
          <span class="text-danger">*</span>
        </div>
  
        <div class="col-12">
          @php
              $options = [
                'id' => 'question_0',
                'class' => ['form-control form-control-sm', $errors->has('name') ? 'border-danger' : ''],
                'placeholder' => 'Как будет выглядеть ваш вопрос?',
                'autocomplete' => 'off',
                'data-tag' => 'questionInput'
              ];
          @endphp
          {{-- question_name: input --}}
          <div class="position-relative">
            {{ Form::text('name', $question['name'] ?? old('name'), $options) }}
            @php
              $options = [
                'class' => 'position-absolute cursor-pointer', 
                'style' => "top: 7px; right: 10px;",
              ];
            @endphp
            {{-- question_image: input --}}
            {{ Form::label('image', '<i class="bx bxs-file-image"></i>', $options, false) }}
            {{ Form::file('image', ['class' => 'd-none questionImageUpload', 'data-tag' => 'questionImageInput']) }}
          </div>
          <div class="text-right">
            {{-- question_image: label --}}
            {{ Form::label('image', 'прикрепить изображение', ['class' => 'text-right cursor-pointer font-small-1 ', 'style' => "text-decoration: underline;"]) }}
          </div>
          <hr>
        </div>
        
        <div class="row">
          <div class="col-12 answers-repeater">
            <div class="">
              {{-- add answer button --}}
              <button class="btn p-0 pl-1 font-small-1" style="text-decoration: underline;" data-repeater-create type="button">
                добавить ответ
              </button>
            </div>
            <div data-repeater-list="answers">
              @foreach ($question->answers as $answer)
              <div data-repeater-item class="col-md-12 answer">
                <div class="row justify-content-between align-items-start">
                  @if ($answer->image !== null)
                    <div style='background-image: url({{ asset('images/classes/answers/'. $answer->image) }});' class='answerImage-preview users-avatar-shadow' width="240" height="240">
                      <button data-tag="answerQuestionImage" type='button' class="btn m-0 remove-answer"><i class="bx bx-x align-middle text-danger"></i></button>
                    </div>
                  @endif
                  
                  {{ Form::hidden('id', $answer->id ?? null, ['data-tag' => 'answerId']) }}
                  <div class="col-12 d-flex">
                    <div class="col-10 pl-0">
                      @php
                        $options = [
                          'class' => ['form-control form-control-sm pr-3', $errors->has('answer') ? 'border-danger' : ''],
                          'placeholder' => 'Вариант ответа',
                          'autocomplete' => 'off',
                          'data-tag' => 'answerInput'
                        ];
                      @endphp
  
                      {{-- answer_name: input --}}
                      <div class="position-relative">
                        {{ Form::text('name', $answer['name'] ?? old('name'), $options) }}
                        @php
                          $options = [
                            'class' => 'position-absolute cursor-pointer', 
                            'style' => "top: 7px; right: 10px;",
                          ];
                        @endphp
                        {{-- answer_image: input --}}
                        {{ Form::label('answer-image', '<i class="bx bxs-file-image"></i>', $options, false) }}
                        {{ Form::file('image', ['class' => 'd-none answerImageUpload', 'id' => 'answer-image', 'data-tag' => 'answerImageInput']) }}
                      </div>
  
                      {{-- answer_name: label --}}
                      <div class="text-right">
                        {{ Form::label('answer-image', 'прикрепить изображение', ['class' => 'text-right cursor-pointer font-small-1 ', 'style' => "text-decoration: underline;"]) }}
                      </div>
                    </div>
  
                    {{-- answer_is_correct: input --}}
                    <div class="col-md-1 d-flex justify-content-center checkbox-container">
                      <fieldset>
                        <div class="checkbox checkbox-success checkbox-glow">
                          @php
                            $options = [
                              'data-tag' => 'answerCheckbox',
                              'id' => 'is_correct'
                            ];
                          @endphp
                          {{ Form::checkbox('is_correct', 1, $answer->is_correct ?? false, $options) }}
                            <label class="cursor-pointer" for="is_correct" data-tag="checkboxLabel"></label>
                        </div>
                      </fieldset>
                    </div>
                    {{-- answer_is_correct: input --}}
  
                    {{-- button: delete answer  --}}
                    <div class="col-md-2 d-flex">
                      <div>
                        <div class="d-flex justify-content-center">
                          <button class="btn btn-danger pt-0 px-1" data-repeater-delete type="button">
                            <i class="bx bx-x align-middle"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    {{-- button: delete answer  --}}
  
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endforeach
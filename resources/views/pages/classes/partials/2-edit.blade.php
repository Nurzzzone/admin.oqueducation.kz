@foreach ($data['class']->questions as $question)
<div data-repeater-item class="col-md-12 px-0 question">
  <div>
    <div class="border mb-1 pb-2">

      {{-- button: delete question  --}}
      <div class="d-flex justify-content-end">
        <button class="btn p-0 m-0 pr-1 pt-1" data-repeater-delete type="button">
          <i class="bx bx-x align-middle text-danger"></i>
        </button>
      </div>

      {{ Form::hidden('id', $question->id ?? null) }}
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
          {{ Form::file('image', ['class' => 'd-none questionImageUpload']) }}
        </div>
        <div class="text-right">
          {{-- question_image: label --}}
          {{ Form::label('image', 'прикрепить изображение', ['class' => 'text-right cursor-pointer font-small-1 ', 'style' => "text-decoration: underline;"]) }}
        </div>
        <hr>
      </div>
      
      <div class="row">
        <div class="col-12 inner-repeater">
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
                {{ Form::hidden('id', $answer->id ?? null) }}
                <div class="col-12 d-flex">
                  <div class="col-10 pl-0">
                    @php
                      $options = [
                        'class' => ['form-control form-control-sm pr-3', $errors->has('answer') ? 'border-danger' : ''],
                        'placeholder' => 'Вариант ответа',
                        'autocomplete' => 'off',
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
                      {{ Form::file('image', ['class' => 'd-none answerImageUpload', 'id' => 'answer-image']) }}
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
                        {{ Form::checkbox('is_correct', 1, $answer->is_correct ?? false, ['id' => 'is_correct']) }}
                          <label class="cursor-pointer" for="is_correct"></label>
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
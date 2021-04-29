<!-- body content step 1 end-->
<!-- Step 2 -->
<h6>
  <i class="step-icon"></i>
</h6>
<!-- Step 2 end-->
<!-- body content of step 2 -->
<fieldset>
  <div class="row">
    <div class="col-12">
      <h6 class="py-50">Шаг 2 - Создание теста</h6>
    </div>
  </div>


  <div class="row">
    <div class="col-12 repeater-default">
      <div data-repeater-list="questions">
        <div data-repeater-item class="col-md-12">
          <div>
            <div class="border mb-1 pb-2">
              <div class="d-flex justify-content-end">
                <button class="btn p-0 m-0 pr-1 pt-1" data-repeater-delete type="button">
                  <i class="bx bx-x align-middle text-danger"></i>
                </button>
              </div>
              <div class="col-12">
                {{ Form::label('question', trans('fields.question').':', ['class' => 'font-small-1']) }}
                <span class="text-danger">*</span>
              </div>
            
              <div class="col-12">
                @php
                    $options = [
                      'class' => ['form-control form-control-sm', $errors->has('question') ? 'border-danger' : ''],
                      'placeholder' => 'Как будет выглядеть ваш вопрос?'
                    ];
                @endphp
                {{ Form::text('question', $class['question'] ?? old('question'), $options) }}
                <div class="text-right">
                  {{ Form::label('image', 'Прикрепить изображение к вопросу', ['class' => 'cursor-pointer font-small-1 ', 'style' => "text-decoration: underline;"]) }}
                  {{ Form::file('image', ['class' => 'd-none']) }}
                </div>
                @error('question')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
              <hr class="mb-0">
              </div>
              
              <div class="row">
                <div class="col-12 inner-repeater">
                  <div data-repeater-list="answers">
                    <div data-repeater-item class="col-md-12">
                      <div class="row justify-content-between align-items-end">
                        <div class="col-md-10">
                          @php
                          $options = [
                            'class' => ['form-control form-control-sm', $errors->has('answer') ? 'border-danger' : ''],
                            'placeholder' => 'Вариант ответа'
                          ];
                          @endphp
                          {{ Form::text('answer', $teacher->jobHistory['answer'] ?? old('answer'), $options) }}
                          @error('answer')
                              <small class="text-danger">{{ $message }}</small>
                          @enderror
                        </div>
            
                        <div class="col-md-2 d-flex">
                          <div>
                            <div class="col-6 d-flex justify-content-center pt-2">
                              <button class="btn btn-danger pt-0 px-1" data-repeater-delete type="button">
                                <i class="bx bx-x align-middle"></i>
                              </button>
                            </div>
                          </div>
                          <div>
                            <div class="col-6 d-flex justify-content-center pt-2">
                              <button class="btn btn-primary pt-0 px-1" data-repeater-create type="button">
                                <i class="bx bx-plus align-middle"></i>
                              </button>
                            </div>
                          </div>
                        </div>
              
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>


  
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-12 d-flex justify-content-center mt-1">
          <button class="btn btn-primary" data-repeater-create type="button">
            <i class="bx bx-plus"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
  {{-- <div class="border mb-1">
    <div class="col-12">
      {{ Form::label('question', trans('fields.question').':', ['class' => 'font-small-1']) }}
      <span class="text-danger">*</span>
    </div>
  
    <div class="col-12">
      @php
          $options = [
            'class' => ['form-control form-control-sm', $errors->has('question') ? 'border-danger' : ''],
            'placeholder' => 'Как будет выглядеть ваш вопрос?'
          ];
      @endphp
      {{ Form::text('question', $class['question'] ?? old('question'), $options) }}
      <div class="text-right">
        {{ Form::label('image', 'Прикрепить изображение к вопросу', ['class' => 'cursor-pointer font-small-1 ', 'style' => "text-decoration: underline;"]) }}
        {{ Form::file('image', ['class' => 'd-none']) }}
      </div>
      @error('question')
          <small class="text-danger">{{ $message }}</small>
      @enderror
    <hr class="mb-0">
    </div>
    
    <div class="row">
      <div class="col-12 repeater-default">
        <div data-repeater-list="answers">
          <div data-repeater-item class="col-md-12">
            <div class="row justify-content-between align-items-end">
              <div class="col-md-11">
                @php
                $options = [
                  'class' => ['form-control form-control-sm', $errors->has('answer') ? 'border-danger' : ''],
                  'placeholder' => 'Вариант ответа'
                ];
                @endphp
                {{ Form::text('answer', $teacher->jobHistory['answer'] ?? old('answer'), $options) }}
                @error('answer')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
  
              <div class="col-md-1 d-flex justify-content-center pt-2">
                <button class="btn btn-danger pt-0 px-1" data-repeater-delete type="button">
                  <i class="bx bx-x align-middle"></i>
                </button>
              </div>
    
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-12 d-flex justify-content-center mt-1">
            <button class="btn btn-primary" data-repeater-create type="button">
              <i class="bx bx-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div> --}}

</fieldset>
<!-- body content of step 2 end-->
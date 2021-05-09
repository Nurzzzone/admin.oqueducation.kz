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
            @php
                $value = trans('fields.hometask').':';
                $options = ['class' => 'font-small-1'];
            @endphp
            {{ Form::label('hometask', $value, $options) }}
            <span class="text-danger">*</span>
          </div>
          <div class="col-12 form-group">
            @php
              $value = $data['class']->hometasks['name'] ?? old('hometask');
              $options = [
                'class'        => ['form-control form-control-sm', $errors->has('answer') ? 'border-danger' : ''],
                'placeholder'  => 'Например...',
                'autocomplete' => 'off',
                'required' => ''
              ];
            @endphp
            {{ Form::text('hometask', $value, $options) }}
            <hr class="mb-0">
          </div>
          @if ($data['class']->hometasks !== null)
            @include('pages.classes.partials.3-edit')
          @else
            @include('pages.classes.partials.3-create')
          @endif
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
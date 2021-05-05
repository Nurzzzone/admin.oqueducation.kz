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
      <div data-repeater-list="questions" id='questions'>
        @if ($class->questions->isNotEmpty())
          @include('pages.classes.partials.2-edit')
        @else
          @include('pages.classes.partials.2-create')
        @endif
      </div>
      {{-- button: create question  --}}
      <div class="form-group">
        <div class="col-12 d-flex justify-content-center mt-1">
          <button class="btn btn-primary" data-repeater-create type="button">
            <i class="bx bx-plus"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</fieldset>
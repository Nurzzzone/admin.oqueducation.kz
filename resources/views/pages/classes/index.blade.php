@extends('layouts.contentLayoutMaster')

@section('title', __('locale.pages.classes'))

@section('content')
<section >

  {{-- button: create class --}}
  <div class="row px-1">
    <div class="col-12 mb-2">
      <div class="row align-items-center">
        <a class="btn btn-success" href="{{ route('classes.create') }}">
          <span>@lang('locale.buttons.create')</span>
          <i class="ficon bx bx-plus"></i>  
        </a>
      </div>
    </div>
  </div>
  {{-- end-button: create class --}}

  <div class="row" id="table-hover-row">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-hover mb-4">
              <thead>
                <tr>
                  <th class="font-small-2">ID</th>
                  <th class="font-small-2">@lang('fields.title')</th>
                  <th class="font-small-2">@lang('fields.type')</th>
                  <th class="font-small-2">@lang('buttons.default')</th>
                </tr>
              </thead>
                @if($classes->isEmpty())
                  <tbody>
                    <caption class="text-center text-muted">Table is empty</caption>
                  </tbody>
                @else
                  <tbody>
                    @foreach ($classes as $class)
                    @php
                        $id         = $class->id;
                        $title      = $class->title;
                        $type       = $class->type->name;
                    @endphp
                      <tr>
                        <td class="font-small-2">{{ $id }}</td>
                        <td class="font-small-2">{{ $title }}</td>
                        <td class="font-small-2">{{ $type }}</td>
                        <td>
                          <div class="dropdown">
                            <span class="bx bx-dots-vertical-rounded font-medium-3 nav-hide-arrow cursor-pointer"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item font-small-2" href="{{ route('classes.show', $id) }}">
                                <i class="ficon bx bxs-user mr-1"></i>{{ trans('buttons.view') }}
                              </a>
                              <a class="dropdown-item font-small-2" href="{{ route('classes.edit', $id) }}">
                                <i class="ficon bx bxs-pencil mr-1"></i>{{ trans('buttons.edit') }}
                              </a>
                              {{ Form::button('<i class="ficon bx bx-trash mr-1 text-danger"></i>'. trans('buttons.delete'), [
                                'class' => 'dropdown-item text-danger font-small-2', 
                                'type' => 'button', 
                                'data-target' => "#delete-member-{$id}",
                                'data-toggle' => 'modal',
                                ]) 
                              }}
                            </div>
                          </div>
                        </td>
                      </tr>
                      @include('pages.classes.partials.modal')
                    @endforeach
                  </tbody>
                @endif
            </table>
          </div>
        </div>

        {{-- pagination --}}
        <div class="card-footer">
          <div class="d-flex align-items-center justify-content-between font-small-3">
            <div></div>
            <div>{{ $classes->links() }}</div>
          </div>
        </div>

      </div>
    </div>
  </div>
  
</section>
@endsection
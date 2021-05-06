@extends('layouts.contentLayoutMaster')

@section('title', trans('pages.subjects'))

@section('content')
<section >
  {{-- link: create new subject --}}
  <div class="col-12 my-2">
    <div class="row align-items-center">
      <a class="btn btn-success" href="{{ route('subjects.create') }}">
        <span>@lang('buttons.create')</span>
        <i class="ficon bx bx-plus"></i>  
      </a>
    </div>
  </div>
  {{-- link: create new subject --}}

  {{-- table: subjects --}}
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
                  <th class="font-small-2">@lang('buttons.default')</th>
                </tr>
              </thead>
                @if($subjects->isEmpty())
                  <tbody>
                    <caption class="text-center text-muted">Table is empty</caption>
                  </tbody>
                @else
                  <tbody>
                    @foreach ($subjects as $subject)
                    @php
                        $id         = $subject->id;
                        $title      = $subject->name;
                    @endphp
                      <tr>
                        <td class="font-small-2">{{ $id }}</td>
                        <td class="font-small-2">{{ $title }}</td>
                        <td>
                          <div class="dropdown">
                            <span class="bx bx-dots-vertical-rounded font-medium-3 nav-hide-arrow cursor-pointer"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                            <div class="dropdown-menu dropdown-menu-right">
                              @php
                                  $html = '<i class="ficon bx bx-trash mr-1 text-danger"></i>';
                                  $value = $html . trans('buttons.delete');
                                  $options = [
                                    'class' => 'dropdown-item text-danger font-small-2', 
                                    'type' => 'button', 
                                    'data-target' => "#delete-member-{$id}",
                                    'data-toggle' => 'modal',
                                  ];
                              @endphp
                              {{ Form::button($value, $options) 
                              }}
                            </div>
                          </div>
                        </td>
                      </tr>
                      @include('pages.classes.subjects.partials.modal')
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
            <div>{{ $subjects->links() }}</div>
          </div>
        </div>
        {{-- pagination --}}

      </div>
    </div>
  </div>
  {{-- table: subjects --}}
  
</section>
@endsection
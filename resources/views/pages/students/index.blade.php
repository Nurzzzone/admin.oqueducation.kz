@extends('layouts.contentLayoutMaster')

@section('title', __('locale.pages.students'))

@section('content')
<section >

  {{-- create new student --}}
  <div class="col-12 mb-2">
    <div class="row align-items-center">
      <a class="btn btn-success" href="{{ route('students.create') }}">
        <span>@lang('locale.buttons.create')</span>
        <i class="ficon bx bx-plus"></i>  
      </a>
    </div>
  </div>

    {{-- students table --}}
    <div class="row" id="table-hover-row">
      <div class="col-12">
        <div class="card">
          <div class="card-content">
            <div class="table-responsive">
              <table class="table table-hover mb-4">
                <thead>
                  <tr>
                    <th class="font-small-5">ID</th>
                    <th class="font-small-5">@lang('fields.full_name')</th>
                    <th class="font-small-5">@lang('fields.phone_number')</th>
                    <th class="font-small-5">@lang('fields.type')</th>
                    <th class="font-small-5">@lang('buttons.default')</th>
                  </tr>
                </thead>
                  @if ($students->isEmpty())
                    <tbody>
                      <caption class="text-center text-muted">Table is empty</caption>
                    </tbody>
                  @else 

                    <tbody>
                      @foreach ($students as $student)
                        @php
                        $id        = $student->id;
                        $full_name = $student->name .' '. $student->surname .' '. ($student->middle_name ?? '');
                        $phone     = $student->phone_number;
                        $type      = $student->type->name;
                        @endphp
                        <tr>
                          <td class="font-small-2">{{ $id }}</td>
                          <td class="font-small-2">{{ $full_name }}</td>
                          <td class="font-small-2">{{ $phone }}</td>
                          <td class="font-small-2">{{ $type }}</td>
                          <td>
                            <div class="dropdown">
                              <span class="bx bx-dots-vertical-rounded font-medium-3 nav-hide-arrow cursor-pointer"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item font-small-2" href="{{ route('students.show', $id) }}">
                                  <i class="ficon bx bxs-user mr-1"></i>{{ trans('buttons.view') }}
                                </a>
                                <a class="dropdown-item font-small-2" href="{{ route('students.edit', $id) }}">
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
                        @include('pages.students.partials.modal')
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
              <div>{{ $students->links() }}</div>
            </div>
          </div>
  
        </div>
      </div>
    </div>
  
</section>
@endsection
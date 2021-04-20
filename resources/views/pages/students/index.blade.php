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
              <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th class="font-small-5">ID</th>
                    <th class="font-small-5">@lang('locale.form_fields.user.full_name')</th>
                    <th class="font-small-5">@lang('locale.form_fields.user.job_title')</th>
                    <th class="font-small-5">@lang('locale.form_fields.user.email')</th>
                    <th class="font-small-5">@lang('locale.buttons.default')</th>
                  </tr>
                </thead>
                  @empty(!$students)
                  <tbody>
                    <caption class="text-center text-muted">Table is empty</caption>
                  </tbody>
                  @endempty
                  @empty($students)
                    <tbody>
                      @foreach ($students as $student)
                        <tr>
                          <td class="text-bold-500">Michael Right</td>
                          <td>$15/hr</td>
                          <td class="text-bold-500">UI/UX</td>
                          <td>Remote</td>
                          <td>Austin,Taxes</td>
                          <td><a href="#"><i
                                class="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  @endempty
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
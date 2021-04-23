@extends('layouts.contentLayoutMaster')

@section('title', __('locale.pages.teachers'))

@section('content')
<section >
  
  {{-- create new teacher button --}}
  <div class="col-12 mb-2">
    <div class="row align-items-center">
      <a class="btn btn-success" href="{{ route('teachers.create') }}">
        <span>@lang('locale.buttons.create')</span>
        <i class="ficon bx bx-plus"></i>  
      </a>
    </div>
  </div>

  {{-- teachers table --}}
  <div class="row" id="table-hover-row">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th class="font-small-5">ID</th>
                  <th class="font-small-5">@lang('fields.full_name')</th>
                  <th class="font-small-5">@lang('fields.job_title')</th>
                  <th class="font-small-5">@lang('fields.email')</th>
                  <th class="font-small-5">@lang('buttons.default')</th>
                </tr>
              </thead>
                @if($teachers->isEmpty())
                  <tbody>
                    <caption class="text-center text-muted">Table is empty</caption>
                  </tbody>
                @else
                  <tbody>
                    @foreach ($teachers as $teacher)
                      <tr>
                        <td class="text-bold-500">Michael Right</td>
                        <td>$15/hr</td>
                        <td class="text-bold-500">UI/UX</td>
                        <td>Remote</td>
                        <td>Austin,Taxes</td>
                        <td><a href="#"><i lass="badge-circle badge-circle-light-secondary bx bx-envelope font-medium-1"></i></a></td>
                      </tr>
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
            <div>{{ $teachers->links() }}</div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@endsection
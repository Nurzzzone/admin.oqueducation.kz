@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title', trans('pages.users'))

@section('content')
<section id="table-transactions">
  {{-- button: create user --}}
  <div class="col-12 mb-2">
    <div class="row align-items-center">
      <a class="btn btn-success" href="{{ route('users.create') }}">
        <span>@lang('buttons.create')</span>
        <i class="ficon bx bx-plus"></i>  
      </a>
    </div>
  </div>
  {{-- end-button: create user --}}

  @if (Session::has('success.added'))
    <div class="alert bg-rgba-success alert-dismissible mb-2" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="d-flex align-items-center">
        <i class="bx bx-check"></i>
        <span>{{ __('locale.'.'success.name') }}: {{ __('locale.'.'success.add-user') }} {{ $last_user->email }}</span>
      </div>
    </div>
  @elseif (Session::has('success.updated')) 
  <div class="alert bg-rgba-success alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div class="d-flex align-items-center">
      <i class="bx bx-check"></i>
      <span>{{ __('locale.'.'success.name') }}: {{ __('locale.'.'success.update-user') }} </span>
    </div>
  </div>
  @elseif (Session::has('success.deleted')) 
  <div class="alert bg-rgba-success alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div class="d-flex align-items-center">
      <i class="bx bx-check"></i>
      <span>{{ __('locale.'.'success.name') }}: {{ __('locale.'.'success.delete-user') . Session::get('success.deleted') }}</span>
    </div>
  </div>
  @endif



  <!-- table: users -->
  <div class="table-responsive">
    <table class="table mb-0">
        <thead>
          <tr>
            <th>ID</th>
            <th>{{ trans('fields.name') }}</th>
            <th>{{ trans('fields.email') }}</th>
            <th>{{ trans('buttons.default') }}</th>
          </tr>
        </thead>
        <tbody>
          @if ($users->isEmpty())
            <div>Table is empty</div>
          @else
            @foreach ($users as $user)
              @php
                $id = $user['id'];
                $full_name = trim(($user->profile->name ?? null) .' '. ($user->profile->surname ?? null));
                $name = $user['name'];
                $email = $user['email'];
              @endphp
              <tr>
                <td class="font-small-3">{{ $id }}</td>
                <td class="font-small-3">{{ $full_name }}</td>
                <td class="font-small-3">{{ $email }}</td>
                <td>
                  <div class="dropdown">
                    <span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item @cannot('users-view', User::class) disabled @endcannot" href="{{ route('users.edit', $id) }}">
                        <i class="ficon bx bxs-pencil mr-1"></i>
                        {{ trans('buttons.edit') }}
                      </a>
                      @if (Auth::user()->name !== $user['name'])
                        {{ Form::button('<i class="ficon bx bx-trash mr-1 text-danger"></i>'.trans('buttons.delete'), [
                          'class' => 'dropdown-item text-danger',
                          'type' => 'button',
                          'data-target' => "#delete-member-{$id}",
                          'data-toggle' => 'modal'
                          ])
                        }}
                      @endif
                    </div>
                  </div>
                </td>
              </tr>
              @include('pages.users.partials.modal')
            @endforeach 
          @endif
        </tbody>
    </table>
  </div>
  <!-- end-table: users -->

  {{-- pagination --}}
  @if ($users->count() > 10)
    <div class="d-flex justify-content-center mb-4">
      {{ $users->links() }}
    </div>
  @endif
  {{-- end-pagination --}}
</section>
@endsection
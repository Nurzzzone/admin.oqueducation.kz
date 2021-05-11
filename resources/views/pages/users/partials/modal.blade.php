<div class="modal fade text-left" id="delete-member-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="deleteMember-{{ $id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title white" id="myModalLabel120">{{trans('buttons.delete') .' '. $email ?? '' }}?</h5>
      </div>
      <div class="modal-body">You won't be able to revert this!</div>
      <div class="modal-footer">
          @php
            $options = [
              'method' => 'DELETE', 
              'route' => ['users.destroy', $id], 
              'id' => 'delete_member_form', 
              'name' => 'delete_member_form'
            ];
          @endphp
          {{ Form::model($user, $options) }}
            {{-- {!! Form::hidden('id', $teacher->id) !!} --}}
            {{ Form::button( trans('buttons.close'), ['class' => 'btn btn-light-secondary', 'type' => 'button', 'data-dismiss'=>'modal']) }}
            {{ Form::button( trans('buttons.delete'), ['class' => 'btn btn-danger ml-1', 'type' => 'submit', 'id' => 'delete-member']) }}
          {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
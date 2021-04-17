(function(window, undefined) {
  'use strict';

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */
  $('#delete-member-trigger').click(function(event) {
    let id = $(this).data("id");
    $('#delete-member').on('show.bs.modal', function (e) {
        document.delete_member_form.action = "{{ url('/') }}" + "/admin/team-members/" + id;
    });
  });
})(window);
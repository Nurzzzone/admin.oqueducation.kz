/*=========================================================================================
    File Name: Form-Repeater.js
    Description: form repeater page specific js
    ----------------------------------------------------------------------------------------
    Item Name: Frest HTML Admin Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(document).ready(function () {
  // form repeater jquery
  $('.file-repeater, .contact-repeater, .repeater-default').repeater({
    show: function () {
      $(this).slideDown();
      $('.hint-box').each(function() {
        let button = $(this).find('.hint-button');
        let hintbox = $(this).find('.hint-popover');
        $(button).on('click', function() {
            $(hintbox).toggle();
        });
      });
    },
    hide: function (deleteElement) {
      if (confirm('Are you sure you want to delete this element?')) {
        $(this).slideUp(deleteElement);
      }
    },
    repeaters: [{
      selector: '.inner-repeater',
      show: function () {
        $(this).slideDown();
      },
      hide: function (element) {
        $(this).slideUp(element);
      },
    }],
  });
});

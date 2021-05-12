/*=========================================================================================
  File Name: footer.js
  Description: Template footer js.
  ----------------------------------------------------------------------------------------
  Item Name: Frest HTML Admin Template
 Version: 1.0
  Author: Pixinvent
  Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/

//Check to see if the window is top if not then display button
$(document).ready(function(){
    $(window).scroll(function(){
        if ($(this).scrollTop() > 400) {
            $('.scroll-top').fadeIn();
        } else {
            $('.scroll-top').fadeOut();
        }
    });

    //Click event to scroll to top
    $('.scroll-top').click(function(){
        $('html, body').animate({scrollTop : 0},1000);
    });

    // upload image on teacher create page
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
      
    $("#imageUpload").change(function() {
        readURL(this);
    });

    let phoneInputMask = new Inputmask({
        mask: '+7 (999)-999-99-99',
        rightAlign: false,
        showMaskOnHover: false,
        showMaskOnFocus: false,
        placeholder: "_",
    });

    phoneInputMask.mask($('#teacherPhoneNumber'));
    phoneInputMask.mask($('#studentPhoneNumber'));
    phoneInputMask.mask($('#p1PhoneNumber'));
    phoneInputMask.mask($('#p2PhoneNumber'));

    // remove loader after page is loaded on classes page
    $('#class-loader').addClass('d-none');
    $('#class-content').fadeIn(400);
    $('ul[role="tablist"]').addClass('pl-4');
});

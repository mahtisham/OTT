"use strict";
// Define your library strictly...
$(function() { 
          $("form:not(#updaterform)").on('submit', function () {
                      if($(this).valid()){
                        $('.preL').fadeIn('fast');
                        $('.preloader3').fadeIn('fast');
                        $('.container').css({ '-webkit-filter':'blur(5px)'});
                        $('body').attr('scroll','no');
                        $('body').css('overflow','hidden');
                      }
                  });
          });
 (function() {
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
$("#logo").on('change',function() {
  readURL1(this);
});
function readURL1(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#logo-prev').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
 function readURL2(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#fav-prev').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#favicon").on('change',function() {
  readURL2(this);
});
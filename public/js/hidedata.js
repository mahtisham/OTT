"use strict";

    function hideforme(id,type){
      //var SITEURL = '{{URL::to('')}}';
     // event.preventDefault();
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
  
        url: hideurl,
        method:"POST",
        data :{id : id, type : type},
        dataType:'json',
        success: function (data) {
          console.log(data.msg);
          setTimeout(function(){// wait for 5 secs(2)
         
            // $('.home-prime-slider').html(data.message);
            //   $('a').attr('id', 'kalpana-'+id);
            //   $("a > #kalpana-"+id).append(" <div class='overlay-bg'>You can write your Text Here </div>.");
             // then reload the page.(3)
           location.reload();
         }, 500); 
        },
        error: function (data) {
          console.log(data.msg)
        }
      });
   
    };


//The switching efffect on the 2 forms
  $(function(){
    $('#signUp').on('click', function(e){
      
      $(".form1").hide("slow");
      $('.form2').css('display', 'inline');

      e.preventDefault();
    });
  });
    $(function(){
    $('#logIn').on('click', function(e){
      $(".form2").hide("slow");
      $('.form1').css('display', 'inline');
      e.preventDefault();
    });
  });




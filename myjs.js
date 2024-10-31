jQuery(document).ready(function($){

/*  

$(function() {
  
  $('#notify_login_fail').on('change', function(e) {
    if($(this).is(":checked")) {
      $('#notify_login_fail_showpass').removeAttr('disabled');
            	$('#notify_login_fail_goodto').removeAttr('disabled');
    } else {
   $('#notify_login_fail_showpass').attr('disabled','disabled');
            $('#notify_login_fail_goodto').attr('disabled','disabled');
    }
    
  });
  
});


$('#notify_login_fail_showpass').attr('disabled','disabled');
$('#notify_login_fail_goodto').attr('disabled','disabled');

if($("#notify_login_fail").is(':checked')){
         $('#notify_login_fail_showpass').removeAttr('disabled');
        $('#notify_login_fail_goodto').removeAttr('disabled');

   }

  
});

*/

// Controlla che sia inserito qualcosa #token_0 #chatids_ nella pagina test se no disabilita il bottone

jQuery(document).ready(function($){
  var button = $('#buttonTest');
  button.prop('disabled', true);
  button.text('INSERT VALID TOKEN AND CHATIDs SAVE BEFORE TEST');

  var input1 = $('#token_0');
  var input2 = $('#chatids_');

  input1.on('input', checkInputs);
  input2.on('input', checkInputs);

  checkInputs();

  function checkInputs() {
    var token = input1.val();
    var chatid = input2.val();
    var tokenLength = token.length;
    var chatidLength = chatid.length;

    console.log("tokenleng"+tokenLength);
    console.log("tchatidlenght"+chatidLength);

    if (tokenLength> 14 && chatidLength> 5) {
      button.prop('disabled', false);
      button.text('TEST');
    
    } else {
      button.prop('disabled', true);
      button.text('INSERT VALID TOKEN AND CHATIDs SAVE BEFORE TEST');
      
      ;
    }
  }
  
  
 
  
});


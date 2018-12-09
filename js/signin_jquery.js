//this is the page im using to run the post using ajax to the signup php script and where the json error results are caught
$(document).ready(function() {
	$("form[name ='signup']").submit(function(event) {


		$('.form-group').removeClass('has-error');
		$('.help-block').remove();
		$('#signup_submit').prop("disabled",true);
		$('#signup_submit').css("cursor","not-allowed");
		var formData = {
			'uname' 			: $('input[name=uname]').val(),
			'email' 			: $('input[name=email]').val(),
			'utype' 			: $('select[name=utype]').val(),
			'pwd' 				: $('input[name=pwd]').val(),
			'pwd_rp' 			: $('input[name=pwd_rp]').val()
		};
		$.ajax({
			type 		: 'POST',
			url 		: 'includes/signin_action_page.inc.php',
			data 		: formData,
			dataType 	: 'json',
			encode 		: true
		})
			.done(function(data) {
				console.log(data); 
				if ( ! data.success) {
					if (data.errors.uname) {
						$('#uname-group').addClass('has-error');
						$('#uname-group').append('<div class="help-block">' + data.errors.uname + '</div>');
						$('#signup_submit').prop("disabled",false);
						$('#signup_submit').css("cursor","pointer");
					}
					if (data.errors.email) {
						$('#email-group').addClass('has-error');
						$('#email-group').append('<div class="help-block">' + data.errors.email + '</div>');
						$('#signup_submit').prop("disabled",false);
						$('#signup_submit').css("cursor","pointer");
					}
					if (data.errors.utype) {
						$('#utype-group').addClass('has-error');
						$('#utype-group').append('<div class="help-block">' + data.errors.utype + '</div>');
						$('#signup_submit').prop("disabled",false);
						$('#signup_submit').css("cursor","pointer");
					}
					if (data.errors.pwd) {
						$('#pwd-group').addClass('has-error');
						$('#pwd-group').append('<div class="help-block">' + data.errors.pwd + '</div>');
						$('#signup_submit').prop("disabled",false);
						$('#signup_submit').css("cursor","pointer");
					}
					if (data.errors.pwd_rp) {
						$('#pwd_rp-group').addClass('has-error');
						$('#pwd_rp-group').append('<div class="help-block">' + data.errors.pwd_rp + '</div>');
						$('#signup_submit').prop("disabled",false);
						$('#signup_submit').css("cursor","pointer");
					}

					if (data.errors.unamechk) {
						$("form[name ='signup']").append('<div class="alert alert-info alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.errors.unamechk + '</div> ');
						$('#signup_submit').prop("disabled",false);
						$('#signup_submit').css("cursor","pointer");
					}
					
					if (data.errors.emailchk) {
						$("form[name ='signup']").append('<div class="alert alert-info alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.errors.emailchk + '</div> ');
						$('#signup_submit').prop("disabled",false);
						$('#signup_submit').css("cursor","pointer");
					} 
					if (data.errors.emailverification) {
						$("form[name ='signup']").append('<div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.errors.emailverification + '</div> ');
						$('#signup_submit').prop("disabled",false);
						$('#signup_submit').css("cursor","pointer");
					} 

				} else {

					
					$("form[name ='signup']").append('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.message + '</div>');


				}
			})
			.fail(function(data) {
				// leaving this in for your user
				console.log(data);
			});
		event.preventDefault();
	});

});
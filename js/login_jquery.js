$(document).ready(function() {
	$("form[name ='login']").submit(function(event) {
		$('.form-group').removeClass('has-error');//im going to be adding it 
		$('.help-block').remove();//it will be added as well
		var formData = {
			'loginuname' 			: $('input[name=loginuname]').val(),
			'loginpwd' 				: $('input[name=loginpwd]').val(),
		};
		$.ajax({
			type 		: 'POST',
			url 		: 'includes/login_action_page.inc.php',
			data 		: formData,
			dataType 	: 'json',
			encode 		: true
		})
			.done(function(data) {
				console.log(data); 
				if ( ! data.success) {
					if (data.errors.loginuname) {
						$('#uname-login-group').addClass('has-error');
						$('#uname-login-group').append('<div class="help-block">' + data.errors.loginuname + '</div>');
					}
					if (data.errors.loginpwd) {
						$('#pwd-login-group').addClass('has-error');
						$('#pwd-login-group').append('<div class="help-block">' + data.errors.loginpwd + '</div>');
					} 

				} else {
					$('form').append('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.message + '</div>');
					window.location = '/Landing_page.php';

				}
			})
			.fail(function(data) {
				// leaving this for your use
				console.log(data);
			});

		// stoping form from submitting the normal way 
		event.preventDefault();
	});

});









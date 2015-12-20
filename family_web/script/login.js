$(document).on("pageinit", "#index", function() {
	function _checkLogin(username, password) {
		var _name = username, _pass = password;
		alert(_name + "; " + _pass);
	}

	var submit = $('#submit');
	submit.tap(function(e) {
		// e.preventDefault();
		var that = $(this),
				formData = $("#loginForm").serialize();
		
		console.log(formData.username);
		console.log(formData);
		$.mobile.loading("show");
		var defer = $.ajax({
			type: "POST",
			url: Constants.PROTOCAL+Constants.HOST+":"+Constants.PORT+Constants.LOGIN_ACTION,
			data: formData
		});
		defer.then(function (response) {
			console.log(response);
		//	$.mobile.changePage("index.html");
			window.location.href=Constants.PROTOCAL+Constants.HOST+":"+Constants.PORT+"/family_web/index.html";
		}, function (error) {
			console.log("Error occured: ");
			console.log(error);
			alert("Error: check your account/password!");
			$.mobile.loading("hide");
	//		$.mobile.changePage("#home");
		});
	});
});

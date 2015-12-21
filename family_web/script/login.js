$(document).on("pageinit", "#index", function() {
	function _checkLogin() {
		var _name = $("#username").val(),
			_pass = $("#password").val();
		//alert(_name + "; " + _pass);
		if(_name && _pass) return true;
		return false;

	}

	function _setCookie() { }

	var submit = $('#submit');
	submit.tap(function(e) {
		var that = $(this),
				formData = $("#loginForm").serialize();
		if(!_checkLogin()) {
			alert(Constants.LOGIN_NOT_NULL);
		}
		//console.log(formData);
		$.mobile.loading("show");
		var defer = $.ajax({
			type: "POST",
			url: Constants.PROTOCAL+Constants.HOST+":"+Constants.PORT+Constants.LOGIN_ACTION,
			data: formData
		});
		defer.then(function (response) {
			console.log(response);
		//	$.mobile.changePage("index.html");
			window.location = Constants.PROTOCAL+Constants.HOST+":"+Constants.PORT+"/family_web/index.html";
		}, function (error) {
			console.log("Error occured: ");
			console.log(error);
			alert(Constants.LOGIN_ERROR);
			$.mobile.loading("hide");
		});
	});
});

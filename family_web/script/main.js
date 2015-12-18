$(document).on("pageinit", "#index", function () {
	// 
//	alert("haha");
	function _checkLogin(username, password) {
		var _name = username, _pass = password;
		alert(_name + "; " + _pass);
	}

	var submit = $('#submit');
	submit.on("click", function(e) {
		// e.preventDefault();
		var that = $(this),
				formData = $("#loginForm").serialize();
		console.log(formData);
		$.mobile.loading("show");
		var defer = $.ajax({
			type: "POST",
			url: Constants.PROTOCAL+Constants.HOST+":"+Constants.PORT+Constants.LOGIN_ACTION,
			data: formData
			/*success: function(data, status) {
				alert($.trim(data));
			},
			error: function(data, status) {
				alert(data + ": " + status);
			}*/
		});
		defer.then(function (response) {
			console.log(response);
			// $.mobile.loading("hide");
			// $.mobile.changePage("#home");
			// $("#home").show();
			that.href = Constants.PROTOCAL+Constants.HOST+":"+Constants.PORT + "/family_web/index.html";
		}, function (error) {
			console.log("Error occured: ");
			console.log(error);
			alert("Error: check your account/password!");
			$.mobile.loading("hide");
	//		$.mobile.changePage("#home");
//			$("#home").find(".ui-content p").first().text(error);
	//		$.mobile.loading("hide");
		});
	});
});

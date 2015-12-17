$(document).on("pageinit", "#index", function () {
	// 
//	alert("haha");
	function _checkLogin(username, password) {
		var _name = username, _pass = password;
		alert(_name + "; " + _pass);
	}

	var submit = $('#submit');
	submit.on("click", function(e) {
		e.preventDefault();
		var formData = $("#loginForm").serialize();
		console.log(formData);
		var defer = $.ajax({
			type: "POST",
			url: "http://localhost/family/index.php/family/login",
			data: formData
			/*success: function(data, status) {
				alert($.trim(data));
			},
			error: function(data, status) {
				alert(data + ": " + status);
			}*/
		});
		defer.then(function (response) {
			console.log(success);
			$("#home").html(response);
		}, function (error) {
			console.log(error);
		});
	});
};

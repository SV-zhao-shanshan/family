(function () {
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
		$.ajax({
			type: "POST",
			url: "http://112.74.99.162:8088/index.php/family/login",
			data: formData,
			success: function(data, status) {
				alert($.trim(data));
			},
			error: function(data, status) {
				alert(data + ": " + status);
			}
		});
	});
})();

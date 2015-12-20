$(document).on("pagebeforecreate", "#index", function () {
	// 在页面加载前，检查用户是否已经登录，若没有，则跳转到登录页面
	alert("Page before create");
	console.log("check cookie: ");
	var cookie = document.cookie;
	console.log(cookie);
	
});

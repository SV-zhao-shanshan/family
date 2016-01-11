$(document).on("pagebeforecreate", function() {
//	alert("llll");
	Utils.checkLogin();
//	alert("beforeload");
	createPage();
});

function createPage() {
$(document).on("pageinit", "#index", function () {
	// 在页面加载前，检查用户是否已经登录，若没有，则跳转到登录页面

//	Utils.checkLogin();

	function getBookInfo() {
		var defer = $.ajax({
			type: "GET",
			url: Constants.PROTOCAL + Constants.HOST + Constants.PORT + Constants.BOOKINFO_URL,
			data: {"user_id":localStorage.getItem("user_id")}
		});
		
		defer.then(function(response) {
			console.log(response);
			var res = $.parseJSON(response),
				book_list = res.data.book_list,
				type_list = res.data.type_list;
			console.log(res);
			for(var i=0,l=book_list.length;i<l;i++) {
				console.log(book_list[i]);
			}
			var types = $("#type"), ops = "";
			for(i=0,l=type_list.length;i<l;i++) {
				console.log(type_list[i]);
				var name = type_list[i].name,
					id = type_list[i].id;
				ops += "<option value='" + name + "' id='"+ id +"'>" + name  + "</option>";
			}
			types.html(ops);
			
		}, function(error) {
			console.log(error);
		});
	}
	
	localStorage.setItem("user_id", Utils.getCookie("user_id"));

	getBookInfo();
	
	$("#addNew").tap(function(evt) {
		var request = $.ajax({
			type:"POST",
			url: Constants.PROTOCAL + Constants.HOST + Constants.PORT + Constants.ADDRECORD,
			data: params
		});
		request.then(function(response) {
			console.log("Success:");
			console.log(response);
		}, function(error) {
			console.log("Fail:");
			console.log(error);
		});
	});
});
}

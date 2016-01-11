var Utils = (function(window, document) {
	// Check user login status
	function checkLogin() {
		if(!getCookie("user_id")) {
			window.location = Constants.PROTOCAL+Constants.HOST+Constants.PORT+Constants.LOGIN_URL;
		}
	}

	function getCookie(name) {
		var result = null,
			cookie = document.cookie,
			myCookieArr = cookie.split(";");
		if(cookie.indexOf(name) != -1) {
			for(var i=0,l=myCookieArr.length;i<l;i++) {
				var tmp = myCookieArr[i].split("=");
				if($.trim(tmp[0]) == name) {
					result = tmp[1];
					break;
				}
			}
		}
		return result;
	}

	return {
		checkLogin: checkLogin,
		getCookie: getCookie
	};
})(window, document);

function resolveUrl(url) {
	console.log(url);
	var path = url.replace(/\//gi, "").trim();
	if (path) {
		$("#body-container").load("/" + path + "/" + path + ".php");
		return path;
	} else {
		$("#body-container").load("/home/home.php");
	}
}

function resolveActiveTab(pathName) {
	$(".nav-item").removeClass("active");
	if (pathName) {
		$("li > a[href='" + pathName + "']")
			.parent()
			.addClass("active");
	} else {
		$("li > a")
			.first()
			.parent()
			.addClass("active");
	}
}

$.fn.serializeObject = function() {
	var o = {};
	var a = this.serializeArray();
	$.each(a, function() {
		if (o[this.name]) {
			if (!o[this.name].push) {
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || "");
		} else {
			o[this.name] = this.value || "";
		}
	});
	return o;
};

function meter(input) {
	var level = 0;
	level += input.length > 6 ? 1 : 0;
	level += /[!@#$%^&*?_~]{1,}/.test(input) ? 1 : 0;
	level += /[a-z]{2,}/.test(input) ? 1 : 0;
	level += /[A-Z]{1,}/.test(input) ? 1 : 0;
	level += /[0-9]{1,}/.test(input) ? 1 : 0;
	return level;
}

function formValidator(form, error) {
	$(form).on("input", function() {
		$(error).html("");
		var nameRegex = /^[a-zA-Z]'?[-a-zA-Z]+$/;
		var usernameRegex = /^[a-zA-Z0-9_]+$/;
		var emailRegex = /^[A-Za-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{1,4}[^\\S]+$/;
		var track = 0;
		$(this)
			.find("input[name]")
			.each(function() {
				var inputName = $(this)
					.attr("name")
					.trim();
				var inputVal = $(this).val();
				if ((inputName == "firstname" || inputName == "lastname") && inputVal && !nameRegex.test(inputVal)) $(error).append($("<li></li>").html("Only A-Z, a-z, - and ' allowed on " + inputName));
				else if (inputName == "username" && inputVal && !usernameRegex.test(inputVal)) $(error).append($("<li></li>").html("Only A-Z, a-z, 0-9 and _ allowed " + inputName));
				else if (inputName == "email" && inputVal && !emailRegex.test(inputVal)) $(error).append($("<li></li>").html("Formart should be example@domain.com"));
				else if (inputName == "password1") {
					meterVal = meter(inputVal);
					$(".meter-bar").stop();
					$(".meter-bar").animate(
						{
							width: (meterVal / 5) * 100 + "%"
						},
						300
					);
				} else if (inputName == "password2" && inputVal) {
					if (meterVal < 4) $(error).append($("<li></li>").html("Password too weak"));
					if (inputVal != $("input[name='password1']").val()) $(error).append($("<li></li>").html("Passwords don't match"));
				}
				if (!inputVal) track++;
			});
		if (
			track == 0 &&
			!$(error)
				.html()
				.trim()
		) {
			$("input[type='submit']").removeClass("disabled");
			$("input[type='submit']").removeAttr("disabled");
		} else {
			$("input[type='submit']").addClass("disabled");
			$("input[type='submit']").attr("disabled", "disabled");
		}
	});
}

$(document).ready(function() {
	if ($(window).width() < 768) {
		$(".nav-link").each(function() {
			$(this).append($(this).attr("title"));
		});
		$(".nav-link").click(function(e) {
			$(".navbar-toggler").click();
		});
	} else {
		$(".nav-link").tooltip({
			trigger: "hover"
		});
	}

	var currentPath = resolveUrl(window.location.pathname);
	resolveActiveTab(currentPath);

	$(document).ajaxStart(function() {
		$("#loader").css({
			display: "block"
		});
	});
	$(document).ajaxStop(function() {
		$("#loader").css({
			display: "none"
		});
	});

	$(".nav-link").click(function(e) {
		e.preventDefault();
		var path = $(this).attr("href");
		if (path === "logout") {
			$("#body-container").load("/" + path + "/" + path + ".php");
			window.location.href = "http://" + window.location.hostname;
		} else {
			$("#body-container").load("/" + path + "/" + path + ".php");
		}
		resolveActiveTab(path);
		window.history.pushState("", "", "/" + path + "/");
	});
});

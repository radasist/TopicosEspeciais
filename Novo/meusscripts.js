var timeoutMessage;

var isValid = function() {
	var validate = $("form").attr("validate");
	
	if (validate = "usuario") {
		var senha = $("input#senha").val();
		var senha2 = $("input#senha2").val();
		if (senha == senha2) {
			return true;
		} else {
			showMessage("error", "As duas senhas são diferentes, por favor verifique!");
			$("input#senha").focus();
			return false;
		}
	} else {
		return true;
	}
}

var showMessage = function(type, message) {
	$("div.message-bar").removeClass("error");
	$("div.message-bar").removeClass("success");
	$("div.message-bar-message").html(message);
	$("div.message-bar").addClass(type);
	$("div.message-bar").addClass("show");

	timeoutMessage = setTimeout(function(){
		$("div.message-bar").removeClass("show");
	}, 3000);
};

var addPagesListeners = function() {
	$("span.link").each(function() {
    	$(this).click(function(){
			$(".progress-bar").addClass("show");

			var data = $(this).attr("data");
			var loadPageContent = $.post($(this).attr("page")+".php", {id: data}, function(result){
                $(".principal-container").html(result);
                $(".progress-bar").removeClass("show");
                addPagesListeners();
            });
            loadPageContent.fail(function() {
            	$(".progress-bar").removeClass("show");
				showMessage("error", "Ocorreu um erro e não foi possível acessar a página solicitada!");
			});
    	});
    });

    $("span.confirm").each(function() {
    	$(this).click(function(){
    		var data = $(this).attr("data");
    		var message = $(this).attr("msg");
    		var page = $(this).attr("page");

			$(".confirm-message").html(message);
			$(".confirm-outer").addClass("show");

			$("span.confirm-yes").unbind();
			$("span.confirm-yes").click(function(){
				$(".confirm-outer").removeClass("show");
				$(".progress-bar").addClass("show");
				var loadPageContent = $.post(page+".php", {id: data}, function(result){
	                $(".principal-container").html(result);
	                $(".progress-bar").removeClass("show");
	                addPagesListeners();
	            });
	            loadPageContent.fail(function() {
	            	$(".progress-bar").removeClass("show");
					showMessage("error", "Ocorreu um erro e não foi possível completar a ação solicitada!");
				});
			});
    	});
    });

    $("input[type=submit]").each(function() {
    	$(this).click(function(e){
    		if ($("form")[0].checkValidity() == true && isValid() == true) {
    			e.preventDefault();
    			$(".progress-bar").addClass("show");
	    		var sendForm = $.post($(this).attr("page")+".php", getFormValues(), function(result){
	                $(".principal-container").html(result);
	                addPagesListeners();
	                $(".progress-bar").removeClass("show");
	            });
	            sendForm.fail(function() {
	            	$(".progress-bar").removeClass("show");
					showMessage("error", "Ocorreu um erro e não foi possível completar o cadastro/alteração!");
				});
    		} else if ($("form")[0].checkValidity() == true) {
    			e.preventDefault();
    		}
    	});
    });
};

var getFormValues = function() {
	var allValues = {};
	$("input").each(function() {
		if ($(this).attr("type") == "radio") {
			if ($(this).prop("checked") == true) {
				allValues[this.name] = this.value;
			}
		} else {
			allValues[this.name] = this.value;
		}
	});
	$("select").each(function() {
		allValues[this.name] = this.value;
	});

	return allValues;
}

$(document).ready(function() {
	$("div.menu-button").click(function(){
		$("body").toggleClass("menu-open");
	});

	$("li.site").each(function() {
		$(this).click(function(){
            $(".progress-bar").addClass("show");
            $("body").removeClass("menu-open");

			var loadPageMenu = $.post($(this).attr("page")+".php", {}, function(result){
                $(".principal-container").html(result);
                $(".progress-bar").removeClass("show");
                addPagesListeners();
            });
            loadPageMenu.fail(function() {
            	$(".progress-bar").removeClass("show");
				showMessage("error", "Ocorreu um erro e não foi possível acessar a opção solicitada!");
			});
		});
	});

	$("li.link").each(function() {
		$(this).click(function() {
			window.location.assign($(this).attr("page"));
		});
	});

	$("div.principal-container").click(function(){
    	$("body").removeClass("menu-open");
    });

	$("span.confirm-no").click(function(){
		$("div.confirm-outer").removeClass("show");
	});

	$("div.message-bar-close").click(function(){
		$("div.message-bar").removeClass("show");
	});

	$("div.message-bar").mouseleave(function(){
		timeoutMessage = setTimeout(function(){
			$("div.message-bar").removeClass("show");
		}, 3000);
	});
	
	$("div.message-bar").mouseover(function(){
		clearTimeout(timeoutMessage);
	});
});


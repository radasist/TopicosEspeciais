var timeoutMessage;

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
    		if ($("form")[0].checkValidity() == true) {
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

	return allValues;
}

$(document).ready(function() {
	$(".menu-button").click(function(){
		$("body").toggleClass("menu-open");
	});

	$("li").each(function() {
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


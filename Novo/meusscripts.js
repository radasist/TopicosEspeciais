var addPagesListeners = function() {
	$("a.link").each(function() {
    	$(this).click(function(){
			$(".principal-container").html("Carregando...");

			var data = $(this).attr("data");
			var loadPageContent = $.post($(this).attr("page")+".php", {id: data}, function(result){
                $(".principal-container").html(result);
                addPagesListeners();
            });
            loadPageContent.fail(function() {
				$(".principal-container").html("Ocorreu um erro...");
			});
    	});
    });

   //  $("a.confirm").each(function() {
   //  	$(this).click(function(){
			// $(".principal-container").html("Carregando...");

			// var data = $(this).attr("data");
			// var loadPageContent = $.post($(this).attr("page")+".php", {id: data}, function(result){
   //              $(".principal-container").html(result);
   //              addPagesListeners();
   //          });
   //          loadPageContent.fail(function() {
			// 	$(".principal-container").html("Ocorreu um erro...");
			// });
   //  	});
   //  });

    $("input[type=button]").each(function() {
    	$(this).click(function(){
    		var sendForm = $.post($(this).attr("page")+".php", getFormValues(), function(result){
                $(".principal-container").html(result);
                addPagesListeners();
            });
            sendForm.fail(function() {
				$(".principal-container").html("Ocorreu um erro...");
			});
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
            $(".principal-container").html("Carregando...");
            $("body").removeClass("menu-open");

			var loadPageMenu = $.post($(this).attr("page")+".php", {}, function(result){
                $(".principal-container").html(result);
                addPagesListeners();
            });
            loadPageMenu.fail(function() {
				$(".principal-container").html("Ocorreu um erro...");
			});
		});
	});

	$("div.principal-container").click(function(){
    	$("body").removeClass("menu-open");
    });

	$("a.confirm-no").click(function(){
		$("div.confirm-outer").removeClass("show");
	});
});


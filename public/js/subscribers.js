$(document).ready(function() {

	$("#addSubscriber").submit(function() {
                var form = this;
		$.ajax({
			type: "POST",
			url: "/subscriber/add",
			data: $(this).serialize(),
                        success: function(data){
                            $(form).find("input").val("");
                            alert("Спасибо за подписку!");
                        }
		});
		return false;
	});
	
});
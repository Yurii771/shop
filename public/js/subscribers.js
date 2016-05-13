$(document).ready(function() {

	$("#addSubscriber").submit(function() {
		$.ajax({
			type: "POST",
			url: "Subscriber/add",
			data: $(this).serialize()
		}).done(function() {
			$(this).find("input").val("");
			alert("Спасибо за подписку!");
		});
		return false;
	});
	
});
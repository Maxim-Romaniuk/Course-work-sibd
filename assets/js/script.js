$(document).ready(function() {

	//E-mail Ajax Send
	$("form").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "vendor/mail.php", //Change
			data: th.serialize()
		}).done(function() {
			alert("Спасибо, администратор скоро свяжется с вами. \nЗакройте данное уведомление чтобы перейти на страницу входа.");
			setTimeout(function() {
				window.location.replace('../index.php');
			}, 1000);
		});
		return false;
	});

});
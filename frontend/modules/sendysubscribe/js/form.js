$("#add").submit(function(event) {
	event.preventDefault();

	$.ajax({
		url : '/frontend/ajax.php',
		data : {
			fork : {
				module : 'sendysubscribe',
				action : 'addToList'
			},
			data : $("#add").serialize(),
		},

		dataType : 'html',
		success : function(data) {
			$("#error").empty();
			$("#confirm").text(JSON.parse(data).message);
		},
		error : function(data) {

			$("#confirm").empty();
			$("#error").text(JSON.parse(data.responseText).message);
		}
	});
});


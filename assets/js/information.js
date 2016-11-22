jQuery(function()
{
	$.ajax({
		type: "get",
		url: "localhost:8888/information",
		dataType: "application/json",
		data: {
			info_title: Title,
			info_content: Content,
		},
		success: function(data) {
			console.log(status);

			var info = '';

			for( var i in data)
			{
				info += '<h3>' + data[i].info_title + '</h3>';
			}

			jQuery('div.dropdown-headline').html(info);


		},
		error: function(data) {

		});
});


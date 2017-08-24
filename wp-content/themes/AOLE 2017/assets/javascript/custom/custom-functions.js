// Add a listing of a certain days events to the events header

jQuery(".event-calendar").on( "click", ".eventful button, .eventful-pre button, .eventful-post button, *[class^='eventful'] button", function(){
	

	var events = $.parseJSON($(this).attr('data-events'));

	
	var date = $(this).attr('data-date');

	// Clear the div first
	$("#day-event-list").html("");
	$("#day-event-list").append("<h5>"+date+"</h5>");

	for (var i in events){
		var eventTitle = "<a href='"+events[i].permalink+"'><span class='day-event-title'>"+events[i].event.event_name+"</span></a>";
		$("#day-event-list").append(eventTitle);
		console.log(events[i]);
	}
	

});


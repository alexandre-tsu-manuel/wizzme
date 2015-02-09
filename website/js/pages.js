function switchPages()
{
	if ($("#menu").html() == "Contact us")
	{
		$('#indexPage').hide("slow");
		$("#menu").html("Home");
		document.title = "Contact the team";
		$('#contactSection').show("slow");
	}
	else
	{
		$('#contactSection').hide("slow");
		$("#menu").html("Contact us");
		document.title = "Wizzme - IPhone app";
		$('#indexPage').show("slow");
	}
}

var element = document.getElementById('menu');

if (element.addEventListener)
	element.addEventListener('click', switchPages, false);
else
	element.attachEvent('onclick', switchPages);
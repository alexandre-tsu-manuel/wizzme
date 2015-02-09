var numSlide = 0;
function slider()
{
	switch(numSlide)
	{
		case 0:
			$('#firstSprite').fadeOut(1000);
			$('#secondSprite').fadeIn(1000);
		break;
		case 1:
			$('#secondSprite').fadeOut(1000);
			$('#thirdSprite').fadeIn(1000);
		break;
		case 2:
			$('#thirdSprite').fadeOut(1000);
			$('#firstSprite').fadeIn(1000);
		break;
	}
	numSlide++;
	if (numSlide == 3)
		numSlide = 0;
}
setInterval(slider, 5000);
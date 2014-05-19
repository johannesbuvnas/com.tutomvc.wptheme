define([
	"jquery",
	"app/AppConstants",
	"app/AppModel"
],
function(
	$,
	AppConstants,
	AppModel
)
{
	return function(id)
	{
		if(!$("#" + id).offset()) return;
		
		AppModel.set({
			scrollTop : $("#" + id).offset().top
		});
	};
});
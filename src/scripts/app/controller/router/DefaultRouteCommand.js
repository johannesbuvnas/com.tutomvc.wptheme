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
		console.log("DefaultRouteCommand");
		AppModel.set({
			scrollTop : $("#" + id).offset().top
		});
	};
});
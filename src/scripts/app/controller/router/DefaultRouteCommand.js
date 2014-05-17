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
		AppModel.set({
			scrollTop : $("#" + id).offset().top
		});
	};
});
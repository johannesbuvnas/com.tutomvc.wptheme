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
		
		// $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).animate( {
		// 	scrollTo : {
		// 		y : $("#" + id).offset().top
		// 	}
		// },
		// 0);
	};
});
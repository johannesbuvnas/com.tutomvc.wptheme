define([
	"jquery"
],
function($)
{
	return function(id)
	{
		$("body").scrollTop( $("#" + id).offset().top );
	};
});
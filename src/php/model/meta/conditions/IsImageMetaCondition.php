<?php
namespace tutomvc\theme;
use \tutomvc\MetaCondition;

class IsImageMetaCondition extends MetaCondition
{
	function __construct()
	{
		parent::__construct( NULL, NULL, NULL, $callbackOnMatch = self::CALLBACK_SHOW, self::CALLBACK_HIDE );
	}

	function getJavaScriptValidationMethod()
	{
		return "
			function( metaBoxName, metaFieldName, value )
			{
				if(TutoMVC.post.post_mime_type.indexOf('image') < 0)
				{
					return false;
				}
				else
				{
					return true;
				}

				return undefined;
			}
		";
	}
}
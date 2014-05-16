<?php
namespace tutomvc\theme;

class AppUtil
{
	/* ACTIONS */
	public static function validateUser()
	{

	}
	/* METHODS */
	public static function isValidUser()
	{
		if( filter_var( get_option(ThemeSettings::IS_PROTECTED), FILTER_VALIDATE_BOOLEAN ) && !is_user_logged_in() )
		{
			return FALSE;
		}
	}
}
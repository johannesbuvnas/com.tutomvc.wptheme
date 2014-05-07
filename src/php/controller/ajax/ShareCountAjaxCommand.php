<?php
namespace tutomvc\theme;
use \tutomvc\AjaxCommand;

class ShareCountAjaxCommand extends AjaxCommand
{
	const NAME = "tutomvc/ajax/ShareCount";

	function __construct()
	{
		parent::__construct( self::NAME );
		$this->setNonceName( AppConstants::NONCE_NAME );
	}

	function execute()
	{
		if(array_key_exists("email", $_REQUEST) && array_key_exists("postID", $_REQUEST))
		{
			ShareMetaBox::addEmailShare( $_REQUEST['postID'] );
		}

		$vo = $this->getFacade()->model->getProxy(SocialNetworkProxy::NAME)->getShareCountVO( $_REQUEST['url'] );
		echo $vo->toJSON();
		exit;
	}
}
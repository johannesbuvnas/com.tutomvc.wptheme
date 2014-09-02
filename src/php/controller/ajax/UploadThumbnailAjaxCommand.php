<?php
namespace tutomvc\theme;
use \tutomvc\AjaxCommand;
use \tutomvc\WordPressUtil;

class UploadThumbnailAjaxCommand extends AjaxCommand
{
	const NAME = "tutomvc/theme/ajax/upload_thumbnail";

	function __construct()
	{
		parent::__construct( self::NAME, AppFacade::NONCE_NAME );
	}

	function execute()
	{
		$canvasData = $_REQUEST['canvasData'];
		$canvasData = str_replace('data:image/png;base64,', '', $canvasData);
		$canvasData = str_replace(' ', '+', $canvasData);
		$canvasData = base64_decode($canvasData);
		$fileName = "Thumbnail: " . get_the_title( $_REQUEST['postID'] ) . ".png";
		$attachmentID = WordPressUtil::uploadAttachmentFromData( $fileName, $canvasData, $_REQUEST['postID'], "This is an automated screenshot used in the navigation of the theme." );

		if(!is_wp_error( $attachmentID )) FeaturedMediaMetaBox::setScreenshotThumbnail( $_REQUEST['postID'], $attachmentID );

		echo json_encode(array(
			"result" => $attachmentID
		));
		exit;
	}
}
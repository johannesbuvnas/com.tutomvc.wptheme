<?php
namespace tutomvc\theme;
use \tutomvc\FilterCommand;
/**
*	Fork version of wpautop.
*/

class TheContentFilter extends FilterCommand
{
	const NAME = "the_content";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function execute($content, $br = false)
	{
		// Remove P tags
		$content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
		// Alter attachment links
		$content = preg_replace_callback('/\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*/iU', array( $this, "filterLinkedImages" ), $content);
		return $content;
	}

	function filterLinkedImages( $matches )
	{
		$html = $matches[0];
		$doc = new \DOMDocument;
		$doc->loadHTML( $html );
		$as = $doc->getElementsByTagName('a');
		foreach ($as as $a)
		{
			$img = $a->getElementsByTagName('img')->item( 0 );

			$classNames = $img->getAttribute("class");
			$aClassNames = $a->getAttribute( "class" );
			$a->setAttribute( "class", $aClassNames . " " . $classNames );
			preg_match( '/wp-image-(?<id>\d+)/', $classNames, $attachmentID );
			if(is_array($attachmentID) && array_key_exists("id", $attachmentID))
			{
				$attachmentID = $attachmentID['id'];
				if(filter_var( $attachmentID, FILTER_VALIDATE_INT ))
				{
					$attachmentID = intval($attachmentID);
					if(get_post_type( $attachmentID ) == "attachment" && is_int(strpos( get_post_mime_type( $attachmentID ), "image")))
					{
						$videoLinkageMeta = (array)get_post_meta( $attachmentID, ImageVideoLinkageMetaBox::NAME );
						if(count($videoLinkageMeta))
						{
							$videoLinkageMeta = array_pop($videoLinkageMeta);
							$videoURL = $videoLinkageMeta[ $videoLinkageMeta[ ImageVideoLinkageMetaBox::TYPE ] ];
							if(is_array($videoURL))
							{
								// Attachment is the type
								$videoURL = array_pop($videoURL);
								$videoURL = $videoURL['url'];
							}
							$class = $img->parentNode->getAttribute("class");
							$class .= " MediaLink InlineVideoLinkage";
							$img->parentNode->setAttribute( "href", $videoURL );
							$img->parentNode->setAttribute( "target", "_blank" );
							$img->parentNode->setAttribute( "class", $class );

							$genericon = $doc->createElement("span");
							$genericon->setAttribute( "class", "genericon genericon-play ShadowBox" );

							$a->appendChild( $genericon );
						}
					}
				}
			}
		}
		
		return $doc->saveHTML();
	}
}
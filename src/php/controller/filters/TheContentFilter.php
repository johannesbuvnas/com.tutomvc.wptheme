<?php
namespace tutomvc\theme;
use \tutomvc\FilterCommand;
use \tutomvc\LinkUtil;

/**
 *    Fork version of wpautop.
 * TODO: Filter all a-tags. If the link is linked to content supported by the ekkoLightbox -> add attribute: data-toggle="lightbox"
 */
class TheContentFilter extends FilterCommand
{
	const NAME = "the_content";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function execute( $content, $br = FALSE )
	{
		// Remove P tags
		$content = preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
		// Alter attachment links
		$content = preg_replace_callback( '/\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*/iU', array(
			$this,
			"filterLinkedImages"
		), $content );

		return $content;
	}

	function filterLinkedImages( $matches )
	{
		$html = mb_convert_encoding( $matches[ 0 ], 'HTML-ENTITIES', "UTF-8" );
		$doc  = new \DOMDocument;
		$doc->loadHTML( $html );
		$as = $doc->getElementsByTagName( 'a' );
		foreach ( $as as $a )
		{
			$img = $a->getElementsByTagName( 'img' )->item( 0 );

			if ( $img )
			{
				$classNames  = $img->getAttribute( "class" );
				$aClassNames = $a->getAttribute( "class" );
				$a->setAttribute( "class", $aClassNames . " " . $classNames );
				preg_match( '/wp-image-(?<id>\d+)/', $classNames, $attachmentID );
				if ( is_attachment() )
				{
					global $post;
					$attachmentID = array( "id" => $post->ID );
				}
				if ( is_array( $attachmentID ) && array_key_exists( "id", $attachmentID ) )
				{
					$attachmentID = $attachmentID[ 'id' ];
					if ( filter_var( $attachmentID, FILTER_VALIDATE_INT ) )
					{
						$attachmentID = intval( $attachmentID );
						if ( get_post_type( $attachmentID ) == "attachment" && is_int( strpos( get_post_mime_type( $attachmentID ), "image" ) ) )
						{
							// Only continue if the link is pointed to the file URI
							$video = wp_video_shortcode( array(
								"src"    => $a->getAttribute( "href" ),
								"poster" => wp_get_attachment_url( $attachmentID )
							) );
							if ( LinkUtil::isVideoLink( $a->getAttribute( "href" ) ) )
							{
								if ( LinkUtil::isVimeo( $a->getAttribute( "href" ) ) )
								{
									$a->setAttribute( "href", "//player.vimeo.com/video/" . LinkUtil::getVimeoID( $a->getAttribute( "href" ) ) );
								}
								// This is a video linkage ...
								// $videoLinkageMeta = (array)get_post_meta( $attachmentID, ImageVideoLinkageMetaBox::NAME );
								// if(count($videoLinkageMeta))
								// {
								// 	$videoLinkageMeta = array_pop($videoLinkageMeta);
								// 	$videoURL = $videoLinkageMeta[ $videoLinkageMeta[ ImageVideoLinkageMetaBox::TYPE ] ];
								// 	if(is_array($videoURL))
								// 	{
								// 		// Attachment is the type
								// 		$videoURL = array_pop($videoURL);
								// 		$videoURL = $videoURL['url'];
								// 	}
								// 	$class = $img->parentNode->getAttribute("class");
								// 	$class .= " MediaLink InlineVideoLinkage";
								// 	$img->parentNode->setAttribute( "href", $videoURL );
								// 	$img->parentNode->setAttribute( "target", "_blank" );
								// 	$img->parentNode->setAttribute( "class", $class );

								// 	$genericon = $doc->createElement("span");
								// 	$genericon->setAttribute( "class", "glyphicon glyphicon-play ShadowBox img-rounded" );

								// 	$a->appendChild( $genericon );
								// }
								$class = $img->parentNode->getAttribute( "class" );
								$class .= " MediaLink InlineVideoLinkage";
								$img->parentNode->setAttribute( "target", "_blank" );
								$img->parentNode->setAttribute( "class", $class );
								$img->parentNode->setAttribute( "data-toggle", "lightbox" );
								$genericon = $doc->createElement( "span" );
								$genericon->setAttribute( "class", "glyphicon glyphicon-play ShadowBox img-rounded" );

								$a->appendChild( $genericon );
							}
						}
					}
				}
			}
		}

		return $doc->saveHTML();
	}
}
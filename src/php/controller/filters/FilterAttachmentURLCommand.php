<?php
namespace tutomvc\theme;
use \tutomvc\FilterCommand;

class FilterAttachmentURLCommand extends FilterCommand
{
	const NAME = "wp_get_attachment_url";

	function __construct()
	{
		parent::__construct(self::NAME);
	}

	function execute()
	{
		$siteURL = parse_url( get_option( "siteurl" ) );

		$attachmentURL = parse_url( $this->getArg(0) );
		$attachmentURL['host'] = $siteURL['host'];

		return $this->join_url( $attachmentURL, FALSE );
	}

	function join_url( $parts, $encode=TRUE )
	{
	    if ( $encode )
	    {
	        if ( isset( $parts['user'] ) )
	            $parts['user']     = rawurlencode( $parts['user'] );
	        if ( isset( $parts['pass'] ) )
	            $parts['pass']     = rawurlencode( $parts['pass'] );
	        if ( isset( $parts['host'] ) &&
	            !preg_match( '!^(\[[\da-f.:]+\]])|([\da-f.:]+)$!ui', $parts['host'] ) )
	            $parts['host']     = rawurlencode( $parts['host'] );
	        if ( !empty( $parts['path'] ) )
	            $parts['path']     = preg_replace( '!%2F!ui', '/',
	                rawurlencode( $parts['path'] ) );
	        if ( isset( $parts['query'] ) )
	            $parts['query']    = rawurlencode( $parts['query'] );
	        if ( isset( $parts['fragment'] ) )
	            $parts['fragment'] = rawurlencode( $parts['fragment'] );
	    }
	 
	    $url = '';
	    if ( !empty( $parts['scheme'] ) )
	        $url .= $parts['scheme'] . ':';
	    if ( isset( $parts['host'] ) )
	    {
	        $url .= '//';
	        if ( isset( $parts['user'] ) )
	        {
	            $url .= $parts['user'];
	            if ( isset( $parts['pass'] ) )
	                $url .= ':' . $parts['pass'];
	            $url .= '@';
	        }
	        if ( preg_match( '!^[\da-f]*:[\da-f.:]+$!ui', $parts['host'] ) )
	            $url .= '[' . $parts['host'] . ']'; // IPv6
	        else
	            $url .= $parts['host'];             // IPv4 or name
	        if ( isset( $parts['port'] ) )
	            $url .= ':' . $parts['port'];
	        if ( !empty( $parts['path'] ) && $parts['path'][0] != '/' )
	            $url .= '/';
	    }
	    if ( !empty( $parts['path'] ) )
	        $url .= $parts['path'];
	    if ( isset( $parts['query'] ) )
	        $url .= '?' . $parts['query'];
	    if ( isset( $parts['fragment'] ) )
	        $url .= '#' . $parts['fragment'];
	    return $url;
	}
}
<?php namespace tutomvc\theme;
use \tutomvc\modules\termpage\TermPageModule;

class TaxonomyUtil
{
	/**
	*	Find page with exact same URI as term.
	*/
	public static function getAssociatedPageByTerm( $term )
	{
		return TermPageModule::getLandingPageForTerm( $term->term_taxonomy_id );
	}

	/**
	*	Find page with exact same slug as taxonomy.
	*/
	public static function getAssociatedPageTaxonomyName( $taxonomyName )
	{
		$page = get_page_by_path( \tutomvc\Taxonomy::getTaxonomyRewriteSlug( $taxonomyName ) );

		if($page && $page->post_status != "publish") return NULL;

		return $page;
	}

	/**
	*	Find term with exact same slug structure as page.
	*/
	public static function getAssociatedTerm( $post )
	{
		return TermPageModule::getTermForLandingPage( $post->ID );
	}

	public static function getTaxonomyByRewriteSlug( $rewriteSlug )
	{
		foreach(get_taxonomies() as $taxonomyName)
		{
			$taxonomy = get_taxonomy( $taxonomyName );
			if($taxonomy->rewrite['slug'] == $rewriteSlug) return $taxonomy;
		}

		return NULL;
	}
}
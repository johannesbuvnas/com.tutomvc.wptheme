<?php
/**
*	Search form.
*/
$placeholder =  __("Search ...", "tutomvc-theme");
?>
<form id="searchForm" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<input type="search" autocomplete="off" placeholder="<?php echo $placeholder; ?>" value="<?php if(is_array($_GET) && array_key_exists("s", $_GET)) echo $_GET['s']; ?>" name="s" title="<?php echo $placeholder; ?>" />
	<input type="submit" value="Search" />
</form>
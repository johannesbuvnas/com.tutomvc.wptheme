<?php
/**
*	Search form.
*/
?>
<form id="searchForm" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<input type="search" autocomplete="off" placeholder="Search …" value="<?php if(is_array($_GET) && array_key_exists("s", $_GET)) echo $_GET['s']; ?>" name="s" title="Search for:" />
	<input type="submit" value="Search" />
</form>
<?php
namespace tutomvc\modules\member;
$username = isset($_GET) && array_key_exists("visitor", $_GET) ? $_GET['visitor'] : NULL;
?>
<form name="login" method="post">
	<input type="hidden" name="action" value="<?php echo \tutomvc\modules\member\LoginCommand::NAME; ?>" >
	<input type="hidden" name="redirect" value="<?php echo bloginfo("url").$_SERVER['REQUEST_URI']; ?>" >
	<input type="<?php echo $username ? "hidden" : "text"; ?>" name="username" value="<?php echo $username; ?>" placeholder="<?php echo esc_attr__( "Username" ); ?>">
	<input type="password" name="password" value="" placeholder="<?php echo esc_attr__( "Password" ); ?>">
	<input type="submit" name="Submit" value="<?php echo esc_attr__( "Submit" ); ?>" />
</form>
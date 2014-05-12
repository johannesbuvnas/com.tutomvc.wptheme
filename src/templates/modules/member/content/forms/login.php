<?php
namespace tutomvc\modules\member;
$username = isset($_GET) && array_key_exists("visitor", $_GET) ? $_GET['visitor'] : "visitor";
?>
<form name="login" method="post">
	<input type="hidden" name="action" value="<?php echo \tutomvc\modules\member\LoginCommand::NAME; ?>" >
	<input type="hidden" name="username" value="<?php echo $username; ?>" >
	<input type="password" name="password" value="" placeholder="<?php echo esc_attr__( "Password" ); ?>">
	<input type="submit" name="Submit" value="<?php echo esc_attr__( "Submit" ); ?>" />
</form>
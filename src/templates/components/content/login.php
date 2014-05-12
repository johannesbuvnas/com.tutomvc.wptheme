<?php
namespace tutomvc\theme;
global $themeFacade;

$username = isset($_GET) && array_key_exists("visitor", $_GET) ? $_GET['visitor'] : "visitor";
?>
<div class="ContentBlockContainer PostProtected">
	<div class="ContentBlock">
		<div class="Wrapper">
			<div class="Inner">
				<div class="TheContent Card">
					<div class="Inner">
						<p><img src="<?php echo $themeFacade->getURL( "src/images/symbol-login.png" ); ?>" /></p>
						<p>
							<strong class="DarkText">Knock knock ..</strong><br/>
							Who is knocking on my door?
						</p>
						<form name="login" method="post">
							<input type="hidden" name="action" value="<?php echo \tutomvc\modules\member\LoginCommand::NAME; ?>" >
							<input type="hidden" name="username" value="<?php echo $username; ?>" >
							<input type="password" name="password" value="" placeholder="<?php echo esc_attr__( "Password" ); ?>">
							<input type="submit" name="Submit" value="<?php echo esc_attr__( "Submit" ); ?>" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
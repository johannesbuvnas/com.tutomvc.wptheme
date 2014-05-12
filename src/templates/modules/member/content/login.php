<?php
namespace tutomvc\modules\member;
use \tutomvc\View;

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
						<?php
							do_action( View::getMediatorRenderHook( MemberModule::KEY, LoginContentMediator::NAME ) );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
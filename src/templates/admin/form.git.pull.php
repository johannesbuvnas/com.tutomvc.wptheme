<?php
namespace tutomvc\theme;
?>
<form method="post" action="<?php menu_page_url( ThemeSettingsAdminMenuPage::NAME ); ?>">
	<input type="hidden" name="<?php echo GitPullFormMediator::ACTION_PULL; ?>" value="execute" />
	<?php submit_button( "Pull" ); ?>
</form>
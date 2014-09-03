<?php
namespace tutomvc\theme;
use \tutomvc\AdminMenuSettingsPage;

class ThemeSettingsAdminMenuPage extends AdminMenuSettingsPage
{
	const NAME = "custom_settings";

	function __construct()
	{
		parent::__construct(
			"The Theme",
			"The Theme",
			"edit_theme_options",
			self::NAME,
			NULL,
			NULL
		);

		$this->setType( AdminMenuSettingsPage::TYPE_THEME );
	}

	public function onLoad()
	{
		global $themeFacade;
		$systemFacade = \tutomvc\Facade::getInstance( \tutomvc\Facade::KEY_SYSTEM );
		
		if(!$themeFacade->repository->isInit())
		{
			$systemFacade->notificationCenter->add( $themeFacade->repository->init() );
			$systemFacade->notificationCenter->add( $themeFacade->repository->checkout() );
		}

		$mediator = $themeFacade->view->registerMediator( new GitPullFormMediator() );
		if($themeFacade->repository->hasUnpulledCommits())
		{
			$systemFacade->notificationCenter->add( "You have unpulled commits." . $mediator->getContent() );
		}
		
		$systemFacade->notificationCenter->add( $themeFacade->repository->getStatus() );
	}
}
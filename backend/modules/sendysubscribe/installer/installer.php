<?php

/**
 * Installer for the Sendy Subscribe module.
 *
 * @author Jonathan Spruytte<Jonathan@brandberries.be>
 */
class SendysubscribeInstaller extends ModuleInstaller
{
	/**
	 * Install the module.
	 */
	public function install()
	{
		// load install.sql
		$this->importSQL(dirname(__FILE__) . '/data/install.sql');


		$this->addModule('sendysubscribe', 'The sendy subscribe module');

		// import locale
		$this->importLocale(dirname(__FILE__) . '/data/locale.xml');

		// module rights
		$this->setModuleRights(1, 'sendysubscribe');
		
		// action rights
		$this->setActionRights(1, 'sendysubscribe', 'add');
		$this->setActionRights(1, 'sendysubscribe', 'delete');
		$this->setActionRights(1, 'sendysubscribe', 'edit');
		$this->setActionRights(1, 'sendysubscribe', 'index');
		$this->setActionRights(1, 'sendysubscribe', 'settings');

		// set navigation
		$navigationModulesId = $this->setNavigation(null, 'Modules');
		$this->setNavigation($navigationModulesId, 'Sendysubscribe', 'sendysubscribe/index', array('sendysubscribe/add', 'sendysubscribe/edit'));

		// settings navigation
		$navigationSettingsId = $this->setNavigation(null, 'Settings');
		$navigationModulesId = $this->setNavigation($navigationSettingsId, 'Modules');
		$this->setNavigation($navigationModulesId, 'Sendysubscribe', 'sendysubscribe/settings');
	}
}

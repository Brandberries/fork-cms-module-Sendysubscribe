<?php

/**
 * This is the configuration-object for the Sendy subscribe module
 *
 * @author Jonathan Spruytte<Jonathan@brandberries.be>
 */
final class BackendSendysubscribeConfig extends BackendBaseConfig
{

	/**
	 * Check if all required settings have been set
	 *
	 * @param string $module The module.
	 */
	public function __construct($module)
	{
		// parent construct
		parent::__construct($module);

		// init
		$error = false;
		$action = Spoon::exists('url') ? Spoon::get('url')->getAction() : null;

		if(BackendModel::getModuleSetting('sendysubscribe', 'apiUrl') === null)
			$error = true;

		// missing consumer secret
		if(BackendModel::getModuleSetting('sendysubscribe', 'apiKey') === null)
			$error = true;

		// missing settings, so redirect to the index-page to show a message (except on the index- and settings-page)
		if($error && $action != 'settings')
			SpoonHTTP::redirect(BackendModel::createURLForAction('settings'));
	}

}

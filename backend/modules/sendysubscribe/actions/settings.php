<?php

/**
 * This is the settings-action, it will display a form to set general sendy subscribe settings.
 *
 * @author Jonathan Spruytte<Jonathan@brandberries.be>
 */
class BackendSendysubscribeSettings extends BackendBaseActionEdit
{
	/**
	 * Execute the action
	 */
	public function execute()
	{
		// call parent, this will probably add somse general CSS/JS or other required files
		parent::execute();

		// load form
		$this->loadForm();

		// validates the form
		$this->validateForm();

		// parse
		$this->parse();

		// display the page
		$this->display();
	}

	/**
	 * Loads the settings form
	 */
	private function loadForm()
	{
		// init settings form
		$this->frm = new BackendForm('settings');

		// add text fields
		$this->frm->addText('apiKey', BackendModel::getModuleSetting($this->URL->getModule(), 'apiKey'));
		$this->frm->addText('apiUrl', BackendModel::getModuleSetting($this->URL->getModule(), 'apiUrl'));
	}

	/**
	 * Parse
	 */
	protected function parse()
	{
		// parent parse functionality
		parent::parse();
	}

	/**
	 * Validates the settings form
	 */
	private function validateForm()
	{
		// form is submitted
		if($this->frm->isSubmitted())
		{
			$txtApiUrl = $this->frm->getField('apiUrl');
			$txtApiUrl->isFilled(BL::err('FieldIsRequired'));

			$txtApiKey = $this->frm->getField('apiKey');
			$txtApiKey->isFilled(BL::err('FieldIsRequired'));

			// form is validated
			if($this->frm->isCorrect())
			{
				// set our settings
				$apiUrl = $txtApiUrl->getValue();

				// ensure there's a trailing slash, so we can easily create the entire link lateron
				if(substr($apiUrl, -1) != '/')
					$apiUrl .= '/';
				BackendModel::setModuleSetting($this->URL->getModule(), 'apiKey', $txtApiKey->getValue());
				BackendModel::setModuleSetting($this->URL->getModule(), 'apiUrl', $apiUrl);
				$this->redirect(BackendModel::createURLForAction('settings') . '&report=saved');
			}
		}
	}

}

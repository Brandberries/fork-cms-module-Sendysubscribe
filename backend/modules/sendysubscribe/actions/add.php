<?php

/**
 * This is the add-action, it will display a form to create a new widget
 *
 * @author Jonathan Spruytte <jonathan@brandberries.be>
 */
class BackendSendysubscribeAdd extends BackendBaseActionAdd
{
	/**
	 * Execute the action
	 */
	public function execute()
	{
		// call parent
		parent::execute();

		// load the form
		$this->loadForm();

		// validate the form
		$this->validateForm();

		// parse the form
		$this->parse();

		// display the page
		$this->display();
	}

	/**
	 * Load the form
	 */
	private function loadForm()
	{
		// create an empty form
		$this->frm = new BackendForm('add');

		// create the input elements
		$this->frm->addText('label');
		$this->frm->addText('listId');

	}

	/**
	 * Validate the form
	 */
	private function validateForm()
	{
		// is the form submitted?
		if($this->frm->isSubmitted())
		{
			// cleanup the submitted fields, ignore fields that were added by hackers
			$this->frm->cleanupFields();
			// shorthand fields
			$txtLabel = $this->frm->getField('label');
			$txtListID = $this->frm->getField('listId');

			// check if both inputvalues are given
			$txtLabel->isFilled(BL::getError('labelMissing', 'sendysubscribe'));
			$txtListID->isFilled(BL::getError('listIDMissing', 'sendysubscribe'));

			// if form is validated
			if($this->frm->isCorrect())
			{
				$label = $txtLabel->getValue();
				$listID = $txtListID->getValue();
				if(BackendSendysubscribeModel::isCorrectListID($listID))
				{
					$widgetId = BackendSendysubscribeModel::insert(array('label' => $label, 'listID' => $listID));
					$this->redirect(BackendModel::createURLForAction('index') . '&report=added&highlight=row-' . $widgetId);
				} else
				{
					$txtListID->addError(BL::err('ListIDWrong', 'sendysubscribe'));

				}

			}
		}
	}

}

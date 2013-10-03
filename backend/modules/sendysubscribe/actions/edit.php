<?php

/**
 * This is the edit-action, it will display a form to edit an existing widget
 *
 * @author Jonathan Spruytte<Jonathan@brandberries.be>
 */
class BackendSendysubscribeEdit extends BackendBaseActionEdit
{
	/**
	 * Execute the action
	 */
	public function execute()
	{
		// get parameters
		$this->id = $this->getParameter('id', 'int');

		// does the item exists
		if($this->id !== null && BackendSendysubscribeModel::exists($this->id))
		{
			// call parent, this will probably add some general CSS/JS or other required files
			parent::execute();

			// get the data
			$this->getData();

			// load the form
			$this->loadForm();

			// validate the form
			$this->validateForm();

			// parse the datagrid
			$this->parse();

			// display the page
			$this->display();
		}

		// no item found, redirect to index, because somebody is fucking with our URL
		else
		{
			$this->redirect(BackendModel::createURLForAction('index') . '&error=non-existing');
		}
	}

	/**
	 * Get the data.
	 */
	private function getData()
	{
		$this->record = BackendSendysubscribeModel::get($this->id);
	}

	/**
	 * Load the form
	 */
	private function loadForm()
	{
		// create form
		$this->frm = new BackendForm('edit');

		// create the input elements
		$this->frm->addText('label', $this->record['label']);
		$this->frm->addText('listId', $this->record['listId']);
	}

	/**
	 * Parse the form
	 */
	protected function parse()
	{
		// call parent
		parent::parse();

		// assign fields
		$this->tpl->assign('item', $this->record);
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
					$id = $this->id;
					BackendSendysubscribeModel::update(array('label' => $label, 'listId' => $listID, 'widget_id' => $id));
					$this->redirect(BackendModel::createURLForAction('index') . '&report=edited&highlight=row-' . $id);
				} else
				{
					$txtListID->addError(BL::err('ListIDWrong', 'sendysubscribe'));
				}
			}
		}
	}

}

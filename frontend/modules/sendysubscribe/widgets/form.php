<?php

/**
 * This is widget which renders the input form, the processing happens via the ajax-action
 *
 * @author Jonathan Spruytte<Jonathan@brandberries.be>
 */
class FrontendSendysubscribeWidgetForm extends FrontendBaseWidget
{
	/**
	 * @var FrontendForm
	 */
	private $frm;

	/**
	 * Execute the extra
	 */
	public function execute()
	{
		parent::execute();
		$this->addCSS('screen.css');
		$this->loadTemplate();
		$this->loadForm();
		$this->parse();

	}

	/**
	 * Load the form
	 */
	private function loadForm()
	{
		$this->frm = new FrontendForm('add');
		$this->frm->addText('name');
		$this->frm->addText('email');
		$this->frm->addHidden('widget_id', $this->data['widget_id']);

	}

	/**
	 * Parse the data into the template
	 */
	private function parse()
	{
		$this->frm->parse($this->tpl);
	}

}

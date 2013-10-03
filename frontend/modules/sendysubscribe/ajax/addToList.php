<?php

/**
 * This is the AddToList-action, which reads the posted parameters and attempts to add the supplied email adress to the
 * specified list
 *
 * @author Jonathan Spruytte<Jonathan@brandberries.be>
 */
class FrontendSendysubscribeAjaxAddToList extends FrontendBaseAJAXAction
{
	public function execute()
	{
		$data = array();
		$datastring = SpoonFilter::getPostValue("data", null, '');
		parse_str($datastring, $data);
		$mail = $data['email'];
		$name = $data['name'];
		$widgetId = (int)$data['widget_id'];

		// validate mail
		if(SpoonFilter::isEmail($mail))
		{
			// Either we manage to add the email to the list, or it's in it already

			if(FrontendSendysubscribeModel::addToList($widgetId, $mail, $name))
			{
				$this->output(self::OK, null, FL::msg('MailSuccess', 'sendysubscribe'));
			}
			else
			{
				$this->output(self::BAD_REQUEST, null, FL::err('MailDuplicate', 'sendysubscribe'));
			}
		}
		else
		{
			$this->output(self::BAD_REQUEST, null, FL::err('MailInvalid', 'sendysubscribe'));
		}
	}

}

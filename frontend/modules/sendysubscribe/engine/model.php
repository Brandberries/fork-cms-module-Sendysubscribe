<?php

/**
 *
 * This is the Frontend Model, which handles all the interaction with the db for the frontend
 * @author Jonathan Spruytte<Jonathan@brandberries.be>
 */

class FrontendSendysubscribeModel
{
	/**
	 * Adds a e-mail and an optional name to the list linked to the widget
	 *
	 * @param int $widgetId The widgetId the call is coming from
	 * @param string $email The email of the subscriber
	 * @param string $name The name of the subscriber
	 */
	public static function addToList($widgetId, $email, $name = "")
	{
		$url = BackendModel::getModuleSetting('sendysubscribe', 'apiUrl') . 'subscribe';
		$list = FrontendModel::getContainer()->get('database')->getVar("SELECT listId from sendysubscribe_widgets where widget_id=?", $widgetId);
		$name = urlencode($name);
		$mail = urlencode($email);
		$list = urlencode($list);
		$fields = 'email=' . $mail . '&name=' . $name . '&list=' . $list . '&boolean=true';

		// open connection, post the fields and close.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		$result = curl_exec($ch);
		curl_close($ch);
		// 4 possible values return, an invalid email is caught earlier, an invalid list will never occor since
		// we check that while setting the widget, which leaves two possible outcomes
		if($result == "Already subscribed")
		{
			return false;
		} elseif($result == "1")
		{
			return true;
		}
	}

}

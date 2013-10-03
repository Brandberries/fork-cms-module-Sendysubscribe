<?php

/**
 *  In this file we store functions are stored to subscribe a person to a list
 * @author Jonathan Spruytte<Jonathan@brandberries.be>
 */
class BackendSendysubscribeModel
{

	const QRY_DATA_GRID_BROWSE = "select widget_id id,label, listId from sendysubscribe_widgets";

	/**
	 * Delete a widget.
	 *
	 * @param int $id  The id of the record to delete.
	 */
	public static function delete($id)
	{
		// recast
		$id = (int)$id;

		// get db connection
		$db = BackendModel::getContainer()->get('database');

		// get widget record
		$item = self::get($id);

		// delete widget
		$db->delete('sendysubscribe_widgets', 'widget_id = ?', $id);

		// delete extra
		$db->delete('modules_extras', 'module = :module AND type = :type AND data=:data', array(':module' => 'sendysubscribe', ':type' => 'widget', ':data' => serialize(array('id' => $id))));

	}

	/**
	 * Does a widget with this id exist.
	 *
	 * @param int $id The id of the widget.
	 * @return bool
	 */
	public static function exists($id)
	{
		return (bool)BackendModel::getContainer()->get('database')->getVar('SELECT COUNT(*)
			 FROM sendysubscribe_widgets
			 WHERE widget_id = ?', array((int)$id));
	}

	/**
	 * Get a widget based on the id.
	 *
	 * @param int $id Id of the widget.
	 * @return array
	 */
	public static function get($id)
	{
		return (array)BackendModel::getContainer()->get('database')->getRecord('SELECT widget_id,extra_id, label,listId FROM sendysubscribe_widgets WHERE widget_id=?', array((int)$id));
	}

	/**
	 * Insert a new subscriber widget.
	 *
	 * @param array $item Widget data.
	 * @return int
	 */
	public static function insert(array $input)
	{

		$db = BackendModel::getContainer()->get('database');
		// create the widget as first, the id is required for the extra

		$extra = array('module' => 'sendysubscribe', 'type' => 'widget', 'label' => $input['label'], 'action' => 'form', 'data' => null);
		// get the sequence id
		$extra['sequence'] = $db->getVar('SELECT MAX(i.sequence) + 1
				 FROM modules_extras AS i
				 WHERE i.module = ?', array('sendysubscribe'));

		if(is_null($extra['sequence']))
			$extra['sequence'] = $db->getVar('SELECT CEILING(MAX(i.sequence) / 1000) * 1000
		 FROM modules_extras AS i');

		// insert and return the new revision id
		$input['extra_id'] = $db->insert('modules_extras', $extra);
		$widgetId = $db->insert('sendysubscribe_widgets', $input);

		// update extra (item id is now known)
		$extra['data'] = serialize(array('widget_id' => $widgetId, 'extra_label' => $input['label'], 'edit_url' => BackendModel::createURLForAction('edit') . '&id=' . $widgetId));
		$db->update('modules_extras', $extra, 'id = ?', array($input['extra_id']));

		return $widgetId;
	}

	public static function isCorrectListID($listID)
	{

		$url = BackendModel::getModuleSetting('sendysubscribe', 'apiUrl') . 'api/subscribers/active-subscriber-count.php';
		$apiKey = BackendModel::getModuleSetting('sendysubscribe', 'apiKey');
		$fields = 'api_key=' . $apiKey . '&list_id=' . $listID;
		// open connection, execute the curl, close and return.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		$result = curl_exec($ch);
		curl_close($ch);
		return is_numeric($result);
	}

	/**
	 * Update a twitter widget.
	 *
	 * @param array $item The data to update.
	 * @return int
	 */
	public static function update(array $item)
	{
		// get db
		$db = BackendModel::getContainer()->get('database');
		$extraId = $db->getVar('SELECT extra_id FROM sendysubscribe_widgets WHERE widget_id=?', $item['widget_id']);
		// The only item that could have been changed is the label, however we need to rebuild the entire data-piece
		$extra = array('label' => $item['label'], 'data' => serialize(array('extra_label' => $item['label'], 'id' => $item['id'])));

		$db->update('modules_extras', $extra, 'id=?', $extraId);

		// update widget
		$db->update('sendysubscribe_widgets', $item, 'widget_id = ?', array($item['widget_id']));

		return $item['id'];
	}

}

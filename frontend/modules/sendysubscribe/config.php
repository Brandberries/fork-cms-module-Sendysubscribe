<?php

/**
 * This is the configuration-object.
 *
 * @author Jonathan Spruytte<Jonathan@brandberries.be>
 */
final class FrontendSendysubscribeConfig extends FrontendBaseConfig
{
	/**
	 * The default action
	 *
	 * @var	string
	 */
	protected $defaultAction = 'addToList';

	/**
	 * The disabled actions
	 *
	 * @var	array
	 */
	protected $disabledActions = array();
}

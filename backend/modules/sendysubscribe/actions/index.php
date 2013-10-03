<?php

/**
 * This is the index-action (default), it will display the overview of widgets
 *
 * @author Jonathan Spruytte<Jonathan@brandberries.be>
 */
class BackendSendysubscribeIndex extends BackendBaseActionIndex
{
	/**
	 * Execute the action.
	 */
	public function execute()
	{
		// call parent, this will probably add some general CSS/JS or other required files
		parent::execute();

		// load data grid
		$this->loadDataGrid();

		// parse page
		$this->parse();

		// display the page
		$this->display();
	}

	/**
	 * Loads the data grid with all the widgets.
	 */
	private function loadDataGrid()
	{
		// create datagrid
		$this->datagrid = new BackendDataGridDB(BackendSendysubscribeModel::QRY_DATA_GRID_BROWSE);

		// sorting columns
		$this->datagrid->setSortingColumns(array('label', 'listId'), 'label');

		// set colum URLs
		$this->datagrid->setColumnURL('label', BackendModel::createURLForAction('edit') . '&amp;id=[id]');
		$this->datagrid->addColumn('delete', null, 'delete', BackendModel::createURLForAction('delete') . '&amp;id=[id]');

		// add edit column
		$this->datagrid->addColumn('edit', null, BL::getLabel('Edit'), BackendModel::createURLForAction('edit') . '&amp;id=[id]', BL::getLabel('Edit'));
	}

	/**
	 * Parse all datagrids
	 */
	protected function parse()
	{
		// parse the datagrid for all blogposts
		$this->tpl->assign('datagrid', ($this->datagrid->getNumResults() != 0) ? $this->datagrid->getContent() : false);
	}

}

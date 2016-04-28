<?php


namespace IoTable;


/**
 * @author Adam Bisek (adam.bisek@gmail.com)
 */
class RowsIterator extends \ArrayIterator
{

	public function append($rowData)
	{
		parent::append(new CellsIterator($rowData));
	}

}
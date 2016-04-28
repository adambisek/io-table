<?php


namespace IoTable;


/**
 * @author Adam Bisek <adam.bisek@gmail.com>
 */
interface IParser
{

	public function parse($string);

	public function toString($rows);

}
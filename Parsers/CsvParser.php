<?php


namespace IoTable\Parsers;


use IoTable\IParser;


/**
 * @author Adam Bisek (adam.bisek@gmail.com)
 */
class CsvParser implements IParser
{

	const ROW_SEPARATOR = "\n",
		COMMA_SEPARATOR = ';',
		SEMICOLON_SEPARATOR = ';';
	
	/** @var string cells separator */
	private $separator = self::SEMICOLON_SEPARATOR;


	public function setSeparator($separator)
	{
		$this->separator = $separator;
	}


	/**
	 * Parse CSV table from string
	 * Expects UTF-8
	 * @param $string
	 * @return array
	 */
	public function parse($string)
	{
		$string = trim($string);
		if(strpos($string, $this->separator) === FALSE){
			throw new \InvalidArgumentException("Bad format.");
		}
		$rows = explode(self::ROW_SEPARATOR, $string);
		return array_map(array($this, 'parseRow'), $rows);
	}


	public function toString($rows)
	{
		if($rows instanceof \Traversable){
			$rows = iterator_to_array($rows);
		}
		return implode(self::ROW_SEPARATOR, array_map(array($this, 'toStringRow'), $rows));
	}


	private function parseRow($row)
	{
		$cells = explode($this->separator, $row);
		return array_map(array($this, 'parseCell'), $cells);
	}


	private function parseCell($cell)
	{
		return trim($cell, '"'); // trim whitespaces and quotes
	}


	private function toStringRow($cells)
	{
		if($cells instanceof \Traversable){
			$cells = iterator_to_array($cells);
		}
		return implode($this->separator, $cells);
	}

}
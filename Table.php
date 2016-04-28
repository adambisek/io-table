<?php


namespace IoTable;


/**
 * @author Adam Bisek (adam.bisek@gmail.com)
 */
class Table
{

	/**
	 * @var RowsIterator
	 */
	private $rows;

	/**
	 * @var IParser
	 */
	private $parser;


	public function __construct()
	{
		$this->rows = new RowsIterator();
	}


	public function setParser(IParser $parser)
	{
		$this->parser = $parser;
	}


	public function getParser($need = FALSE)
	{
		if($need === TRUE && $this->parser === NULL){
			throw new \InvalidArgumentException("Parser not setted.");
		}
		return $this->parser;
	}


	public function loadFromFile($file)
	{
		if(!is_file($file)){
			throw new \InvalidArgumentException("Given file $file not found.");
		}
		$contents = @file_get_contents($file);
		if(!$contents){
			throw new \InvalidArgumentException("Cannot read file $file.");
		}
		$this->loadFromString($contents);
	}


	public function loadFromString($string)
	{
		if($this->rows->count() > 0) {
			throw new \RuntimeException("Data was already loaded.");
		}
		foreach($this->getParser(TRUE)->parse($string) as $row){
			$this->addRow($row);
		}
	}


	public function load($rows)
	{
		if($this->rows->count() > 0) {
			throw new \RuntimeException("Data was already loaded.");
		}
		if(!is_array($rows) && !($rows instanceof \Traversable)){
			throw new \InvalidArgumentException("Data must be an array or Traversable.");
		}
		foreach($rows as $row){
			$this->addRow($row);
		}
	}


	/**
	 * @param array|\Traversable $row
	 */
	public function addRow($row)
	{
		if($row instanceof \Traversable){
			$row = iterator_to_array($row);
		}elseif(!is_array($row)){
			throw new \InvalidArgumentException("Row values must be an array or Traversable");
		}
		$this->rows->append($row);
		return $this;
	}


	/**
	 * Returns rows iterator
	 * @return RowsIterator
	 */
	public function getRows()
	{
		return $this->rows;
	}


	/**
	 * Returns string output for saving
	 * @return string
	 */
	public function toString()
	{
		return $this->getParser(TRUE)->toString($this->rows);
	}

}
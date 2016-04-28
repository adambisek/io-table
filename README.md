io-table
===================================
[![Latest Stable Version](https://poser.pugx.org/adambisek/io-table/v/stable)](https://packagist.org/packages/adambisek/io-table)
[![License](https://poser.pugx.org/adambisek/io-table/license.png)](https://github.com/adambisek/io-table/blob/master/LICENSE)

Save Array to CSV file or parse CSV file into Array

Installation
------------
Preferred installation is with [Composer](https://doc.nette.org/composer).

<code>
composer require adambisek/io-table
</code>

Usage
------------
```
$parser = new \IoTable\Parsers\CsvParser();
$table = new \IoTable\Table();
$table->setParser($parser);
$table->loadFromString("sloupec;druhy sloupec\nsl v novem radku;a dalsi");
$rows = $table->getRows();
var_dump($rows);
$csv = $table->toString();
var_dump($csv);
```

```
$parser = new \IoTable\Parsers\CsvParser();
$table = new \IoTable\Table();
$table->setParser($parser);
$table->load([["sloupec", "druhy sloupec"], ["sl v novem radku", "a dalsi"]]);
$string = $table->toString();
var_dump($string);
```

Parser test (for maintainer only)
------------
```
$p = new \IoTable\Parsers\CsvParser();
$r = $p->parse("sloupec;druhy sloupec\nsl v novem radku;a dalsi");
var_dump($r);
$r = $p->toString([["sloupec", "druhy sloupec"], ["sl v novem radku", "a dalsi"]]);
var_dump($r);
```
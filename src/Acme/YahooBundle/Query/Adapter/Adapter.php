<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 19.09.15
 * Time: 12:03
 */

namespace Acme\YahooBundle\Query\Adapter;


class Adapter implements AdapterInterface
{

    /**
     * @var string
     */
    protected $_apiUrl;

    /**
     * @var array
     */
    protected $_result = array();

    public function __construct($apiUrl = 'http://ichart.finance.yahoo.com/table.csv') {
        $this->_apiUrl = $apiUrl;
    }

    /**
     * @return array
     */
    public function getResult()
    {
        return $this->_result;
    }

    public function query($a, $b, $c, $d, $e, $f, $s)
    {

        $stream = $this->_apiUrl . "?a=$a&b=$b&c=$c&d=$d&e=$e&f=$f&s=$s&g=d";

        $columnNames = array();

        $resource = @fopen($stream, 'r');

        if($resource) {

            $rowId = 0;
            while($row = fgetcsv($resource)) {
                // Set column names from first row
                if(++$rowId == 1) {
                    $columnNames = $row;
                    continue;
                }
                array_push($this->_result, array_combine($columnNames, $row));
            }
            fclose($resource);

        }

        return false;

    }

}
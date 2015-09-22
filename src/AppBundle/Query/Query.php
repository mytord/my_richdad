<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 22.09.15
 * Time: 10:43
 */

namespace AppBundle\Query;

use AppBundle\Query\Adapter\AdapterInterface;

class Query {

    /**
     * @var \AppBundle\Query\Adapter\AdapterInterface
     */
    protected $_adapter;

    /**
     * @var array
     */
    protected $_result;

    /**
     * @var string
     */
    protected $_symbol;

    /**
     * @var int
     */
    protected $_startDay;

    /**
     * @var int
     */
    protected $_startMonth;

    /**
     * @var int
     */
    protected $_startYear;

    /**
     * @var int
     */
    protected $_endDay;

    /**
     * @var int
     */
    protected $_endMonth;

    /**
     * @var int
     */
    protected $_endYear;


    public function __construct(AdapterInterface $adapter, $symbol, $startDay, $startMonth, $startYear, $endDay, $endMonth, $endYear) {
        $this->_adapter = $adapter;
        $this->_symbol = $symbol;
        $this->_startDay = (int)$startDay;
        $this->_startMonth = (int)$startMonth;
        $this->_startYear = (int)$startYear;
        $this->_endDay = (int)$endDay;
        $this->_endMonth = (int)$endMonth;
        $this->_endYear = (int)$endYear;
    }

    /**
     * @return void
     */
    public function execute() {
        // Execute query
        $this->_adapter->query($this->_startMonth-1, $this->_startDay, $this->_startYear, $this->_endMonth-1, $this->_endDay, $this->_endYear, $this->_symbol);
    }

    /**
     * @return array
     */
    public function getResult()
    {
        return $this->_adapter->getResult();
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return $this->_symbol;
    }

    /**
     * @return int
     */
    public function getStartDay()
    {
        return $this->_startDay;
    }

    /**
     * @return int
     */
    public function getStartMonth()
    {
        return $this->_startMonth;
    }

    /**
     * @return int
     */
    public function getStartYear()
    {
        return $this->_startYear;
    }

    /**
     * @return int
     */
    public function getEndDay()
    {
        return $this->_endDay;
    }

    /**
     * @return int
     */
    public function getEndMonth()
    {
        return $this->_endMonth;
    }

    /**
     * @return int
     */
    public function getEndYear()
    {
        return $this->_endYear;
    }

}
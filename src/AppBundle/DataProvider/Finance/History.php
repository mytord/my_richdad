<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 19.09.15
 * Time: 10:45
 */

namespace AppBundle\DataProvider\Finance;

use AppBundle\Query\Builder\BuilderInterface;

class History {

    /**
     * @var array
     */
    protected $_data = array();

    /**
     * @var \AppBundle\Query\Builder\BuilderInterface
     */
    protected $_queryBuilder;

    public function __construct(BuilderInterface $qb) {
        $this->_queryBuilder = $qb;
    }

    /**
     * @param $symbols
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return $this
     */
    public function provide($symbols, \DateTime $startDate, \DateTime $endDate) {

        // Prepare symbols
        if(!is_array($symbols)) {
            $symbols = array($symbols);
        }

        // Clear data
        $this->_data = array();

        // Smart queries: one symbol per query
        foreach ($symbols as $symbol) {
            // Make query
            $query = $this->_queryBuilder->buildQuery($symbol, $startDate, $endDate);
            $query->execute();

            // Compile results
            foreach ($query->getResult() as $row) {
                $row['Symbol'] = $symbol;
                array_push($this->_data, $row);
            }

        }

        return $this;

    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

}
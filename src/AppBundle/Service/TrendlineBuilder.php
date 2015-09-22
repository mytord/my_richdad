<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 21.09.15
 * Time: 15:52
 */

namespace AppBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\DataProvider\Finance\History as DataProvider;

class TrendlineBuilder {

    /**
     * @var DataProvider
     */
    protected $_dataProvider;

    /**
     * @var \AppBundle\Entity\PortfolioItem[]
     */
    protected $_portfolio;

    /**
     * @var array
     */
    protected $_points = array();

    /**
     * @param ArrayCollection $portfolio
     * @param DataProvider $dp
     */
    public function __construct(DataProvider $dp, ArrayCollection $portfolio = null) {
        $this->_dataProvider = $dp;
        $this->_portfolio = $portfolio;
    }

    /**
     * Calculator
     *
     * @param $start
     * @param $end
     * @return $this
     */
    public function build(\DateTime $start, \DateTime $end) {

        // Empty result
        $this->_result = array();

        $history = $this->getHistoryData(clone $start, clone $end);

        while($start < $end) {

            $sum = 0;

            foreach ($this->_portfolio as $portfolioItem) {
                $symbol = $portfolioItem->getSymbol()->getSlug();
                $date = $start->format('Y-m-d');
                if(isset($history[$date][$symbol])) {
                    // Calculation sum per day
                    $sum += $history[$date][$symbol] * $portfolioItem->getQuantity();
                }
            }

            array_push($this->_points, array($start->format('Y-m-d'), $sum));

            $start->modify('+1 day');
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getPoints()
    {
        return $this->_points;
    }

    /**
     * Makes processed history dataset
     *
     * @param $start
     * @param $end
     * @return array
     */
    protected function getHistoryData($start, $end) {

        $symbols = array_keys($this->getPortfolioHashtable());

        $items = $this->_dataProvider->provide($symbols, $start, $end)->getData();

        $result = array();
        foreach ($items as $id => $item) {
            $result[$item['Date']][$item['Symbol']] = $item['Close'];
            unset($items[$id]);
        }

        return $result;
    }

    /**
     * @return \AppBundle\Entity\PortfolioItem[]
     */
    public function getPortfolio()
    {
        return $this->_portfolio;
    }

    /**
     * @param \AppBundle\Entity\PortfolioItem[] $portfolio
     */
    public function setPortfolio($portfolio)
    {
        $this->_portfolio = $portfolio;
    }

    /**
     * @return array
     */
    protected function getPortfolioHashtable() {
        $table = array();
        foreach ($this->_portfolio as $portfolioItem) {
            $table[$portfolioItem->getSymbol()->getSlug()] = $portfolioItem->getQuantity();
        }
        return $table;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 21.09.15
 * Time: 15:57
 */
namespace AppBundle\Tests\Service;

use AppBundle\Entity\PortfolioItem;
use AppBundle\Entity\Symbol;
use AppBundle\Service\TrendlineBuilder;
use Doctrine\Common\Collections\ArrayCollection;

class TrendlineBuilderTest extends \PHPUnit_Framework_TestCase {

    const DEFAULT_PRICE = 100;
    const DEFAULT_QTY = 10;

    protected $_expected = array();

    public function testBuild() {

        $start = new \DateTime('2015-06-10');
        $end = new \DateTime('2015-06-15');

        $portfolio = $this->getPortfolio();

        $apiResponse = $this->generateApiResponse($portfolio, $start, $end);

        $qty = count($portfolio) * self::DEFAULT_QTY * self::DEFAULT_PRICE;

        $expectedResult = array(
            array('2015-06-10', $qty),
            array('2015-06-11', $qty),
            array('2015-06-12', $qty),
            array('2015-06-13', $qty),
            array('2015-06-14', $qty),
        );

        $dataProvider = $this->getMockBuilder('AppBundle\DataProvider\Finance\History')
            ->disableOriginalConstructor()
            ->getMock();

        $dataProvider->expects($this->once())
            ->method('provide')
            ->with()
            ->will($this->returnSelf());

        $dataProvider->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($apiResponse));


        $builder = new TrendlineBuilder($dataProvider, $portfolio);

        $builder->build($start, $end);

        // Assert
        // Check result
        $this->assertEquals($expectedResult, $builder->getPoints());

    }

    /**
     * NOTE: We're ignoring missing date in api response
     *
     * @param \AppBundle\Entity\PortfolioItem[] $portfolio
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    protected function generateApiResponse($portfolio, \DateTime $start, \DateTime $end) {
        $historyData = array();

        foreach ($portfolio as $item) {

            $symbol = $item->getSymbol()->getSlug();

            $startDate = clone $start;
            $endDate = clone $end;

            // fill history data
            while($startDate < $endDate) {
                $historyData[] = $this->createHistoryItem($startDate->format('Y-m-d'), $symbol, self::DEFAULT_PRICE);
                $startDate->modify('+1 day');
            }
        }

        return $historyData;
    }

    /**
     * Create stub item
     * @param $date
     * @param $symbol
     * @param $price
     * @return \stdClass
     */
    protected function createHistoryItem($date, $symbol, $price) {
        $item = array();
        $item['Symbol'] = $symbol;
        $item['Close'] = $price;
        $item['Date'] = $date;
        return $item;
    }

    /**
     * @return ArrayCollection
     */
    protected function getPortfolio() {
        $portfolio = new ArrayCollection();

        $portfolio->add($this->createPortfolioItem(
            $this->createSymbol('SYM1', 'Symbol 1'),
            self::DEFAULT_QTY
        ));

        $portfolio->add($this->createPortfolioItem(
            $this->createSymbol('SYM2', 'Symbol 2'),
            self::DEFAULT_QTY
        ));

        return $portfolio;
    }

    /**
     * @param $slug
     * @param $name
     * @return \AppBundle\Entity\Symbol
     */
    protected function createSymbol($slug, $name) {
        $symbol = new Symbol();
        $symbol->setSlug($slug);
        $symbol->setName($name);
        return $symbol;
    }

    /**
     * @param \AppBundle\Entity\Symbol $symbol
     * @param $qty
     * @return array
     */
    protected function createPortfolioItem(Symbol $symbol, $qty) {
        $item = new PortfolioItem();
        $item->setQuantity($qty);
        $item->setSymbol($symbol);
        return $item;
    }
}

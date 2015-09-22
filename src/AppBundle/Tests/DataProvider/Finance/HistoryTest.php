<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 22.09.15
 * Time: 11:47
 */

namespace AppBundle\Tests\DataProvider\Finance;

use AppBundle\DataProvider\Finance\History;

class HistoryTest extends \PHPUnit_Framework_TestCase {

    public function testProvide() {

        $symbols = array('SYM1', 'SYM2', 'SYM3');
        $dataset = array(
            array('a' => 1, 'b' => 2),
            array('a' => 5, 'b' => 6),
        );
        $countCycles = count($symbols);

        $start = $this->getMock('DateTime');
        $end = $this->getMock('DateTime');

        $query = $this->getMockBuilder('AppBundle\Query\Query')
            ->disableOriginalConstructor()
            ->getMock();

        $query->expects($this->exactly($countCycles))
            ->method('getResult')
            ->will($this->returnValue($dataset));

        $queryBuilder = $this->getMock('AppBundle\Query\Builder\BuilderInterface');
        $queryBuilder->expects($this->exactly($countCycles))
            ->method('buildQuery')
            ->will($this->returnValue($query));

        $dataProvider = new History($queryBuilder);
        $dataProvider->provide($symbols, $start, $end);

        $expectedCount = count($dataset) * $countCycles;
        $this->assertEquals($expectedCount, count($dataProvider->getData()));
    }

}

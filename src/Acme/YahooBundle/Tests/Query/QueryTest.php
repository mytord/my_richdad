<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 22.09.15
 * Time: 11:17
 */

namespace Acme\YahooBundle\Tests\Query;


use Acme\YahooBundle\Query\Query;

class QueryTest extends \PHPUnit_Framework_TestCase {

    const START_D = 1;
    const START_M = 1;
    const START_Y = 2001;
    const END_D = 1;
    const END_M = 6;
    const END_Y = 2005;
    const SYM = 'SYM';

    public function testExecuteInteraction() {

        $adapter = $this->getMock('Acme\YahooBundle\Query\Adapter\AdapterInterface');

        $adapter->expects($this->once())
            ->method('query')
            ->with(static::START_M-1, static::START_M, static::START_Y, static::END_M-1, static::END_D, static::END_Y, static::SYM);

        $query = $this->createQuery($adapter);
        $query->execute();

    }

    public function testGetResult() {

        $expectedResult = array('a' => 1, 'b' => 2);

        $adapter = $this->getMock('Acme\YahooBundle\Query\Adapter\AdapterInterface');

        $adapter->expects($this->once())
            ->method('getResult')
            ->will($this->returnValue($expectedResult));

        $query = $this->createQuery($adapter);
        $this->assertEquals($expectedResult, $query->getResult());

    }

    protected function createQuery($adapter) {
        return new Query($adapter, static::SYM, static::START_D, static::START_M, static::START_Y, static::END_D, static::END_M, static::END_Y);
    }
}

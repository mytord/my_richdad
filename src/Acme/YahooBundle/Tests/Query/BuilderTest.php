<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 22.09.15
 * Time: 11:27
 */

namespace Acme\YahooBundle\Tests\Query;


use Acme\YahooBundle\Query\Builder\Builder;

class BuilderTest extends \PHPUnit_Framework_TestCase {

    public function testBuildQuery() {
        $adapter = $this->getMock('Acme\YahooBundle\Query\Adapter\AdapterInterface');

        $start = $this->getMock('DateTime');
        $start->expects($this->exactly(3))
            ->method('format');

        $end = $this->getMock('DateTime');
        $end->expects($this->exactly(3))
            ->method('format');

        $builder = new Builder($adapter);
        $query = $builder->buildQuery('SYM', $start, $end);

        $this->assertInstanceOf('Acme\YahooBundle\Query\Query', $query);

    }
}

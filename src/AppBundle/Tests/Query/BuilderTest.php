<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 22.09.15
 * Time: 11:27
 */

namespace AppBundle\Tests\Query;


use AppBundle\Query\Builder\Builder;

class BuilderTest extends \PHPUnit_Framework_TestCase {

    public function testBuildQuery() {
        $adapter = $this->getMock('AppBundle\Query\Adapter\AdapterInterface');

        $start = $this->getMock('DateTime');
        $start->expects($this->exactly(3))
            ->method('format');

        $end = $this->getMock('DateTime');
        $end->expects($this->exactly(3))
            ->method('format');

        $builder = new Builder($adapter);
        $query = $builder->buildQuery('SYM', $start, $end);

        $this->assertInstanceOf('AppBundle\Query\Query', $query);

    }
}

<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 22.09.15
 * Time: 10:00
 */

namespace Acme\YahooBundle\Tests\Query;


use Acme\YahooBundle\Query\Adapter\Adapter;
use org\bovigo\vfs\vfsStream;

class AdapterTest extends \PHPUnit_Framework_TestCase {

    public function testQueryShouldReturnValidStructure() {

        $columnNames = 'A,B,C,D';
        $a = $b = $c = $d = $e = $f = $g = $s = 0;

        // Simple CSV structure with 2 rows
        vfsStream::setup('root', null, array(
            "file.csv?a=$a&b=$b&c=$c&d=$d&e=$e&f=$f&s=$s&g=d" => $columnNames . PHP_EOL . '1,2,3,4'
        ));

        $adapter = new Adapter(vfsStream::url('root/file.csv'));

        $adapter->query($a, $b, $c, $d, $e, $f, $g, $s);
        $result = $adapter->getResult();

        // Assert that we have only one row
        $this->assertEquals(1, count($result));
        // Assert row keys structure
        $this->assertEquals(explode(',', $columnNames), array_keys(array_pop($result)));


    }

    public function testQueryShouldReturnFalseIfStructureNotExists() {
        $a = $b = $c = $d = $e = $f = $g = $s = 0;

        // Empty structure
        vfsStream::setup('root', null, array(
            "file.csv?a=$a&b=$b&c=$c&d=$d&e=$e&f=$f&s=$s&g=d" => ''
        ));

        $adapter = new Adapter(vfsStream::url('root/file.csv'));

        $this->assertFalse($adapter->query($a, $b, $c, $d, $e, $f, $g, $s));

    }

}

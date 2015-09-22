<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 22.09.15
 * Time: 11:50
 */
namespace AppBundle\Query\Adapter;

interface AdapterInterface
{
    /**
     * @return array
     */
    public function getResult();

    public function query($a, $b, $c, $d, $e, $f, $s);
}
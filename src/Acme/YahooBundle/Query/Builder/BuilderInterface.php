<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 22.09.15
 * Time: 11:41
 */
namespace Acme\YahooBundle\Query\Builder;

use Acme\YahooBundle\Query\Query;

interface BuilderInterface
{
    /**
     * @param $symbol
     * @param \DateTime $dateStart
     * @param \DateTime $dateEnd
     * @return Query
     */
    public function buildQuery($symbol, \DateTime $dateStart, \DateTime $dateEnd);
}
<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 22.09.15
 * Time: 11:41
 */
namespace AppBundle\Query\Builder;

use AppBundle\Query\Query;

interface BuilderInterface
{
    /**
     * @param $symbol
     * @param \DateTime $dateStart
     * @param \DateTime $dateEnd
     * @return \AppBundle\Query\Query
     */
    public function buildQuery($symbol, \DateTime $dateStart, \DateTime $dateEnd);
}
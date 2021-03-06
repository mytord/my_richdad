<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 19.09.15
 * Time: 11:58
 */

namespace AppBundle\Query\Builder;

use AppBundle\Query\Builder\BuilderInterface;
use AppBundle\Query\Adapter\AdapterInterface;
use AppBundle\Query\Query;

class Builder implements BuilderInterface
{

    /**
     * @var \AppBundle\Query\Adapter\AdapterInterface
     */
    protected $_adapter;

    public function __construct(AdapterInterface $adapter) {
        $this->_adapter = $adapter;
    }

    /**
     * @param $symbol
     * @param \DateTime $dateStart
     * @param \DateTime $dateEnd
     * @return Query
     */
    public function buildQuery($symbol, \DateTime $dateStart, \DateTime $dateEnd)
    {
        return new Query(
            $this->_adapter,
            $symbol,
            $dateStart->format('d'),
            $dateStart->format('m'),
            $dateStart->format('Y'),
            $dateEnd->format('d'),
            $dateEnd->format('m'),
            $dateEnd->format('Y')
        );
    }

}
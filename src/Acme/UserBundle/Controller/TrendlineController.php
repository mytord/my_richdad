<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Portfolio controller.
 *
 * @Route("/portfolio/trendline")
 */
class TrendlineController extends Controller
{

    /**
     * User portfolio over history
     *
     * @Route("/", name="trendline", defaults={"_format": "json"})
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        /** @var \Acme\UserBundle\Service\TrendlineBuilder $calculator */
        $builder = $this->container->get('acme.user.service.trendline_builder');
        // Add items in portfolio
        $builder->setPortfolio($this->getUser()->getPortfolioItems());
        $builder->build(new \DateTime('-2 year'), new \DateTime('now'));

        return new JsonResponse($builder->getPoints());
    }

}

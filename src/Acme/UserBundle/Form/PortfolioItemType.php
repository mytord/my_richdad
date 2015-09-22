<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 20.09.15
 * Time: 20:48
 */

namespace Acme\UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PortfolioItemType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('symbol')
                ->add('quantity');
    }

    public function getName()
    {
        return 'portfolio_item_type';
    }


    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Acme\UserBundle\Entity\PortfolioItem',
        );
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 21.09.15
 * Time: 10:24
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Symbol;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSymbols implements FixtureInterface {
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createSymbol('AAPL', 'Apple Inc.'));
        $manager->persist($this->createSymbol('YHOO', 'Yahoo Inc.'));
        $manager->persist($this->createSymbol('GOOG', 'Google Inc.'));
        $manager->persist($this->createSymbol('CAT', 'Caterpillar Inc.'));
        $manager->persist($this->createSymbol('MSFT', 'Microsoft Corporation.'));
        $manager->persist($this->createSymbol('BA', 'Boeing company'));
        $manager->persist($this->createSymbol('KO', 'Coca-cola company'));
        $manager->persist($this->createSymbol('TSLA', 'Tesla motors.'));
        $manager->persist($this->createSymbol('GM', 'General motors.'));
        $manager->persist($this->createSymbol('GE', 'General electric.'));

        $manager->flush();
    }

    protected function createSymbol($slug, $name) {
        $symbol = new Symbol();
        $symbol->setSlug($slug);
        $symbol->setName($name);
        return $symbol;
    }


}
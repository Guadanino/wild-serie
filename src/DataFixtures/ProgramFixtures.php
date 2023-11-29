<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $program = new Program();
        $program->setTitle('Walking dead', 'Narnia et l\'armoir magique', 'Indiana Jones', 'Aladdin', 'L\exorciste');
        $program->setSynopsis('Des zombies envahissent la terre', 'magie', 'Le temple maudit', 'Le roi des voleurs', 'Bouhhhhh');
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
        $manager->flush(); 
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }


}
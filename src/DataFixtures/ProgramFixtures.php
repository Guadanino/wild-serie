<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i=0; $i < 5; $i++) {
                $program = new Program();
                $program->setTitle($faker->words(6, true));
                $program->setSynopsis($faker->paragraphs(3, true));
                $program->setCountry($faker->city());
                $program->setYear($faker->year());
    
                $program->setCategory($this->getReference('category_' . $i));
    
                $manager->persist($program);
    
                $this->addReference('program_' . $i, $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}

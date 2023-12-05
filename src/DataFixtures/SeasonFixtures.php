<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        /**
         * L'objet $faker que tu récupère est l'outil qui va te permettre 
         * de te générer toutes les données que tu souhaites
         */

        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $season = new Season();
                $season->setNumber($j + 1);
                $season->setYear($faker->year());
                $season->setDescription($faker->paragraphs(3, true));

                $season->setProgram($this->getReference('program_' . $i));

                $manager->persist($season);

                $this->addReference('program_' . $i . '_season_' . $j, $season);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}

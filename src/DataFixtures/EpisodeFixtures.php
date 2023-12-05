<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                for ($k = 0; $k < 10; $k++) {
                    $episodes = new Episode();
                    $episodes->setTitle($faker->words(6, true));
                    $episodes->setNumber($k + 1);
                    $episodes->setSynopsis($faker->paragraphs(3, true));

                    $episodes->setSeason($this->getReference('program_' . $i . '_season_' . $j));

                    $manager->persist($episodes);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}

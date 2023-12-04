<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        ['Number' => '1', 'Year' => '2009', 'Description' => 'série avocat', 'Program' => 'program_Murder'],
        ['Number' => '2', 'Year' => '2009', 'Description' => 'série avocat', 'Program' => 'program_Murder'],
        ['Number' => '3', 'Year' => '2009', 'Description' => 'série avocat', 'Program' => 'program_Murder'],
        ['Number' => '4', 'Year' => '2009', 'Description' => 'série avocat', 'Program' => 'program_Murder'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $seasonData) {
            $season = new Season();
            $season->setNumber($seasonData['Number']);
            $season->setYear($seasonData['Year']);
            $season->setDescription($seasonData['Description']);
            $season->setDescription($seasonData['Description']);
            $season->setProgram($this->getReference($seasonData['Program']));
            $manager->persist($season);

            $this->addReference('season' . $seasonData['Number'] . '_' . $season->getProgram()->getTitle(), $season);
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

<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
            ['title' => 'Pilot', 'number' => '1', 'synopsis' => 'Diagnosed with terminal lung cancer, chemistry teacher Walter White teams up with former student Jesse Pinkman to cook and sell crystal meth.', 'season' => 'season1_Murder'],
            ['title' => 'Cat\'s in the Bag...', 'number' => '2', 'synopsis' => 'After their first drug deal goes terribly wrong, Walt and Jesse are forced to deal with a corpse and a prisoner. Meanwhile, Skyler grows suspicious of Walt\'s activities.', 'season' => 'season1_Murder'],
            ['title' => 'And the Bag\'s in the River', 'number' => '3', 'synopsis' => 'Walt and Jesse clean up after the bathtub incident before Walt decides what course of action to take with their prisoner Krazy-8.', 'season' => 'season1_Murder'],
            ['title' => 'Cancer Man', 'number' => '4', 'synopsis' => 'Walt tells the rest of his family about his cancer. Jesse tries to make amends with his own parents.', 'season' => 'season1_Murder'],
            ['title' => 'Seven Thirty-Seven', 'number' => '1', 'synopsis' => 'Walt and Jesse realize how dire their situation is. They must come up with a plan to kill Tuco before Tuco kills them first.', 'season' => 'season1_Murder'],
        ];
    public function load(ObjectManager $manager): void
    {
        
        foreach (self::EPISODES as $episodesData) {
            $episodes = new Episode();
            $episodes->setTitle($episodesData['title']);
            $episodes->setNumber($episodesData['number']);
            $episodes->setSynopsis($episodesData['synopsis']);
            $episodes->setSeason($this->getReference($episodesData['season']));
            $manager->persist($episodes);
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

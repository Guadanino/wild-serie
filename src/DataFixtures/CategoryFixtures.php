<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($faker->words(6, true));
            $manager->persist($category);

            $this->addReference('category_' . $i, $category);
        }
        $manager->flush();
    }
}

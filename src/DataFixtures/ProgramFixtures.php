<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAM = [
        ['title' => 'Walking dead', 'synopsis' => 'Des zombies envahissent la terre', 'category' => 'category_Action'],
        ['title' => 'Narnia et l\'armoir magique', 'synopsis' => 'magie', 'category' => 'category_Fantastique'],
        ['title' => 'Indiana Jones', 'synopsis' => 'Le temple maudit', 'category' => 'category_Aventure'],
        ['title' => 'Aladdin', 'synopsis' => 'Le roi des voleurs', 'category' => 'category_Animation'],
        ['title' => 'L\exorciste', 'synopsis' => 'Bouhhhhh', 'category' => 'category_Horreur'],
        ['title' => 'Sweet Home', 'synopsis' => 'Hyun, a loner high school student who lost his entire family in a terrible accident, is forced to leave his home and has to face a new reality where monsters are trying to wipe out all of humanity. Now he must fight against all odds to try and race against the clock to save what is left of the human race before it\'s too late.', 'category' => 'category_Horreur'],
        ['title' => 'Doctor Who', 'synopsis' => 'The longest running sci-fi series is returning for its latest holiday special this Christmas, and we’re looking forward to seeing actor Ncuti Gatwa wield the sonic screwdriver as the fifteenth regeneration of the infamous Timelord. But this holiday adventure, titled "The Church on Ruby Road," isn’t just a continuation of the franchise. Showrunner Russell T. Davies has said that the upcoming season will be considered a "re-branded Season 1." Details on the holiday special and the succeeding series are under wraps, but with Davies back at the wheel, and the talented Gatwa inside the TARDIS, we can’t wait to see what kind of wibbly wobbly timey wimey adventures the Doctor and his companions get up to.', 'category' => 'category_Aventure'],
        ['title' => 'Le garçon et le héron', 'synopsis' => 'Written and directed by Hayao Miyazaki and produced by Studio Ghibli, \'The Boy and the Heron\' is the first feature from the legendary animator in 10 years. The semi-autobiographical film follows a young boy named Mahito (voiced by Christian Bale) on his journey to a world shared by the living and the dead. Originally titled \'How Do You Live?\' for its Japanese release, the highly anticipated movie boasts an all-star voice cast featuring Dave Bautista, Gemma Chan, Willem Dafoe, Mark Hamill, Robert Pattinson, and Florence Pugh, among others.', 'category' => 'category_Animation'],
        ['title' => 'Yu yu hakusho', 'synopsis' => 'A delinquent teenager is killed and gets resurrected to serve as an investigator of the supernatural.', 'category' => 'category_Aventure'],
        ['title' => 'Chicken Run : La Menace nuggets', 'synopsis' => 'Having pulled off an escape from Tweedy\'s farm, Ginger has found a peaceful island sanctuary for the whole flock. But back on the mainland the whole of chicken-kind faces a new threat, and Ginger and her team decide to break in.', 'category' => 'category_Animation'],
        ['title' => 'The Family Plan', 'synopsis' => 'A former top assassin living incognito as a suburban dad must take his unsuspecting family on the run when his past catches up to him.', 'category' => 'category_Action'],
        ['title' => ' Percy Jackson and the Olympians', 'synopsis' => 'Demigod Percy Jackson leads a quest across America to prevent a war among the Olympian gods.', 'category' => 'category_Action'],
        ['title' => 'Wonka', 'synopsis' => 'Based on the extraordinary character at the center of Charlie and the Chocolate Factory, "Wonka" tells the wondrous story of how the world\'s greatest inventor, magician and chocolate-maker became the beloved Willy Wonka we know today.', 'category' => 'category_Aventure'],
        ['title' => 'Aquaman et le Royaume perdu', 'synopsis' => 'Aquaman balances his duties as king and as a member of the Justice League, all while planning a wedding. Black Manta is on the hunt for Atlantean tech to help rebuild his armor. Orm plots to escape his Atlantean prison.', 'category' => 'category_Fantastique'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAM as $programList) {
            $program = new Program();
            $program->setTitle($programList['title']);
            $program->setSynopsis($programList['synopsis']);
            $program->setCategory($this->getReference($programList['category']));
            $manager->persist($program);
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

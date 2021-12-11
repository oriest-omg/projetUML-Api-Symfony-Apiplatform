<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function __construct(
        EtudiantRepository $etudiantRepository

    )
    {
        $this->etudiantRepository = $etudiantRepository;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for($i=0;$i<3;$i++)
        {
        $etudiant = new Etudiant();
        $etudiant->setUsername($faker->name())
                ->setPassword(mt_rand(0000000000,9999999999));
        $manager->persist($etudiant);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Artiste;
use App\Entity\Musique;
use App\Entity\Style;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $pwd = $this->hasher->hashPassword($admin,'adminpwd');
        $admin->setPassword($pwd);
        $admin->setRoles(array('ROLE_ADMIN'));
        $manager->persist($admin);

        $pop = new Style();
        $pop->setNom('Pop');
        $rap = new Style();
        $rap->setNom('Rap');
        $rock = new Style();
        $rock->setNom('Rock');
        $reggae = new Style();
        $reggae->setNom('Reggae');
        $manager->persist($pop);
        $manager->persist($rap);
        $manager->persist($rock);
        $manager->persist($reggae);

        $rick = new Artiste();
        $rick->setNom('Rick Astley');
        $naps = new Artiste();
        $naps->setNom('Naps');
        $arctic = new Artiste();
        $arctic->setNom('Arctic Monkeys');
        $bob = new Artiste();
        $bob->setNom('Bob Marley');
        $manager->persist($rick);
        $manager->persist($naps);
        $manager->persist($arctic);
        $manager->persist($bob);

        $never = new Musique();
        $never->setTitre('Never gonna give you up');
        $never->setSon('nevergonnagiveyouup.mp3');
        $never->setArtiste($rick);
        $never->setStyle($pop);
        $never->setCreatedAt(new \DateTime('now'));
        $manager->persist($never);

        $chicha = new Musique();
        $chicha->setTitre('Chicha Kaloud');
        $chicha->setSon('chichakaloud.mp3');
        $chicha->setArtiste($naps);
        $chicha->setStyle($rap);
        $chicha->setCreatedAt(new \DateTime('now'));
        $manager->persist($chicha);

        $do = new Musique();
        $do->setTitre('Do I Wanna Know ?');
        $do->setSon('doiwannaknow.mp3');
        $do->setArtiste($arctic);
        $do->setStyle($rock);
        $do->setCreatedAt(new \DateTime('now'));
        $manager->persist($do);

        $jamming = new Musique();
        $jamming->setTitre('Jamming');
        $jamming->setSon('jamming.mp3');
        $jamming->setArtiste($bob);
        $jamming->setStyle($reggae);
        $jamming->setCreatedAt(new \DateTime('now'));
        $manager->persist($jamming);

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Asset;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadAssets($manager);
    }

    public function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('myket');
        $user->setEmail('myke@tyson.com');

        $user->setPassword(password_hash('secrect123', PASSWORD_DEFAULT));

        $this->addReference('user_admin', $user);

        $manager->persist($user);
        $manager->flush();
    }

    public function loadAssets(ObjectManager $manager)
    {
        $user = $this->getReference('user_admin');

        $asset = new Asset();
        $asset->setLabel('binance');
        $asset->setCurrency('BTC');
        $asset->setAmount(10);
        $asset->setUser($user);

        $manager->persist($asset);

        $asset = new Asset();
        $asset->setLabel('coinbase');
        $asset->setCurrency('ETH');
        $asset->setAmount(300);
        $asset->setUser($user);

        $manager->persist($asset);

        $asset = new Asset();
        $asset->setLabel('kraken');
        $asset->setCurrency('IOTA');
        $asset->setAmount(455);
        $asset->setUser($user);

        $manager->persist($asset);

        $manager->flush();
    }
}

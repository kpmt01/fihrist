<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

// doctrine:fixtures:load

class AppFixtures extends Fixture
{
    private $encoder;
    protected $faker;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = Factory::create('tr_TR');
    }

    public function load( ObjectManager $manager)
    {

        $user = new User();
        $user->setEmail('test@mturkmen.com');

        $user->setName('Mustafa Türkmen');
        $user->setUsername('admin');
        $user->setPhone('05554443322');
        $user->setEnabled(true);
        $user->setRoles(['ROLE_ADMIN']);
        $password = $this->encoder->encodePassword($user, '1234');

        $user->setPassword($password);
        $manager->persist($user);


        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email);

            $user->setName($this->faker->name);
            $user->setUsername($this->faker->userName);

            $user->setPhone($this->faker->phoneNumber);

            $user->setEnabled(true);
            $user->setRoles(['ROLE_NONE']);
            $password = $this->encoder->encodePassword($user, '0');

            $user->setPassword($password);
            $manager->persist($user);
        }

        $manager->flush();
    }
}

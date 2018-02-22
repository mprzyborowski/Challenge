<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Model\UserManagerInterface;


class AuthContext implements Context
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;
    /**
     * @var UserManagerInterface
     */
    private $userManager;
    /**
     * @var ArrayCollection
     */
    private $users;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     * @param UserManagerInterface $userManager
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(UserManagerInterface $userManager, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
        $this->users = new ArrayCollection();
    }


    /**
     * @Given /^there are Users with the following details:$/
     */
    public function thereAreUsersWithTheFollowingDetails(TableNode $users)
    {
        foreach ($users->getColumnsHash() as $key => $val) {

            $confirmationToken = isset($val['confirmation_token']) && $val['confirmation_token'] != ''
                ? $val['confirmation_token']
                : null;

            $existingUser = $this->userManager->findUserByUsername($val['username']);
            if ($existingUser) {
                return;
            }

            $user = $this->userManager->createUser();

            $user->setEnabled(true);
            $user->setUsername($val['username']);
            $user->setEmail($val['email']);
            $user->setPlainPassword($val['password']);
            $user->setConfirmationToken($confirmationToken);

            if (!empty($confirmationToken)) {
                $user->setPasswordRequestedAt(new \DateTime('now'));
            }

            $this->users->add($user);
            $this->userManager->updateUser($user);
        }
    }

    /**
     * @AfterScenario
     */
    public function afterScenario()
    {
        $this->clearTestUsers();
    }

    private function clearTestUsers(): void
    {
        foreach ($this->users as $user) {
            $this->userManager->deleteUser($user);
        }
    }
}
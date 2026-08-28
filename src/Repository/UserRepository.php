<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository extends EntityRepository { // The UserRepository class inherits all of Doctrine's built-in methods -- find($id), findAll(), getAll(), ...
    public function __construct(EntityManagerInterface $entityManager) {
        parent::__construct(
            $entityManager,
            $entityManager->getClassMetadata(User::class) // This means that Doctrine is "reading" the Entity/User.php file and understanding its structure
        );
    }
}

?>
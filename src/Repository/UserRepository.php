<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function saveOrUpdate(User $pUser)
    {
        $user = $pUser;
        if (!is_null($pUser->getId())) {
            $userInDB = $this->find($pUser->getId());
            if (!is_null($userInDB)) {
                $user = $userInDB;
            }
        }


        if (!is_null($pUser->getPhone())) {
            $user->setPhone($pUser->getPhone());
        }
        if (!is_null($pUser->getAge())) {
            $user->setAge($pUser->getAge());
        }
        if (!is_null($pUser->getEmail())) {
            $user->setEmail($pUser->getEmail());
        }
        if (!is_null($pUser->getGender())) {
            $user->setGender($pUser->getGender());
        }
        if (!is_null($pUser->getLocation())) {
            $user->setLocation($pUser->getLocation());
        }
        if (!is_null($pUser->getName())) {
            $user->setName($pUser->getName());
        }


        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function deleteUserById($id)
    {
        $user = $this->find($id);
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
    }

    public function createUser($user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

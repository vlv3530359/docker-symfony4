<?php
/**
 * Created by IntelliJ IDEA.
 * User: vlv
 * Date: 2018/9/27
 * Time: 10:29 AM
 */

namespace App\Service;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\This;
use Psr\Log\LoggerInterface;

class UserService
{

    private $userRepository;
    private $logger;

    public function __construct(UserRepository $pUserRepository, LoggerInterface $pLogger)
    {
        $this->userRepository = $pUserRepository;
        $this->logger = $pLogger;
    }

    public function findAllUser()
    {
        $users = $this->userRepository->findAll();
        if (!is_null($users) && sizeof($users) != 0) {
            return $users;
        }
        $this->logger->error("There is no any users created in app.");
    }

    public function findUserById($userId)
    {
        $user = $this->userRepository->find($userId);
        if (!is_null($user)) {
            return $user;
        }
        $this->logger->error("There is no any user with userId {0}.", userId);
    }

    public function saveOrUpdate($user)
    {
        $this->userRepository->saveOrUpdate($user);
    }

    public function deleteUserById($userId)
    {
        $this->userRepository->deleteUserById($userId);
    }

    public function createUser($user)
    {
        $this->userRepository->createUser($user);
    }
}
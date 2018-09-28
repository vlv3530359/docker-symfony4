<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;

class UserController extends AbstractController
{
    private $userService;

    public function __construct(UserService $pUserService)
    {
        $this->userService = $pUserService;
    }

    /**
     * @Route("/users", name="users")
     */
    public function findAll()
    {
        $users = $this->userService->findAllUser();
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController', 'users' => $users
        ]);
    }

    /**
     * @Route("/user/id/{id}", name="user")
     */
    public function user($id)
    {
        $user = $this->userService->findUserById($id);

        $form = $this->createFormBuilder($user)
            ->setAction($this->generateUrl('user_create'))
            ->setMethod('POST')
            ->add('id', HiddenType::class)
            ->add('name', TextType::class)
            ->add('phone', IntegerType::class)
            ->add('email', TextType::class)
            ->add('location', TextType::class)
            ->add('gender', TextType::class)
            ->add('age', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Save User'))
            ->getForm();
        $form->setData($user);
        return $this->render('user/user.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/user/delete/{id}", name="user_delete")
     */
    public function delete($id)
    {
        $this->userService->deleteUserById($id);
        return $this->findAll();
    }

    /**
     * @Route("/user/create", name="user_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function saveOrUpdate(Request $request)
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->setAction('create')
            ->setMethod('POST')
            ->add('name', TextType::class,array('label'  => 'User Name'))
            ->add('id', HiddenType::class)
            ->add('phone', IntegerType::class)
            ->add('email', TextType::class)
            ->add('location', TextType::class)
            ->add('gender', TextType::class)
            ->add('age', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Save User'))
            ->getForm();
//        $form = $this->createForm(UserType::class, $user, array('action' => $this->generateUrl('user_create'), 'method' => 'POST'));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $this->userService->saveOrUpdate($user);
            return $this->findAll();
        } else {
            return $this->render('user/user.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }
}

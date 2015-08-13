<?php

namespace Api\Bundle\UserBundle\Controller;

use Api\Bundle\UserBundle\Entity\User;
use Api\Bundle\UserBundle\Service\UserService;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\RequestParam;


class DefaultController extends FOSRestController
{
    /**
     * Return the overall user list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall User List",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUsersAction()
    {
        /** @var UserService $userService */
        $userService = $this->get('api.user.service.user');

        $users = $userService->findAll();

        $view = $this->view($users);
        return $this->handleView($view);
    }

    /**
     * Return an user identified by user id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return an user identified by username/email",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     *
     * @param User $user userId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUserAction(User $user)
    {
        $view = $this->view($user);
        return $this->handleView($view);
    }


    /**
     * Create a User from the submitted data.<br/>
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new user from the submitted data.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="username", nullable=false, strict=true, description="Username.")
     * @RequestParam(name="email", nullable=false, strict=true, description="Email.")
     * @RequestParam(name="password", nullable=false, strict=true, description="Plain Password.")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postUserAction(ParamFetcher $paramFetcher)
    {
        /** @var UserService $userService */
        $userService = $this->get('api.user.service.user');

        $user = new User();
        $user->setUsername($paramFetcher->get('username'));
        $user->setEmail($paramFetcher->get('email'));
        $user->setPlainPassword($paramFetcher->get('password'));

        $validator = $this->get('validator');
        $errors = $validator->validate($user);

        if (count($errors) > 0) {
            $view = $errorsString = (string) $errors;
            $view = $this->view($view);
        } else {
            $userService->save($user);
            $view = $this->view($user);
        }

        return $this->handleView($view);
    }

    /**
     * Delete an user identified by username/email.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Delete an user identified by user id",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     *
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteUserAction(User $user)
    {
        /** @var UserService $userService */
        $userService = $this->get('api.user.service.user');

        $userEntity = $userService->find($user);
        if(! $userEntity instanceof User) {
            $view = $this->view('User not found', 404);
        } else {
            $userService->delete($user);
            $view = $this->view('User deleted')->setStatusCode(204);
        }

        return $this->handleView($view);
    }
}

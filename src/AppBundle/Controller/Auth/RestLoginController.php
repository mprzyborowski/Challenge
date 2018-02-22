<?php
/**
 * Created by PhpStorm.
 * User: marcin
 * Date: 2/17/18
 * Time: 11:58 PM
 */

namespace AppBundle\Controller\Auth;


use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;

/**
 * @RouteResource("/api/login", pluralize=false)
 */
class RestLoginController extends FOSRestController implements ClassResourceInterface
{
    public function postAction()
    {
        // route handled by Lexik JWT Authentication Bundle
        throw new \DomainException('You should never see this');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: marcin
 * Date: 2/17/18
 * Time: 3:38 PM
 */

namespace AppBundle\Controller\Api;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class TokenController extends Controller
{

    public function newTokenAction(Request $request)
    {
        return new Response('cool!');
    }

}
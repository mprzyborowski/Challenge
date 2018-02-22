<?php

namespace AppBundle\Controller\Api;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

class UserController extends FOSRestController implements ClassResourceInterface
{

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function cgetAction()
    {
        $aaa = $this->getDoctrine()->getRepository('AppBundle:User')
            ->find(1);

        $a= $this->serializer->serialize($aaa,'json',SerializationContext::create()->setGroups(array('bb')));

        return new Response($a);

    }

}
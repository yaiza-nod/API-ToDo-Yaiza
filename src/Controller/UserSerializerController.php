<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Json;

class UserSerializerController extends AbstractController
{
    /**
     * @Route("/serializar", name="serializar")
     */
    public function serializar(): Response {

        $encoders = [new JsonEncoder(), new XmlEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $user = new User();
        $user->setUsername('serializador');
        $user->setPassword('pass');
        $user->setEmail('serializador@email.com');

        $jsonContent = $serializer->serialize($user, 'json');

        // $jsonContent contains {"name":"foo","age":99,"sportsperson":false,"createdAt":null}

        $response = new Response($jsonContent);

        return $response;

    }

    /**
     * @Route("/serializarBBDD/{id}", name="serializarBBDD")
     */
    public function serializarBBDD($id): Response
    {

        $encontrado = false;

        $encoders = [new JsonEncoder(), new XmlEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        // $user = $this->getDoctrine()->getRepository('App:User')->find($id);

        $user =  $this->getDoctrine()->getManager()->getRepository('App:User')->find($id);
        $data = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
            'password' => $user->getPassword(),
            'email' => $user->getEmail(),
            'isVerified' => $user->isVerified()
        ];

        // Falta ver como serializo las tareas al haber una relación del ORM con el usuario

        $jsonContent = $serializer->serialize($data, 'json');

        $response = new Response($jsonContent);

        return $response;

    }


}
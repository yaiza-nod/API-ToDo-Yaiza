<?php

namespace App\Controller;

use App\Entity\Tarea;
use App\Entity\User;
use App\Form\TransferTaskFormType;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransferTaskController extends AbstractController
{
    /**
     * @Route("/transferTask/{id}/{end}", name="transfer_task")
     */
    public function transfer(Request $request): Response
    {
        $form = $this->createForm(TransferTaskFormType::class);

        if ($request->isMethod('POST')) {

            $form->submit($request->request->get($form->getName()));


            if ($form->isSubmitted() && $form->isValid()) {

                $user = $form->getData();

                $comprobar = $this->getDoctrine()->getManager()->getRepository('App:User')->findOneBy(array('username' => $user['username']));

                if ($comprobar != null && $user['username'] === $comprobar->getUsername() && $request->attributes->get('end') == 'false') {
                    return $this->redirectToRoute('admin');
                }
            }
        }

        return $this->render('transfer_task/transfer_task.html.twig', [
            'transferTaskForm' => $form->createView(),
        ]);
    }
}

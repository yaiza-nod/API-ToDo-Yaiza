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


                if ($comprobar != NULL) {

                    // Obteniendo el id del usuario:

                    $id = $comprobar->getId();

                    // Hago esta consulta: SELECT count(*) FROM tarea WHERE id_usuario_id = 1 AND marcada = 0;

                    $q = $this->getDoctrine()->getManager()->getRepository('App:Tarea')->createQueryBuilder('tarea')
                        ->select('count(tarea.id)')
                        ->where('tarea.idUsuario = :id')
                        ->andWhere('tarea.marcada = false')
                        ->setParameter('id', $id)
                        ->getQuery()->getResult();

                    // Asigno a $q la cantidad de tareas sin completar que tiene el usuario

                    $q = $q[0][1];

                    // SI el usuario introducido en el formulario coincide con algun registro de la base de datos, la tarea esta sin finalizar y el usuario no tiene mas de 2 pendientes:

                    if ($user['username'] === $comprobar->getUsername() && $request->attributes->get('end') == 'false' && $q < 3) {

                        // Compruebo que la tarea no ha sido transferida mas de 2 veces

                        $veces = $this->getDoctrine()->getManager()->getRepository('App:Tarea')->createQueryBuilder('tarea')
                            ->select('tarea.vecesTransferida')
                            ->where('tarea.id = '.$request->attributes->get('id'))
                            ->getQuery()->getResult();

                        $veces = $veces[0]['vecesTransferida'];

                        if ($veces < 2) {

                            $sumarVez = $this->getDoctrine()->getManager()->getRepository('App:Tarea')->createQueryBuilder('tarea')
                                ->update('App:Tarea', 'tarea')
                                ->set('tarea.vecesTransferida', 'tarea.vecesTransferida + 1')
                                ->where('tarea.id = '.$request->attributes->get('id'))
                                ->getQuery()->getResult();

                            $cambiarTarea = $this->getDoctrine()->getManager()->getRepository('App:Tarea')->createQueryBuilder('tarea')
                                ->update('App:Tarea', 'tarea')
                                ->set('tarea.idUsuario', $id)
                                ->where('tarea.id = '.$request->attributes->get('id'))
                                ->getQuery()->getResult();

                            return $this->redirectToRoute('admin');
                        }


                    }
                }
            }
        }

        return $this->render('transfer_task/transfer_task.html.twig', [
            'transferTaskForm' => $form->createView(),
        ]);
    }
}

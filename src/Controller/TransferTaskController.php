<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransferTaskController extends AbstractController
{
    /**
     * @Route("/transfer/task", name="transfer_task")
     */
    public function index(): Response
    {
        return $this->render('transfer_task/index.html.twig', [
            'controller_name' => 'TransferTaskController',
        ]);
    }
}

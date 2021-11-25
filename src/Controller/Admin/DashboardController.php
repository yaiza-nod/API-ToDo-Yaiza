<?php

namespace App\Controller\Admin;

use App\Entity\Tarea;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // Si el usuario no ha iniciado sesión, redirigo al login:

        if ($this->getUser() === NULL) {

            return $this->redirect('login');
        }

        return $this->render('dashboard/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('API ToDo Yaiza');
    }

    public function configureMenuItems(): iterable
    {
        return [

            MenuItem::section('Usuario')->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('Usuarios', 'fa fa-user', User::class)->setPermission('ROLE_ADMIN'),

            MenuItem::section('Tarea'),
            MenuItem::linkToCrud('Tareas', 'fa fa-comment', Tarea::class),

            MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'principal'),
            MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
        ];

    }
}

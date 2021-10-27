<?php

namespace App\Controller\Admin;

use App\Entity\Tarea;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TareaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tarea::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

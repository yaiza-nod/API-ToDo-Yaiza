<?php

namespace App\Controller\Admin;

use App\Entity\Tarea;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use \EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;

class TareaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tarea::class;
    }


    /*public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }*/

    public function configureFilters(Filters $filters): Filters
    {
        return $filters

            // most of the times there is no need to define the
            // filter type because EasyAdmin can guess it automatically
            ->add(BooleanFilter::new('marcada'));
    }

}

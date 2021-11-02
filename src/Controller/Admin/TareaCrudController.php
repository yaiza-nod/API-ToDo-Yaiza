<?php

namespace App\Controller\Admin;

use App\Entity\Tarea;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;

class TareaCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Tarea::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->hideOnForm()->hideOnDetail(),
            TextField::new('titulo'),
            TextEditorField::new('descripcion'),
            DateTimeField::new('fecha'),
            BooleanField::new('marcada'),

            DateTimeField::new('creacion')->hideOnForm(),
            ChoiceField::new('categoria')->setChoices([
                'Trabajo' => 'Trabajo',
                'Ocio' => 'Ocio',
                'Viaje' => 'Viaje',
                'Reunión' => 'Reunión',
                'Sin categoría' => 'Sin categoría'
            ])
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined(true)
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters

            // most of the times there is no need to define the
            // filter type because EasyAdmin can guess it automatically
            ->add(BooleanFilter::new('marcada'))
            ->add(ChoiceFilter::new('categoria')->setChoices([
                'Trabajo' => 'Trabajo',
                'Ocio' => 'Ocio',
                'Viaje' => 'Viaje',
                'Reunión' => 'Reunión',
                'Sin categoría' => 'Sin categoría'
            ]));
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
            ;
    }

}

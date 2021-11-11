<?php

namespace App\Controller\Admin;

use App\Entity\Tarea;
use App\Repository\TareaRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;

class TareaCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Tarea::class;
    }

    public function configureFields(string $pageName): iterable
    {
            return [
                IntegerField::new('id')->hideOnForm()->hideOnDetail()->hideOnIndex(),
                TextField::new('titulo'),
                TextareaField::new('descripcion'),
                DateTimeField::new('fecha'),
                BooleanField::new('marcada'),

                DateTimeField::new('creacion')->hideOnForm(),
                ChoiceField::new('categoria')->setChoices([
                    'Trabajo' => 'Trabajo',
                    'Ocio' => 'Ocio',
                    'Viaje' => 'Viaje',
                    'Reunión' => 'Reunión',
                    'Sin categoría' => 'Sin categoría'
                ]),


                AssociationField::new('idUsuario')
                    ->setRequired(true)
                    ->setFormTypeOptions(['query_builder' => function (TareaRepository $em) {
                        return $em->createQueryBuilder('f')
                            ->where('f.id_usuario_id = :idUsuario')
                            ->setParameter('idUsuario', $this->getUser()->getUserIdentifier());
                    }])->hideOnForm()->hideOnDetail()->hideOnIndex(),


            ];

    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $qb = $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $qb->andWhere('entity.idUsuario = :user');
        $qb->setParameter('user', $this->getUser());
        return $qb;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined(true)
            ->setPageTitle('detail', fn (Tarea $tarea) => sprintf( $tarea->getTitulo()))
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
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ;
    }

}

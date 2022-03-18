<?php

namespace App\Controller\Admin;

use App\Entity\Artiste;
use App\Entity\Musique;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;

class MusiqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Musique::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('fichierSon')->setFormType(VichFileType::class)->hideOnIndex(),
            Field::new('son')->setTemplatePath('/uploads/musiques')->hideWhenCreating()->hideOnIndex()->hideWhenUpdating(),
            AssociationField::new('artiste')->autocomplete(),
            AssociationField::new('style')->autocomplete(),
        ];
    }
}

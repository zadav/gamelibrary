<?php

namespace David\GameBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

/**
 * Description of GameAdmin
 *
 * @author dazao
 */
class GameAdmin extends Admin
{
    //Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
          $formMapper
            ->add('title', 'text')
            ->add('description', 'text')
            ->add('year', 'date')
            ->add('image')
        ;
    }

    //Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $dataGridMapper)
    {
        $dataGridMapper
            ->add('title')
            ->add('year');
    }

    //Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('description')
            ->add('year')
        ;
    }
}

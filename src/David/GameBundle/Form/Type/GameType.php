<?php 

namespace David\GameBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('description', 'text')
            ->add('year', 'date')
            ->add('image')
            ->add('save','submit')
            ->add('saveAndAdd','submit');
    }
    
    public function getName()
    {
        return 'game';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'David\GameBundle\Entity\Game',
        );
    }
}


<?php

namespace QuestServer\QuestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('locationHuman')
            ->add('locationCoord')
            ->add('summary')
            ->add('quest','entity', array(
                                    'class' => 'QuestServerQuestBundle:Quest',
                                    'property' => 'name'
                                    ))
            ->add('questiontype','entity', array(
                                    'class' => 'QuestServerQuestBundle:QuestionType',
                                    'property' => 'name'
                                    ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'QuestServer\QuestBundle\Entity\Question'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'questserver_questbundle_question';
    }
}

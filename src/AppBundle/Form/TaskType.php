<?php

namespace AppBundle\Form;

use AppBundle\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('priority', ChoiceType::class, [
                'choices' => [
                    'High' => Task::PRIORITY_HIGH,
                    'Normal' => Task::PRIORITY_NORMAL,
                    'Low' => Task::PRIORITY_LOW
                ]
            ])
            ->add('author')
            ->add('assignee')
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $task = $event->getData();
            $form = $event->getForm();

            if (!$task || null === $task->getId()) {
                $statusList = [
                    'New' => Task::STATUS_NEW,
                ];
            } else {
                $statusList = [
                    'New' => Task::STATUS_NEW,
                    'In progress' => Task::STATUS_IN_PROGRESS,
                    'Completed' => Task::STATUS_COMPLETED
                ];
            }

            $form->add('status', ChoiceType::class, [
                'choices' => $statusList
            ]);
        });
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Task'
        ]);
    }
}

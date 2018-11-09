<?php 

namespace AppBundle\Form;

use AppBundle\Entity\Comentario;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ComentarioType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
            ->add('pseudonimo', TextType::class, array(
                'label' => 'Pseudónimo',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Tu pseudónimo...'
                )
            ))
            ->add('email', TextType::class, array(
                'label' => 'Email',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Indica tu email...'
                )
            ))                    
            ->add('descripcion', TextareaType::class, array(
            	'label' => 'Descripción',
				'attr' => array(
                	'class' => 'form-control',
                    'placeholder' => 'Envía tu comentario...'
                )
            ))
            ->add('enviar', SubmitType::class, array(
            	'label' => 'Enviar',
            	'attr' => array('class' => 'btn btn-primary')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Comentario::class,
        ));
    }    
}
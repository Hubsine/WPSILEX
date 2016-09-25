<?php

namespace DMarketPlace\Framework\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use DMarketPlace\Framework\Model\SellerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Description of User
 *
 * @author nsi
 */
class SellerRegisterType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => 'seller_register.username',
                'translation_domain' => 'forms',
                'required'  => false, 
                'constraints' => array(
                    new NotBlank()
                    )
            ))
            ->add('firstName', TextType::class, array(
                'label' => 'seller_register.first_name',
                'translation_domain' => 'forms'
            ))
            ->add('lastName', TextType::class, array(
                'label' => 'seller_register.last_name',
                'translation_domain' => 'forms'
            ))
            ->add('dmAction', HiddenType::class, array(
                'data'  => SellerInterface::ACTION_CREATE
            ))    
            ->add('save', SubmitType::class, array(
                'label' => 'seller_register.submit',
                'translation_domain' => 'forms'
            ))
            ->setAction('')
                
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        'data_class' => 'DMarketPlace\Framework\Entity\Seller',
    ));
    }

    
}

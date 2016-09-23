<?php

namespace DMarketPlace\Framework\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use DMarketPlace\Framework\Model\SellerInterface;

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
                'label' => 'seller_registser.username',
                'translation_domain' => 'form'
            ))
            ->add('firstName', TextType::class, array(
                'label' => 'seller_registser.first_name',
                'translation_domain' => 'form'
            ))
            ->add('lastName', TextType::class, array(
                'label' => 'seller_registser.last_name',
                'translation_domain' => 'form'
            ))
            ->add('dmAction', HiddenType::class, array(
                'data'  => SellerInterface::ACTION_CREATE
            ))    
            ->add('save', SubmitType::class)
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

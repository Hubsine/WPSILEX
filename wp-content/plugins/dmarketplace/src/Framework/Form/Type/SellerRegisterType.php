<?php

namespace DMarketPlace\Framework\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use DMarketPlace\Framework\Model\SellerInterface;
use DMarketPlace\Framework\Form\Constraints\SellerRegisterConstraint;
use DMarketPlace\Framework\Actions\SellerActions;

/**
 * Description of User
 *
 * @author nsi
 */
class SellerRegisterType extends AbstractType{
    
    public $constraints;
    
    public function __construct() {
        $this->constraints = new SellerRegisterConstraint();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('user_login', TextType::class, array(
                    'label' => 'seller.register.user_login',
                    'label_attr' => array(
                        'data-toggle'=>'tooltip', 
                        'data-placement'=>'auto top',
                        'data-trigger' => 'hover',
                        'data-title' => 'seller.register.tooltip.user_login',
                        ),
                    'constraints' => $this->constraints->user_login
                ))
                ->add('nickname', TextType::class, array(
                    'label' => 'seller.register.nickname',
                    'constraints' => $this->constraints->nickname
                ))
                ->add('display_name', TextType::class, array(
                    'label' => 'seller.register.display_name', 
                    'constraints' => $this->constraints->display_name
                ))
                ->add('user_email', EmailType::class, array(
                    'label' => 'seller.register.user_email', 
                    'constraints'   => $this->constraints->user_email
                ))
                ->add('first_name', TextType::class, array(
                    'label' => 'seller.register.first_name',
                    'constraints' => $this->constraints->first_name,
                    'required'  => false
                ))
                ->add('last_name', TextType::class, array(
                    'label' => 'seller.register.last_name',
                    'constraints' => $this->constraints->last_name
                ))
                ->add('dm_action', HiddenType::class, array(
                    'data'  => SellerActions::ACTION_CREATE
                ))    
                ->add('save', SubmitType::class, array(
                    'label' => 'seller.register.submit'
                ))
                ->setAction('')
                
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DMarketPlace\Framework\Entity\Seller',
            'translation_domain' => 'forms', 
            #'validation_groups' => 'SellerRegistration'
    ));
    }

    
}

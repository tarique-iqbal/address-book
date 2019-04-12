<?php declare(strict_types = 1);

namespace AppBundle\Form;

use AppBundle\Entity\AddressBook;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Intl;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AddressBookType
 * @package AppBundle\Form
 */
class AddressBookType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $countries = Intl::getRegionBundle()->getCountryNames();

        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('email', EmailType::class)
            ->add('streetNumber', TextType::class, [
                'label' => 'Street and Number',
            ])
            ->add('zip', TextType::class)
            ->add('city', TextType::class)
            ->add('country', ChoiceType::class, [
                'choices' => array_flip($countries),
                'placeholder' => 'Select country',
            ])
            ->add('phoneNumber', TelType::class)
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('photo', FileType::class, [
                'required' => false
            ])
            ->add('save', SubmitType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddressBook::class,
            'csrf_token_id' => 'address_book',
        ]);
    }
}

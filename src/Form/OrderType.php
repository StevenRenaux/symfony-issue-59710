<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

//        Tested with 151.0000
        $builder
//            ->add('cost', NumberType::class, [
//                'scale' => 4,
//            ])
//          No more than one query even if we remove a few zeros after the decimal point

//            ->add('cost', NumberType::class, [
//                'scale' => 4,
//                'input' => 'string',
//            ])
//          Updated every time even when we remove a zero behind the decimal point

            ->add('cost', MoneyType::class, [
                'scale' => 4,
            ])
//          No more than one query even if we remove a few zeros after the decimal point

            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}

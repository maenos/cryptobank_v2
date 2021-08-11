<?php

namespace App\Form;

use App\Entity\Transaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',HiddenType::class)
            ->add('type', HiddenType::class)
            ->add('crypto',ChoiceType::class,[
                'choices'  => [
                    'select' => 'select',
                    'Bitcoin' => 'Bitcoin',
                    'Ethereum' => 'Ethereum',
                    'Mainston' => 'Ston',
                    'Binance Coin' => 'BNB',
                    'Tronc' => 'Trx',
                    'cardano' => 'ADA',
                    'Perfect Money'=>'PM'
                ],
                'attr'=>[

                    'onchange'=>'give()',
                    'class'=>'form-control',

                ]

            ])
            ->add('method',ChoiceType::class,[
                'choices'  => [
                    'select' => 'select',
                    'flooz' => 'flooz',
                    'tmoney' => 'tmoney',
                    'wire transfert' => 'wire'

                ],
                'attr'=>[

                    'onchange'=>'receive()',
                    'class'=>'form-control',

                ]

            ])
            ->add('giveM',NumberType::class,[
                'attr'=>[

                    'oninput'=>'buyf(this.id, this.value)',
                    'onchange'=>'buyf(this.id, this.value)',
                    'class'=>'form-control'
                ]
            ])
            ->add('receiveM',NumberType::class,[
                'attr'=>[

                    'oninput'=>'buyf(this.id, this.value)',
                    'onchange'=>'buyf(this.id, this.value)',
                    'class'=>'form-control'
                ]
            ])
            ->add('adresse',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('txid',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('date', HiddenType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}

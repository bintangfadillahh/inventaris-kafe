<?php

namespace App\Form;

use App\Entity\Barang;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BarangType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nama_barang', null, [
                'label' => 'Nama Barang',
                'attr' => ['class' => 'form-control']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Simpan',
                'attr' => ['class' => 'btn btn-info mr-1']
            ])
            ->add('save_and_continue', SubmitType::class, [
                'label' => 'Simpan & Lanjut',
                'attr' => ['class' => 'btn btn-info mr-1']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Barang::class,
        ]);
    }
}

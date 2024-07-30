<?php

namespace App\Form;

use App\Entity\Barang;
use App\Entity\BarangMasuk;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BarangMasukType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_barang')
            ->add('tgl_masuk', null, [
                'widget' => 'single_text',
            ])
            ->add('spesifikasi')
            ->add('kondisi')
            ->add('jml_masuk')
            ->add('barang', EntityType::class, [
                'class' => Barang::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BarangMasuk::class,
        ]);
    }
}

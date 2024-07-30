<?php

namespace App\Form;

use App\Entity\BarangKeluar;
use App\Entity\Barang;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BarangKeluarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id_barang', EntityType::class, [
                'class' => Barang::class,
                'choice_label' => 'nama_barang',
                'attr' => ['class' => 'form-control select2 text-capitalize']
            ])
            ->add('jml_keluar', IntegerType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('deskripsi', TextareaType::class, [
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BarangKeluar::class,
        ]);
    }
}

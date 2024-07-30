<?php

namespace App\Entity;

use App\Repository\BarangMasukRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarangMasukRepository::class)]
class BarangMasuk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_masuk = null;

    // #[ORM\Column]
    // private ?int $id_barang = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $tgl_masuk = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $spesifikasi = null;

    #[ORM\Column(length: 100)]
    private ?string $kondisi = null;

    #[ORM\Column]
    private ?int $jml_masuk = null;

    #[ORM\ManyToOne(targetEntity: Barang::class, inversedBy: 'barangKeluars')]
    #[ORM\JoinColumn(nullable: false, name: 'id_barang', referencedColumnName: 'id_barang')]
    private ?Barang $barang = null;

    public function getBarang(): ?Barang
    {
        return $this->barang;
    }

    public function setBarang(?Barang $barang): self
    {
        $this->barang = $barang;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id_masuk;
    }

    // public function getIdBarang(): ?int
    // {
    //     return $this->id_barang;
    // }

    // public function setIdBarang(int $id_barang): static
    // {
    //     $this->id_barang = $id_barang;

    //     return $this;
    // }

    public function getTglMasuk(): ?\DateTimeInterface
    {
        return $this->tgl_masuk;
    }

    public function setTglMasuk(\DateTimeInterface $tgl_masuk): static
    {
        $this->tgl_masuk = $tgl_masuk;

        return $this;
    }

    public function getSpesifikasi(): ?string
    {
        return $this->spesifikasi;
    }

    public function setSpesifikasi(string $spesifikasi): static
    {
        $this->spesifikasi = $spesifikasi;

        return $this;
    }

    public function getKondisi(): ?string
    {
        return $this->kondisi;
    }

    public function setKondisi(string $kondisi): static
    {
        $this->kondisi = $kondisi;

        return $this;
    }

    public function getJmlMasuk(): ?int
    {
        return $this->jml_masuk;
    }

    public function setJmlMasuk(int $jml_masuk): static
    {
        $this->jml_masuk = $jml_masuk;

        return $this;
    }
}

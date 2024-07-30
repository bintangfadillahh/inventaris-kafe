<?php

namespace App\Entity;

use App\Repository\BarangKeluarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PrePersist;

#[ORM\Entity(repositoryClass: BarangKeluarRepository::class)]
class BarangKeluar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_keluar = null;

    #[ORM\Column]
    private ?int $id_barang = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $tgl_keluar = null;

    #[ORM\Column]
    private ?int $jml_keluar = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $deskripsi = null;

    #[ORM\ManyToOne(targetEntity: Barang::class, inversedBy: 'barangKeluars')]
    #[ORM\JoinColumn(nullable: false, name: 'id_barang', referencedColumnName: 'id_barang')]
    private ?Barang $barang = null;

    public function getId(): ?int
    {
        return $this->id_keluar;
    }

    public function getIdBarang(): ?int
    {
        return $this->id_barang;
    }

    public function setIdBarang(?int $id_barang): static
    {
        $this->id_barang = $id_barang;

        return $this;
    }

    public function getTglKeluar(): ?\DateTimeInterface
    {
        return $this->tgl_keluar;
    }

    // public function setTglKeluar(\DateTimeInterface $tgl_keluar): static
    // {
    //     $this->tgl_keluar = $tgl_keluar;

    //     return $this;
    // }
    #[PrePersist]
    public function setTglKeluarValue(): void 
    {
        $this->tgl_keluar = new \DateTime();
    }


    public function getJmlKeluar(): ?int
    {
        return $this->jml_keluar;
    }

    public function setJmlKeluar(int $jml_keluar): static
    {
        $this->jml_keluar = $jml_keluar;

        return $this;
    }

    public function getDeskripsi(): ?string
    {
        return $this->deskripsi;
    }

    public function setDeskripsi(string $deskripsi): static
    {
        $this->deskripsi = $deskripsi;

        return $this;
    }

    public function getBarang(): ?Barang
    {
        return $this->barang;
    }

    public function setBarang(?Barang $barang): self
    {
        $this->barang = $barang;
        return $this;
    }
}

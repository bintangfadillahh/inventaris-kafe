<?php

namespace App\Entity;

use App\Repository\BarangRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarangRepository::class)]
class Barang
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_barang = null;

    #[ORM\Column(length: 255)]
    private ?string $nama_barang = null;

    #[ORM\OneToMany(mappedBy: 'barang', targetEntity: BarangMasuk::class, orphanRemoval: true)]
    private Collection $barangMasuks;

    #[ORM\OneToMany(mappedBy: 'barang', targetEntity: BarangKeluar::class, orphanRemoval: true)]
    private Collection $barangKeluars;

    public function __construct()
    {
        $this->barangKeluars = new ArrayCollection();
        $this->barangMasuks = new ArrayCollection();
    }
    
    public function getBarangKeluars(): Collection
    {
        return $this->barangKeluars;
    }

    public function getBarangMasuks(): Collection
    {
        return $this->barangMasuks;
    }

    public function getIdBarang(): ?int
    {
        return $this->id_barang;
    }

    public function setIdBarang(?int $id_barang): self
    {
        $this->id_barang = $id_barang;
        return $this;
    }

    public function getNamaBarang(): ?string
    {
        return $this->nama_barang;
    }

    public function setNamaBarang(string $nama_barang): static
    {
        $this->nama_barang = $nama_barang;

        return $this;
    }
}

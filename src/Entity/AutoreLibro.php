<?php

namespace App\Entity;

use App\Repository\AutoreLibroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AutoreLibroRepository::class)]
class AutoreLibro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $extra = null;

    #[ORM\ManyToOne(inversedBy: 'autoreLibros')]
    private ?Autore $autore = null;

    #[ORM\ManyToOne(inversedBy: 'autoreLibros')]
    private ?Libro $libro = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExtra(): ?string
    {
        return $this->extra;
    }

    public function setExtra(?string $extra): static
    {
        $this->extra = $extra;

        return $this;
    }

    public function getAutore(): ?Autore
    {
        return $this->autore;
    }

    public function setAutore(?Autore $autore): static
    {
        $this->autore = $autore;

        return $this;
    }

    public function getLibro(): ?Libro
    {
        return $this->libro;
    }

    public function setLibro(?Libro $libro): static
    {
        $this->libro = $libro;

        return $this;
    }
}

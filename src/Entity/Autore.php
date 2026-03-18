<?php

namespace App\Entity;

use App\Repository\AutoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AutoreRepository::class)]
#[ORM\Table(name:"autore")]

class Autore
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    #[Assert\Length(
        min:3,
        minMessage:'Il nome deve contenere almeno tre caratteri',
        max: 25,
        maxMessage: 'Il nome è troppo lungo'
    )]
    #[Assert\NotBlank(message: 'Il nome è obbligatorio')]
    private string $nomeAutore;

    #[ORM\Column(length: 25)]
    #[Assert\Length(
        min:3,
        minMessage:'Il cognome deve contenere almeno due caratteri',
        max: 25,
        maxMessage: 'Il cognome è troppo lungo'
    )]
    #[Assert\NotBlank(message: 'Il cognome è obbligatorio')]
    private string $cognomeAutore;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dataNascita = null;

    /**
     * @var Collection<int, AutoreLibro>
     */
    #[ORM\OneToMany(targetEntity: AutoreLibro::class, mappedBy: 'autore', cascade: ['persist', 'remove'])]
    private Collection $autoreLibros;

    #[ORM\Column(nullable: true)]
    private ?bool $disponibilita = null;

    #[ORM\Column(nullable: false)]
    #[Assert\PositiveOrZero(message: "Il punteggio ha un minimo di 1 ed un massimo di 10")]
    #[Assert\NotBlank(message: 'Il campo non può essere vuoto')]
    private int $qualitaScrittura;

    public function __construct()
    {
        $this->autoreLibros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeAutore(): ?string
    {
        return $this->nomeAutore;
    }

    public function setNomeAutore(string $nomeAutore): static
    {
        $this->nomeAutore = $nomeAutore;

        return $this;
    }

    public function getCognomeAutore(): ?string
    {
        return $this->cognomeAutore;
    }

    public function setCognomeAutore(string $cognomeAutore): static
    {
        $this->cognomeAutore = $cognomeAutore;

        return $this;
    }

    public function getDataNascita(): ?\DateTime
    {
        return $this->dataNascita;
    }

    public function setDataNascita(?\DateTime $dataNascita): static
    {
        $this->dataNascita = $dataNascita;

        return $this;
    }

    public function getNomeCognome(): string
    {
        return $this->getNomeAutore() . ' ' . $this->getCognomeAutore();
    }

    /**
     * @return Collection<int, AutoreLibro>
     */
    public function getAutoreLibros(): Collection
    {
        return $this->autoreLibros;
    }

    public function addAutoreLibro(AutoreLibro $autoreLibro): static
    {
        if (!$this->autoreLibros->contains($autoreLibro)) {
            $this->autoreLibros->add($autoreLibro);
            $autoreLibro->setAutore($this);
        }

        return $this;
    }

    public function removeAutoreLibro(AutoreLibro $autore): static
    {
        if ($this->autoreLibros->removeElement($autore)) {
            // set the owning side to null (unless already changed)
            if ($autore->getAutore() === $this) {
                $autore->setAutore(null);
            }
        }

        return $this;
    }

    public function isDisponibilita(): ?bool
    {
        return $this->disponibilita;
    }

    public function setDisponibilita(?bool $disponibilita): static
    {
        $this->disponibilita = $disponibilita;

        return $this;
    }

    public function getQualitaScrittura(): ?int
    {
        return $this->qualitaScrittura;
    }

    public function setQualitaScrittura(?int $qualitaScrittura): static
    {
        $this->qualitaScrittura = $qualitaScrittura;

        return $this;
    }
}

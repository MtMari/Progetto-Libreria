<?php

namespace App\Entity;

use App\Repository\LibroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LibroRepository::class)]
#[ORM\Table(name:"libro")]

class Libro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length(
        min:3, 
        minMessage:'Il titolo deve contenere almeno tre caratteri',
        max: 20,
        maxMessage: 'Il titolo è troppo lungo'
    )]
    #[Assert\NotBlank(message: 'Il titolo è obbligatorio')]
    private ?string $titolo = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 3,
        minMessage: 'La descrizione deve contenere almeno tre caratteri',
        max: 255,
        maxMessage: 'La descrizione è troppo lunga'
    )]
    #[Assert\Type(type: 'string', message: 'Tipo errato')]
    private ?string $descrizione = null;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, AutoreLibro>
     */
    #[ORM\OneToMany(targetEntity: AutoreLibro::class, mappedBy: 'libro', cascade: ['persist', 'remove'])]
    #[Assert\Count(min:1, minMessage: 'Selezionare almeno un autore')]
    private \Doctrine\Common\Collections\Collection $autoreLibros;

    #[ORM\Column(nullable: false)]
    #[Assert\Positive(message: 'Formato non valido. Sono accettati solo numeri postivi.')]
    #[Assert\NotBlank(message: 'Il campo non può essere vuoto')]
    private int $pagine;

    public function __construct()
    {
        $this->autoreLibros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitolo(): ?string
    {
        return $this->titolo;
    }

    public function setTitolo(string $titolo): static
    {
        $this->titolo = $titolo;

        return $this;
    }

    public function getDescrizione(): ?string
    {
        return $this->descrizione;
    }

    public function setDescrizione(?string $descrizione): static
    {
        $this->descrizione = $descrizione;

        return $this;
    }
    
    /**
     * @return \Doctrine\Common\Collections\Collection<int, AutoreLibro>
     */
    public function getAutoreLibros(): \Doctrine\Common\Collections\Collection
    {
        return $this->autoreLibros;
    }

    public function getAutores()
    {
        // $autores = [];

        // foreach($this->autoreLibros as $autoreLibro)
        // {
        //     $autores[] = $autoreLibro->getAutore();
        // }

        // return $autores;

        return $this->getAutoreLibros()->map(function(AutoreLibro $autoreLibro){
            return $autoreLibro->getAutore();
        });
    }

    
    public function addAutoreLibro(AutoreLibro $autoreLibro): static
    {
        if (!$this->autoreLibros->contains($autoreLibro)) {
            $this->autoreLibros->add($autoreLibro);
            $autoreLibro->setLibro($this);
        }

        return $this;
    }

    public function removeAutoreLibro(AutoreLibro $libro): static
    {
        if ($this->autoreLibros->removeElement($libro)) {
            // set the owning side to null (unless already changed)
            if ($libro->getLibro() === $this) {
                $libro->setLibro(null);
            }
        }

        return $this;
    }

    public function getPagine(): ?int
    {
        return $this->pagine;
    }

    public function setPagine(?int $pagine): static
    {
        $this->pagine = $pagine;

        return $this;
    }
}

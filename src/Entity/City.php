<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class City | file City.php
 *
 * In this class, we create the entity CITY
 *
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez saisir une ville")
     * @Assert\Length(min=1, max=255, 
     *      minMessage="Le nom de la ville doit faire plus de {{ limit }} caractères", 
     *      maxMessage="Le nom de la ville ne peut pas faire plus de {{ limit }} caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Veuillez saisir un code postal")
     * @Assert\Positive
     * @Assert\Regex("/^(?:[0-8]\d|9[0-8])\d{3}$/", message="Ce code postal n'est pas valide")
     */
    private $postalCode;

    /**
     * @ORM\OneToMany(targetEntity=RentalSpace::class, mappedBy="city")
     */
    private $rentalSpaces;

    public function __construct()
    {
        $this->rentalSpaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return Collection|RentalSpace[]
     */
    public function getRentalSpaces(): Collection
    {
        return $this->rentalSpaces;
    }

    public function addRentalSpace(RentalSpace $rentalSpace): self
    {
        if (!$this->rentalSpaces->contains($rentalSpace)) {
            $this->rentalSpaces[] = $rentalSpace;
            $rentalSpace->setCity($this);
        }

        return $this;
    }

    public function removeRentalSpace(RentalSpace $rentalSpace): self
    {
        if ($this->rentalSpaces->removeElement($rentalSpace)) {
            // set the owning side to null (unless already changed)
            if ($rentalSpace->getCity() === $this) {
                $rentalSpace->setCity(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}

<?php

namespace App\Entity;

use App\Repository\RentalSpaceTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class RentalSpaceType | file RentalSpaceType.php
 *
 * In this class, we create the entity RentalSpaceType
 *
 * @ORM\Entity(repositoryClass=RentalSpaceTypeRepository::class)
 */
class RentalSpaceType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez saisir un type d'espace locatif")
     * @Assert\Length(min=3, max=255, 
     *      minMessage="Le type doit faire plus de {{ limit }} caractères", 
     *      maxMessage="Le type ne peut pas faire plus de {{ limit }} caractères")
     */
    private $designation;

    /**
     * @ORM\OneToMany(targetEntity=RentalSpace::class, mappedBy="rentalSpaceType")
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

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

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
            $rentalSpace->setRentalSpaceType($this);
        }

        return $this;
    }

    public function removeRentalSpace(RentalSpace $rentalSpace): self
    {
        if ($this->rentalSpaces->removeElement($rentalSpace)) {
            // set the owning side to null (unless already changed)
            if ($rentalSpace->getRentalSpaceType() === $this) {
                $rentalSpace->setRentalSpaceType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->designation;
    }
}

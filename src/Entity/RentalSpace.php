<?php

namespace App\Entity;

use App\Repository\RentalSpaceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class RentalSpace | file RentalSpace.php
 *
 * In this class, we create the entity RentalSpace
 *
 * @ORM\Entity(repositoryClass=RentalSpaceRepository::class)
 */
class RentalSpace
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minimumDurationRule;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maximumDurationRule;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dayPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weekPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weekendPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $monthPrice;

    /**
     * @ORM\ManyToOne(targetEntity=RentalSpaceType::class, inversedBy="rentalSpaces")
     */
    private $rentalSpaceType;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="rentalSpaces")
     */
    private $city;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getMinimumDurationRule(): ?int
    {
        return $this->minimumDurationRule;
    }

    public function setMinimumDurationRule(?int $minimumDurationRule): self
    {
        $this->minimumDurationRule = $minimumDurationRule;

        return $this;
    }

    public function getMaximumDurationRule(): ?int
    {
        return $this->maximumDurationRule;
    }

    public function setMaximumDurationRule(?int $maximumDurationRule): self
    {
        $this->maximumDurationRule = $maximumDurationRule;

        return $this;
    }

    public function getDayPrice(): ?int
    {
        return $this->dayPrice;
    }

    public function setDayPrice(?int $dayPrice): self
    {
        $this->dayPrice = $dayPrice;

        return $this;
    }

    public function getWeekPrice(): ?int
    {
        return $this->weekPrice;
    }

    public function setWeekPrice(?int $weekPrice): self
    {
        $this->weekPrice = $weekPrice;

        return $this;
    }

    public function getWeekendPrice(): ?int
    {
        return $this->weekendPrice;
    }

    public function setWeekendPrice(?int $weekendPrice): self
    {
        $this->weekendPrice = $weekendPrice;

        return $this;
    }

    public function getMonthPrice(): ?int
    {
        return $this->monthPrice;
    }

    public function setMonthPrice(?int $monthPrice): self
    {
        $this->monthPrice = $monthPrice;

        return $this;
    }

    public function getRentalSpaceType(): ?RentalSpaceType
    {
        return $this->rentalSpaceType;
    }

    public function setRentalSpaceType(?RentalSpaceType $rentalSpaceType): self
    {
        $this->rentalSpaceType = $rentalSpaceType;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
}

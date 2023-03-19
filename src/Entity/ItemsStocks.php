<?php

namespace App\Entity;

use App\Repository\ItemsStocksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemsStocksRepository::class)]
class ItemsStocks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Item::class)]
    private Collection $item;

    #[ORM\ManyToMany(targetEntity: Stock::class)]
    private Collection $stock;

    #[ORM\Column]
    private ?bool $is_actually = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_date = null;

    public function __construct()
    {
        $this->item = new ArrayCollection();
        $this->stock = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(Item $item): self
    {
        if (!$this->item->contains($item)) {
            $this->item->add($item);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        $this->item->removeElement($item);

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStock(): Collection
    {
        return $this->stock;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stock->contains($stock)) {
            $this->stock->add($stock);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        $this->stock->removeElement($stock);

        return $this;
    }

    public function isIsActually(): ?bool
    {
        return $this->is_actually;
    }

    public function setIsActually(bool $is_actually): self
    {
        $this->is_actually = $is_actually;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->created_date;
    }

    public function setCreatedDate(\DateTimeInterface $created_date): self
    {
        $this->created_date = $created_date;

        return $this;
    }
}

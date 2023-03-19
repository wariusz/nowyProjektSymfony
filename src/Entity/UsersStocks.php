<?php

namespace App\Entity;

use App\Repository\UsersStocksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersStocksRepository::class)]
class UsersStocks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: User::class)]
    private Collection $user;

    #[ORM\ManyToMany(targetEntity: Stock::class)]
    private Collection $Stock;

    #[ORM\Column]
    private ?bool $is_actually = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_date = null;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->Stock = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStock(): Collection
    {
        return $this->Stock;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->Stock->contains($stock)) {
            $this->Stock->add($stock);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        $this->Stock->removeElement($stock);

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

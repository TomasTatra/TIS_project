<?php

namespace App\Entity;

use App\Repository\HistoryCarRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoryCarRepository::class)]
class HistoryCar
{
    public const STATUS_SCANNED = 1;
    public const STATUS_FREE = 0;
    public const STATUS_IS_DAMAGED = 1;
    public const STATUS_IS_NEW = 0;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $vis = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $note = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?HistoryCarGroup $historyCarGroup = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $isDamaged = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $replacedCar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVis(): ?string
    {
        return $this->vis;
    }

    public function setVis(string $vis): static
    {
        $this->vis = $vis;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getIsDamaged(): ?int
    {
        return $this->isDamaged;
    }

    public function setIsDamaged(int $isDamaged): static
    {
        $this->isDamaged = $isDamaged;

        return $this;
    }
    public function getHistoryCarGroup(): ?HistoryCarGroup
    {
        return $this->historyCarGroup;
    }

    public function setHistoryCarGroup(?HistoryCarGroup $historyCarGroup): static
    {
        $this->historyCarGroup = $historyCarGroup;

        return $this;
    }
    public static function translateIsDamaged(?int $cons): string
    {
        return match ($cons) {
            self::STATUS_IS_DAMAGED => 'Poškodené',
            self::STATUS_IS_NEW => 'Nepoškodené',
            default => 'nenastavené',
        };
    }

    public static function translateStatus(?int $cons): string
    {
        return match ($cons) {
            self::STATUS_FREE => 'Voľné',
            self::STATUS_SCANNED => 'Naskenované',
            default => 'nenastavené',
        };
    }

    public function getReplacedCar(): ?string
    {
        return $this->replacedCar;
    }

    public function setReplacedCar(?string $replacedCar): static
    {
        $this->replacedCar = $replacedCar;

        return $this;
    }
}

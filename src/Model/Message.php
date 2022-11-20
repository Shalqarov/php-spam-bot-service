<?php

namespace App\Model;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('messages')]
class Message
{
    #[Id]
    #[Column, GeneratedValue]
    private ?int $id;

    #[Column(type: Types::STRING)]
    private ?string $message;

    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->message = $data['message'] ?? null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): string
    {
        return $this->message ?? '';
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'message' => $this->getMessage(),
        ];
    }
}
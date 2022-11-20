<?php

namespace App\Services;

use App\Model\Message;
use Doctrine\ORM\EntityManager;

class Service implements InterfaceService
{
    private EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function all(): array
    {
        return $this->em->createQueryBuilder()
            ->select('m')
            ->from(Message::class, 'm')
            ->getQuery()
            ->getResult();
    }

    public function setItem(array $data): Message
    {
        $message = new Message($data);
        $this->em->persist($message);
        $this->em->flush();
        return $message;
    }
}
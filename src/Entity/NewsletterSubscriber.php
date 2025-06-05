<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class NewsletterSubscriber
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $email;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $subscribedAt;

    public function getId(): ?int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function getSubscribedAt(): \DateTimeInterface {
        return $this->subscribedAt;
    }

    public function setSubscribedAt(\DateTimeInterface $date): self {
        $this->subscribedAt = $date;
        return $this;
    }
}

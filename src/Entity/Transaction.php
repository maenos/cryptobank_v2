<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $crypto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $method;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $giveM;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $receiveM;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $txid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;



    /**
     * @ORM\Column(type="boolean")
     */
    private $Ispaid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCrypto(): ?string
    {
        return $this->crypto;
    }

    public function setCrypto(string $crypto): self
    {
        $this->crypto = $crypto;

        return $this;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getGiveM(): ?string
    {
        return $this->giveM;
    }

    public function setGiveM(string $giveM): self
    {
        $this->giveM = $giveM;

        return $this;
    }

    public function getReceiveM(): ?string
    {
        return $this->receiveM;
    }

    public function setReceiveM(string $receiveM): self
    {
        $this->receiveM = $receiveM;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTxid(): ?string
    {
        return $this->txid;
    }

    public function setTxid(string $txid): self
    {
        $this->txid = $txid;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }



    public function getIspaid(): ?bool
    {
        return $this->Ispaid;
    }

    public function setIspaid(bool $Ispaid): self
    {
        $this->Ispaid = $Ispaid;

        return $this;
    }
}

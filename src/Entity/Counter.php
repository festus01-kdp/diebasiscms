<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CounterRepository")
 */
class Counter
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(length=100, nullable=true)
     */
    private string $page;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $zaehler;

    /**
     * @ORM\Column(type="datetime")
     */
    protected DateTime $datetime;

    /** @ORM\Column(type="string", length=100)
     *
     */
    protected string $host;

    /** @ORM\Column(type="string", length=100) */
    protected string $clientIp;

    /**
     * @return string
     */
    public function getClientIp(): string
    {
        return $this->clientIp;
    }

    /**
     * @param string $clientIp
     */
    public function setClientIp(string $clientIp): self
    {
        $this->clientIp = $clientIp;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDatetime(): DateTime
    {
        return $this->datetime;
    }

    /**
     * @param DateTime $datetime
     */
    public function setDatetime(DateTime $datetime): self
    {
        $this->datetime = $datetime;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): self
    {
        $this->host = $host;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getPage(): string
    {
        return $this->page;
    }

    public function setPage(string $page): self
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getZaehler(): int
    {
        return $this->zaehler;
    }

    public function setZaehler(int $zaehler): self
    {
        $this->zaehler = $zaehler;
        return $this;
    }

}




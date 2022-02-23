<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Config\TwigExtra\StringConfig;

/**
 * Entity to manage contact form
 * @package App\Entity
 * @ORM\Entity()
 */
class ContactForm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=50)
     */
    private string $firstname;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=50)
     */
    private string $lastname;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=50)
     */
    private string $mail;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=500)
     */
    private string $message;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="contacts")
     */
    private ?Department $department;

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return ContactForm
     */
    public function setFirstname(string $firstname): ContactForm
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return ContactForm
     */
    public function setLastname(string $lastname): ContactForm
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     * @return ContactForm
     */
    public function setMail(string $mail): ContactForm
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return ContactForm
     */
    public function setMessage(string $message): ContactForm
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return Department|null
     */
    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    /**
     * @param Department|null $department
     */
    public function setDepartment(?Department $department): void
    {
        $this->department = $department;
    }

    /**
     * Entity to string use for mail
     */
    public function toString(): String
    {
        return 'Le contact ' . $this->getFirstname() . ' ' . $this->getLastname() . ' a envoyé un mail de contact.
         Son adresse mail : ' . $this->getMail() . '. Son message : ' . $this->getMessage();
    }
}
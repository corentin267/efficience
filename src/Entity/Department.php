<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entity to manage department
 * @package App\Entity
 * @ORM\Entity(repositoryClass=DepartmentRepository::class)
 */
class Department
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private string $label;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private string $mailResponsable;

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return Department
     */
    public function setLabel(string $label): Department
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getMailResponsable(): string
    {
        return $this->mailResponsable;
    }

    /**
     * @param string $mailResponsable
     * @return Department
     */
    public function setMailResponsable(string $mailResponsable): Department
    {
        $this->mailResponsable = $mailResponsable;
        return $this;
    }

    /**
     * Format array of Department to use it on form
     */
    public static function formatForForm(array $array): array
    {
        $result = [];

        foreach ($array as $value) {
            $label = $value['label'];
            $result[$label] = $value['id'];
        }

        return $result;
    }
}
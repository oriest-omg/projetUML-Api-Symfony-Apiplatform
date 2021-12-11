<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EtudiantRepository;
use App\Controller\PostImageController;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 * @Vich\Uploadable()
 */
#[ApiResource(

)]
    //     'image'=>[
    //         'method'=>'POST',
    //         'path'=>'/post/etudiants',
    //         'controller'=>PostImageController::class,        
    //         'deserialize'=>false
    //     ]
    // ]
class Etudiant
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    public ?string $contentUrl = null;

    /**
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="photo")
     */
    public ?File $file = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bacBenef;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statutBenef;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    // public function getFile(): ?File
    // {
    //     return $this->file;
    // }
    // /**
    //  * @return Etudiant
    //  */
    // public function setFile(?File $file): Etudiant
    // {
    //     $this->file = $file;

    //     return $this;
    // }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBacBenef(): ?string
    {
        return $this->bacBenef;
    }

    public function setBacBenef(?string $bacBenef): self
    {
        $this->bacBenef = $bacBenef;

        return $this;
    }

    public function getStatutBenef(): ?string
    {
        return $this->statutBenef;
    }

    public function setStatutBenef(?string $statutBenef): self
    {
        $this->statutBenef = $statutBenef;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseRepository")
 */
class Entreprise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom de l'entreprise ne peut pas être vide")
	 * @Assert\Length(
	 * min=4,
	 * minMessage="Le nom de l'entreprise doit faire au moins {{ limit }} caractères"
	 * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
	 * @Assert\NotBlank(message="L'activité ne peut pas être vide")
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="L'adresse ne peut pas être vide")
	 * @Assert\Regex(pattern="#^[1-9][0-9]{0,2}#", message="Le numero de rue semble incorrect")
	 * @Assert\Regex(pattern="#[allée, voie, rue]#", message="Le type de route/voie semble incorrect")
	 * @Assert\Regex(pattern="#[0-9]{5}#", message="Le code postal semble incorrect")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
	 * @Assert\Url(message="Ce n'est pas un URL valide")
     */
    private $lienSiteWeb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stage", mappedBy="entreprise")
     */
    private $stages;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): self
    {
        $this->activite = $activite;

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

    public function getLienSiteWeb(): ?string
    {
        return $this->lienSiteWeb;
    }

    public function setLienSiteWeb(?string $lienSiteWeb): self
    {
        $this->lienSiteWeb = $lienSiteWeb;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setEntreprise($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): self
    {
        if ($this->stages->contains($stage)) {
            $this->stages->removeElement($stage);
            // set the owning side to null (unless already changed)
            if ($stage->getEntreprise() === $this) {
                $stage->setEntreprise(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return (string) $this->getNom();
    }
}

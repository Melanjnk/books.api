<?php


namespace App\Entity;


use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="book_translation", indexes={
 *          @ORM\Index(name="book_name_idx", columns={"name"}),
 *          @ORM\Index(name="book_search_idx", columns={"translatable_id", "name"}),
 *          @ORM\Index(name="book_view_idx", columns={"locale", "translatable_id", "name"})
 *     })
 * @ORM\Entity
 */
class BookTranslation implements TranslationInterface
{
    use TranslationTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="The book name could not be blank")
     * @Assert\Type(type="string", message="The book name {{ value }} is not a valid {{ type }}.")
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="integer", name="translatable_id")
     */
    private ?int $translatableId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getTranslatableId(): ?int
    {
        return $this->translatableId;
    }

    public function setTranslatableId(?int $translatableId): void
    {
        $this->translatableId = $translatableId;
    }


}
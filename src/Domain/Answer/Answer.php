<?php

declare(strict_types=1);

namespace App\Domain\Answer;

use App\Domain\User\Model\User;
use App\Domain\Question\Model\Question;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An answer offered to a question; perhaps correct, perhaps opinionated or wrong.
 *
 * @see http://schema.org/Answer Documentation on Schema.org
 *
 * @ORM\Entity
 */
class Answer
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @Assert\Uuid
     */
    protected $id;

    /**
     * @var int|null the number of downvotes this question, answer or comment has received from the community
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $downvoteCount;

    /**
     * @var Question|null the parent of a question, answer or item in general
     *
     * @ORM\ManyToOne(targetEntity="App\Domain\Question\Model\Question")
     * @ORM\JoinColumn(name="parent_item", referencedColumnName="uuid", nullable=false)
     */
    protected $parentItem;

    /**
     * @var int|null the number of upvotes this question, answer or comment has received from the community
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $upvoteCount;

    /**
     * @var string|null the textual content of this CreativeWork
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $text;

    /**
     * @var \DateTimeInterface|null the date on which the CreativeWork was created or the item was added to a DataFeed
     *
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     */
    protected $dateCreated;

    /**
     * @var User|null The author of this content or rating. Please note that author is special in that HTML 5 provides a special mechanism for indicating authorship via the rel tag. That is equivalent to this and may be used interchangeably.
     *
     * @ORM\ManyToOne(targetEntity="App\Domain\User\Model\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="uuid", nullable=false)
     */
    protected $author;

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setDownvoteCount(?int $downvoteCount): self
    {
        $this->downvoteCount = $downvoteCount;

        return $this;
    }

    public function getDownvoteCount(): ?int
    {
        return $this->downvoteCount;
    }

    public function setParentItem(?Question $parentItem): self
    {
        $this->parentItem = $parentItem;

        return $this;
    }

    public function getParentItem(): ?Question
    {
        return $this->parentItem;
    }

    public function setUpvoteCount(?int $upvoteCount): self
    {
        $this->upvoteCount = $upvoteCount;

        return $this;
    }

    public function getUpvoteCount(): ?int
    {
        return $this->upvoteCount;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setDateCreated(?\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }
}

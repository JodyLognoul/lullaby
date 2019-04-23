<?php

declare(strict_types=1);

namespace App\Domain\Question\Model;

use App\Domain\Answer\Answer;
use App\Domain\Question\ValueObject\QuestionId;
use App\Domain\Shared\ValueObject\AggregateRoot;
use App\Domain\User\Model\User;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A specific question - e.g. from a user seeking answers online, or collected in a Frequently Asked Questions (FAQ) document.
 *
 * @see http://schema.org/Question Documentation on Schema.org
 *
 * @ORM\Entity(repositoryClass="App\Infrastructure\Question\Repository\QuestionRepository")
 */
class Question extends AggregateRoot
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="questionId", nullable=false)
     * @var QuestionId
     */
    protected $uuid;

    /**
     * @var string|null the name of the item
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $name;

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

    /**
     * @var int|null the number of answers this question has received
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $answerCount;

    /**
     * @var Answer|null The answer that has been accepted as best, typically on a Question/Answer site. Sites vary in their selection mechanisms, e.g. drawing on community opinion and/or the view of the Question author.
     *
     * @ORM\OneToOne(targetEntity="App\Domain\Answer\Answer")
     */
    protected $acceptedAnswer;

    /**
     * @var Answer|null An answer (possibly one of several, possibly incorrect) to a Question, e.g. on a Question/Answer site.
     *
     * @ORM\ManyToOne(targetEntity="App\Domain\Answer\Answer")
     */
    protected $suggestedAnswer;

    public function __construct(QuestionId $questionId, User $author, string $name, string $text)
    {
        parent::__construct($questionId);

        $this->author = $author;
        $this->name = $name;
        $this->text = $text;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getUpvoteCount(): ?int
    {
        return $this->upvoteCount;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getDateCreated(): ?DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function getAnswerCount(): ?int
    {
        return $this->answerCount;
    }

    public function getAcceptedAnswer(): ?Answer
    {
        return $this->acceptedAnswer;
    }

    public function getSuggestedAnswer(): ?Answer
    {
        return $this->suggestedAnswer;
    }
}

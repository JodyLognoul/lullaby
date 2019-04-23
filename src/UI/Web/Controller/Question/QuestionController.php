<?php

namespace App\UI\Web\Controller\Question;

use App\Application\Command\Question\AskQuestion\AskQuestionCommand;
use App\Application\Query\Question\GetById\GetQuestionQuery;
use App\Application\Query\Question\GetCollection\GetCollectionQuery;
use App\Domain\Question\Repository\QuestionRepositoryInterface;
use App\Infrastructure\Share\Bus\CommandBus;
use App\Infrastructure\Share\Bus\QueryBus;
use App\UI\Web\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends Controller
{
    /**
     * @var QuestionRepositoryInterface
     */
    private $repository;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus, QuestionRepositoryInterface $repository)
    {
        parent::__construct($commandBus, $queryBus);
        $this->repository = $repository;
    }

    /**
     * @Route("/", name="app_homepage")
     * @Route("/questions", name="web_questions_cget")
     */
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        $collection = $this->queryBus->dispatch(new GetCollectionQuery($page, $limit));

        return $this->render('question/index.html.twig', ['collection' => $collection]);
    }

    /**
     * @Route("/questions/{uuid}", name="web_questions_show")
     */
    public function show(string $uuid)
    {
        $question = $this->queryBus->dispatch(new GetQuestionQuery($uuid));

        return $this->render('question/show.html.twig', ['question' => $question]);
    }


    /**
     * @Route("/ask", name="web_question_ask")
     */
    public function ask(Request $request)
    {
        $askCommand = new AskQuestionCommand();

        $form = $this->createFormBuilder($askCommand)
            ->add('name', TextType::class)
            ->add('text', TextareaType::class)
            ->add('save', SubmitType::class, ['label' => 'SUBMIT'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $command = $form->getData();
            $command->id = $this->repository->nextIdentity();

            $this->commandBus->dispatch($command);

            return $this->redirectToRoute('web_questions_show', ['uuid' => $command->id]);
        }

        return $this->render('question/ask.html.twig', ['form' => $form->createView()]);
    }


}

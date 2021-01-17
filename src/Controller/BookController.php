<?php

namespace App\Controller;

use App\Entity\Book;
use App\Factory\BookFactory;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class BookController extends AbstractController
{
    /**
     * @Route("/books", name="books", methods={"GET"} )
     */
    public function books()
    {
        $author = new class {
            public int $id = 1;
            public string $name = 'Author 1';
        };
        $book = new class {
            public int $id = 1;
            public string $name = 'Book 1';
            public array $author = [];

            public function setAuthor($author): void
            {
                $this->author[] = $author;
            }

        };
        $book->setAuthor($author);
        $books = [$book];
        return new JsonResponse($books);
    }

    /**
     * @Route ("/books/search", name="books_search", methods={"GET"})
     */
    public function search(Request $request, BookRepository $bookRepository)
    {
        $bookName = $request->get('q');
        $books = $bookRepository->getBooksByName($bookName);
        if (empty($books)) {
            throw new NotFoundHttpException();
        }
        return new JsonResponse($books);
    }

    /**
     * @Route("/books/create", name="books", methods={"POST"})
     */
    public function create(EntityManagerInterface $entityManager, Request $request, BookFactory $bookFactory, AuthorRepository $authorRepository)
    {
        $book = $bookFactory->createBook($request, $authorRepository);

        $entityManager->persist($book);
        $entityManager->flush();

        return new JsonResponse($book);
    }

    /**
     * @Route("/{_locale}/book/{id}",
     *     name="book_view",
     *     requirements={
     *          "_locale": "%app_locales%",
     *          "id":"\d+"
     *     },
     *     methods={"GET"})
     */
    public function view(Book $book)
    {
        return new JsonResponse($book);
    }
}
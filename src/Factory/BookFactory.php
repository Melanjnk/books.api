<?php


namespace App\Factory;


use App\Entity\Book;
use App\Entity\BookTranslation;
use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class BookFactory
{
    /** @var array */
    private $locales;

    /** @var string */
    private $defaultLocale;

    public function __construct(string $locales, string $defaultLocale)
    {
        $this->locales = explode('|', trim($locales));
        $this->defaultLocale = $defaultLocale;
    }

    private function validateRequest(array $data): bool
    {
        if (!isset($data['name']) || !$data['name']) {
            throw new \InvalidArgumentException('Missing require field the book name');
        }

        if (!isset($data['author']) || !$data['author']) {
            throw new \InvalidArgumentException('Missing require author[]');
        }

        if (empty($data['author']) || !is_array($data['author'])) {
            throw new \InvalidArgumentException('The Author must be array');
        }

        if (isset($data['_locale']) && !in_array($data['_locale'], $this->locales)) {
            throw new \InvalidArgumentException('Set unavailable _locale');
        }

        return true;
    }

    public function createBook(Request $request, AuthorRepository $authorRepository): ?Book
    {
        $data = (new JsonEncoder)->decode($request->getContent(), JsonEncoder::FORMAT);
        if ($this->validateRequest($data)) {
            $book = new Book();
            $bookTranslation = new BookTranslation();
            $bookTranslation->setLocale($data['_locale'] ?? $this->defaultLocale);
            $bookTranslation->setName($data['name']);
            $book->setTranslations([$bookTranslation]);

            foreach ($data['author'] as $authorId) {
                $author = $authorRepository->find($authorId);
                if (!$author) {
                    throw new NotFoundHttpException(sprintf('No founded author with id %s', $authorId));
                }
                $book->addAuthor($author);
            }

            return $book;
        }
        return null;
    }
}
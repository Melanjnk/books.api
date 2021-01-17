<?php

namespace Tests\Factory;


use App\Entity\Author;
use App\Factory\BookFactory;
use App\Repository\AuthorRepository;
use PHPUnit\Framework\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class BookFactoryTest extends TestCase
{
    /**
     * @dataProvider bookFactoryProvider
     */
    public function testCreateBook($requestData, $author, $exception = null)
    {
        $bookFactory = new BookFactory();
        $request = $this->createMock(Request::class);

        if($exception) {
            $this->expectException($exception);
        }
        $request->expects($this->once())
            ->method('getContent')
            ->willReturn(json_encode($requestData));

        $authorRepo = $this->createMock(AuthorRepository::class);
        $authorRepo->expects($this->any())
            ->method('find')
            ->willReturnCallback(function ($id) use ($author) {
                return $author->setName('mocked author '.$id);
            });

        $book = $bookFactory->createBook($request, $authorRepo);
        $book->getAuthor()[0]->getName();

        $this->assertSame($book->getAuthor()[0]->getName(), $author->getName());
    }

    public function bookFactoryProvider(): array
    {
        return [
            'success create book single author' => [
                [
                    'name' => 'book from unitTest',
                    'author' => [555]
                ],
                (new Author())->setName('mocked author 555')
            ],
            'success create book with a few authors' => [
                [
                    'name' => 'book from unitTest',
                    'author' => [555, 333]
                ],
                (new Author())->setName('mocked author 555')
            ],
            'no book name passed' => [
                [
                    'author' => [555, 333]
                ],
                (new Author())->setName('mocked author 555'),
                \InvalidArgumentException::class
            ],
            'empty body' => [
                [],
                (new Author())->setName('mocked author 555'),
                \InvalidArgumentException::class
            ],
            'no book author passed' => [
                [
                    'name' => 'book from unitTest',
                ],
                (new Author())->setName('mocked author 555'),
                \InvalidArgumentException::class
            ],
        ];
    }
}
<?php


namespace App\Factory;


use App\Entity\Author;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class AuthorFactory
{

    public function createAuthor(Request $request): ?Author
    {
        $data = (new JsonEncoder)->decode($request->getContent(), JsonEncoder::FORMAT);
        if ($this->validateRequest($data)) {
            $author = new Author();
            $author->setName($data['name']);

            return $author;
        }
        return null;
    }

    private function validateRequest($data): bool
    {
        if (!isset($data['name']) || !$data['name']) {
            throw new \InvalidArgumentException('Missing require field the book name');
        }
        return true;
    }
}
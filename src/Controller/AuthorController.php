<?php


namespace App\Controller;


use App\Factory\AuthorFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("/authors/create", name="create_author", methods={"POST"});
     */
    public function createAuthor(EntityManagerInterface $entityManager, Request $request, AuthorFactory $authorFactory): JsonResponse
    {
        $author = $authorFactory->createAuthor($request);

        $entityManager->persist($author);
        $entityManager->flush();

        return new JsonResponse($author);
    }
}
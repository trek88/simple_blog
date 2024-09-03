<?php
// src/Controller/BlogController.php
namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    public function listblogentries(Connection $connection): Response
    {
        $ListOfBlogEntries = $this->getblogentries(5, $connection);
        
        return $this->render('blog_posts/blog_posts.html.twig', [
            'blogEntries' => $ListOfBlogEntries,
        ]);
    }

    private function getblogentries($NumberOfEntries, Connection $connection)
    {
        
        $blogEntries = $connection->fetchAllAssociative('SELECT * FROM blog_posts');

        //print_r($blogEntries);
        //die();

        if (count($blogEntries) < $NumberOfEntries) {
            $NumberOfEntries = count($blogEntries);
        }
        
        $i = 0;

        foreach  ($blogEntries as $blogEntry) {
            $ListOfBlogEntries[$i]["post_content"] = $blogEntry["post_content"];
            $ListOfBlogEntries[$i]["post_author"] = $blogEntry["post_author"];
            $i++;
            if ($i == $NumberOfEntries) {
                break;
            }
        } 
        
        return $ListOfBlogEntries;
    }

}
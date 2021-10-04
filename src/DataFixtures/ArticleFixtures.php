<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i < 4; $i++) {
            $category = new Category();
            $category
                ->setTitle("Titre de la catégorie n°$i")
                ->setDescription("Description de la catégorie n°$i");

            $manager->persist($category);

            for ($j = 1; $j <= 10; $j++) {
                $article = new Article();
                $article
                    ->setTitle("Titre de l'article n°$j")
                    ->setContent("Contenu de l'article n°$j")
                    ->setImage("https://picsum.photos/350/150")
                    ->setCreatedAt(new \DateTime())
                    ->setCategory($category);

                $manager->persist($article);

                for ($k = 1; $k < 4; $k++) {
                    $comment = new Comment();

                    $comment
                        ->setAuthor("Auteur n° $k")
                        ->setContent("Contenu de l'auteur n° $k")
                        ->setCreatedAt(new \DateTime())
                        ->setArticle($article);

                    $manager->persist($comment);
                }
            }
        }

        $manager->flush();
    }
}

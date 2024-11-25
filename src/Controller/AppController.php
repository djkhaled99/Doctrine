<?php

namespace App\Controller;

use App\Entity\Main\Address;
use App\Entity\Main\Post;
use App\Entity\Main\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return new Response("Welcome to my page");
    }

    /**
     * @Route("/newUser/{name}", name="new_user")
     * @return Response
     */
    public function newUser(string $name, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $user->setName($name)
            ->setEmail('test@tesrt.com')
            ->setPhone('+49049405')
            ->setAddress('43545 Heidelberg')
            ->setActive(true);

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Welcome to doctrine!');
    }

    /**
     * @Route("/findUser/{name}", name="find_user")
     * @return Response
     */
    public function findUserByName(string $name, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(User::class);

        $user = $repository->findOneBy(['name' => $name]);

        if ($user) {
            return new Response("User found: " . $user->getName());
        } else {
            return new Response("User not found");
        }
    }

    /**
     * @Route("/addUserAndPost/{name}", name="add_user_and_post")
     */
    public function addUserAndPost(string $name, EntityManagerInterface $entityManager): Response
    {
        // إنشاء كائن جديد للمستخدم
        $user = new User();
        $user->setEmail('testefs@yahoo.com')
            ->setName($name)
            ->setActive(true)
            ->setAddress('40595, Giza')
            ->setPhone('109304')
            ->setCreatedAt(new \DateTime())
            ->setDateOfBirth(new \DateTime())
            ->setPast('LEAD')
            ->setTitle('CEO');


        $post = new Post();
        $post->setLikes(100)
            ->setPhoto('https://google.comdkd/png')
            ->setCreatedAt(new \DateTime());
        $post2 = new Post();
        $post2->setLikes(10430)
            ->setPhoto('https://fb.com/png')
            ->setCreatedAt(new \DateTime());
        $post2->setUser($user);


        $post->setUser($user);

        $entityManager->persist($user);
        $entityManager->persist($post);
        $entityManager->persist($post2);
        $entityManager->flush();

        return new Response('User and Post have been added successfully!');
    }

    /**
     * @Route("/post/{name}", name="post_show")
     */
    public function showPost(string $name, EntityManagerInterface $entityManager): Response
    {
        // البحث عن المستخدم في قاعدة البيانات بناءً على الاسم
        $repository = $entityManager->getRepository(User::class);
        $userEntity = $repository->findOneBy(['name' => $name]);

        if (!$userEntity) {
            return new Response("User not found");
        }

        // بيانات المستخدم والمنشور
        $user = [
            'name' => $userEntity->getName(),
            'location' => 'Heidelberg, Germany', // يمكنك تخصيص الموقع إذا كان مخزنًا في قاعدة البيانات
            'profilePicture' => '/images/1.jpg', // تأكد من وجود الصورة في `public/images`
            'postedAt' => '10 hours ago',
        ];

        $post = [
            'image' => '/images/2.jpg', // تأكد من وجود الصورة في `public/images`
            'likes' => 242,
            'comments' => 12,
        ];

        return $this->render('post.html.twig', [
            'user' => $user,
            'post' => $post,
        ]);
    }

    /**
     * @Route("/addUserAndAddress/{name}", name="new_user_address")
     */
    public function addUserAndAddress(string $name, EntityManagerInterface $entityManager): Response
    {
        // إنشاء كائن جديد للمستخدم
        $user = new User();
        $user->setEmail('test2022@yahoo.com')
            ->setName($name)
            ->setActive(true)
            ->setPhone('109304')
            ->setCreatedAt(new \DateTime())
            ->setDateOfBirth(new \DateTime())
            ->setPast('LEAD')
            ->setTitle('CEO');

        $address = new Address();
        $address->setUser($user)
            ->setCity('Giza')
            ->setStreet('40595')
            ->setNumber(1);


        $post = new Post();
        $post->setLikes(100)
            ->setPhoto('https://google.comdkd/png')
            ->setCreatedAt(new \DateTime());


        $post->setUser($user);

        $entityManager->persist($user);
        $entityManager->persist($address);

        $entityManager->flush();

        return new Response('welcome to doctrine one to one relationship');
    }

}

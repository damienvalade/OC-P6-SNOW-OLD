<?php


namespace App\Controller;


use App\Entity\Tricks;
use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class TricksController extends AbstractController
{

    /**
     * @Route("/showtricks/{tricks}", name="app_showtricks")
     * @param TricksRepository $tricksRepo
     * @param $tricks
     * @return Response
     */
    public function profile(TricksRepository $tricksRepo, $tricks): Response
    {
        $data = $tricksRepo->findOneBy(array('name' => $tricks));

        return $this->render('PublicSide/tricks/showtricks.html.twig', ['tricks' => $data]);
    }

    /**
     * @Route("/trickslist", name="app_trickslist")
     * @param TricksRepository $trick
     * @return Response
     */
    public function tricksList(TricksRepository $trick): Response
    {
        $trick = $trick->findAll();

        return $this->render('PublicSide/tricks/trickslist.html.twig', ['tricks' => $trick]);

    }

    /**
     * @Route("/edittricks/{id_tricks}", name="app_edittricks")
     * @param TricksRepository $tricksRepo
     * @param $id_tricks
     * @return Response
     */
    public function edit(TricksRepository $tricksRepo, $id_tricks): Response
    {
        $data = $tricksRepo->findOneBy(array('id' => $id_tricks));

        return $this->render('PublicSide/tricks/edittricks.html.twig', ['tricks' => $data]);
    }

    /**
     * @Route("/deletetricks", name="app_deletetricks")
     * @return Response
     */
    public function delete(): Response
    {

        $repository = $this->getDoctrine()->getRepository(Tricks::class);
        $result = $repository->findOneBy(array('id' => $_POST['delete']));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($result);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');

    }

}
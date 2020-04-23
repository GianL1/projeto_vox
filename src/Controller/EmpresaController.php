<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Form\EmpresaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/empresa", name="empresa_")
 */
class EmpresaController extends AbstractController
{


    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $empresas = $this->getDoctrine()->getRepository(Empresa::class)->findAll();

        return $this->render('empresa/index.html.twig', [
            'controller_name' => 'EmpresaController',
            'empresas' => $empresas
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function createEmpresa(Request $request)
    {
        $empresa = new Empresa();
        $doctrine = $this->getDoctrine()->getManager();

        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $data = $form->getData();

            $doctrine->persist($data);
            $doctrine->flush();

            return $this->redirectToRoute('index');

        }


        return $this->render('empresa/create.html.twig',
        [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/show/{id}", name="show", methods={"GET"})
     */
    public function showEmpresa($id)
    {
        $empresa = $this->getDoctrine()->getRepository(Empresa::class)->find($id);

        return $this->render('empresa/show.html.twig',[
            'empresa' => $empresa
        ]);
    }

    /**
     * @Route("/update/{id}", name="update")
     */
    public function updateEmpresa(Request $request, $id)
    {
        $empresa = $this->getDoctrine()->getRepository(Empresa::class)->find($id);
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $empresa = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
            
            return $this->redirectToRoute('index');
        }

        return $this->render('empresa/update.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteEmpresa($id)
    {
        $empresa = $this->getDoctrine()->getRepository(Empresa::class)->find($id);

        $manager = $this->getDoctrine()->getManager()->remove($empresa);
        $manager->flush();
        return $this->redirectToRoute('index');
    }
}

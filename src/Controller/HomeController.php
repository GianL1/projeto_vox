<?php


namespace App\Controller;



use App\Entity\Empresa;
use App\Entity\Socio;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        //$empresas = $this->getDoctrine()->getRepository(Empresa::class)->findAll();
        //return $this->render('index.html.twig',[
        //    'title' => 'REMAKE DO PROJETO_VOX',
        //    'empresas' => $empresas
        //]);

        $empresa = new Empresa();
        $empresa->setNome('Vox Tecnologia');
        $empresa->setEndereco('Bessa');
        $empresa->setCnpj('123456');

        $socio = new Socio();
        $socio->setNome('Teste');
        $socio->setCpf('1323455');

        $socio2 = new Socio();
        $socio->setNome('Teste2');
        $socio->setCpf('234566');

        $empresa->addSocios($socio);
        $socio->setEmpresa($empresa);

        dump($empresa, $socio);
        die;
    }
}
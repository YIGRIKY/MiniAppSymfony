<?php


namespace App\Controller\Main;


use Doctrine\ORM\Query\Expr\Base;
use Symfony\Component\Routing\Annotation\Route;
class HomeController extends BaseController
{
    /**
     * @Route ("/", name="home")
     */
    public function index(){
        $forRender = parent::renderDefault();
        return $this->render('main/index.html.twig', $forRender);
    }
}
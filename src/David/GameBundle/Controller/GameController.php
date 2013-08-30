<?php

namespace David\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameController extends Controller
{
    public function indexAction()
    {
        $gameList = array(
            array(
                'id' => 1,
                'title' => 'Street Fighter 2',
                'year' => 1992
            ),
            array(
                'id' => 2,
                'title' => 'Rayman',
                'year' => 1996
            ),
            array(
                'id' => 3,
                'title' => 'Metal Gear Solid',
                'year' => 1992
            )
        );
        return $this->render('DavidGameBundle:Default:index.html.twig',
                array('gameList' => $gameList));
    }
}

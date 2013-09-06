<?php

namespace David\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use David\GameBundle\Entity\Game;

class GameController extends Controller
{
    public function indexAction()
    {
        $gameList = $this->getDoctrine()
                           ->getRepository('DavidGameBundle:Game')
                           ->findAll();

        return $this->render('DavidGameBundle:Default:index.html.twig',
                array('gameList' => $gameList));
    }
    
    public function addGameAction(Request $request)
    {
        $game = new Game();
        
        $form = $this->createFormBuilder($game)
                ->add('title', 'text')
                ->add('description', 'text')
                ->add('year', 'date')
                ->add('save', 'submit')
                ->add('saveAndAdd', 'submit')
                ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
                
                $nextAction = $form->get('saveAndAdd')->isClicked()
                        ? 'david_game_add'
                        : 'david_success';
                        
                return $this->redirect($this->generateUrl($nextAction));     
        }
        
        return $this->render('DavidGameBundle:Default:new.html.twig', array(
            'form' =>$form->createView(),
        ));
                
        
    }
    
}

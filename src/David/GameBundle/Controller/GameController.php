<?php

namespace David\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use David\GameBundle\Entity\Game;
use David\GameBundle\Form\Type\GameType;

class GameController extends Controller
{
    public function indexAction()
    {
        $gameList = $this->getDoctrine()
                           ->getRepository('DavidGameBundle:Game')
                           ->findAll();

        return $this->render('DavidGameBundle:Game:index.html.twig',
                array('gameList' => $gameList));
    }
    
    public function addAction(Request $request)
    {
        $game = new Game();
        
        $form = $this->createForm(new GameType(),$game);
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($game);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success','Game has been added successfully');
                      
                $nextAction = $form->get('saveAndAdd')->isClicked()
                        ? 'david_game_add'
                        : 'david_game_detail';
                        
                return $this->redirect($this->generateUrl($nextAction));     
        }
        
        return $this->render('DavidGameBundle:Game:new.html.twig', array(
            'form' =>$form->createView(),
        ));
                
        
    }
    
    public function detailAction($id)
    {      
       
        $em = $this->getDoctrine()->getManager();      
        $game = $em->getRepository('DavidGameBundle:Game')->find($id);
        
        if (!$game) {
            throw $this->createNotFoundException('Unable to found game.');
        }
        
        return $this->render('DavidGameBundle:Game:detail.html.twig', array(
            'game' => $game,
        ));
        
    }
    
    public function deleteAction(Request $request)
    {
       $idGame = $request->get('id');
       
        if(!$idGame) {
            return $this->redirect('david_homepage');
        }
        
        $em = $this->getDoctrine()->getManager();
        $game = $em->find('DavidGameBundle:Game', $idGame);

        
        $em->remove($game);
        $em->flush();
        return $this->redirect($this->generateUrl('david_gamee_index'));
        
    }
    
}

<?php

namespace David\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use David\GameBundle\Entity\Console;

class ConsoleController extends Controller
{
    /**
     * List all Consoles
     * 
     * @return Response A Response instance
     */
    public function indexAction()
    {
        $consoleList = $this->getDoctrine()
                           ->getRepository('DavidGameBundle:Console')
                           ->findAll();

        return $this->render('DavidGameBundle:Console:index.html.twig',
                array('consoleList' => $consoleList));
    }
    
    public function addAction(Request $request)
    {
        $console = new Console();
        
        $form = $this->createFormBuilder($console)
                ->add('title', 'text')
                ->add('description', 'text')
                ->add('save', 'submit')
                ->add('saveAndAdd', 'submit')
                ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
                $em = $this->getDoctrine()->getManager();
                $em->persist($console);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success','Console has been added successfully');
                      
                $nextAction = $form->get('saveAndAdd')->isClicked()
                        ? 'david_console_add'
                        : 'david_homepage';
                        
                return $this->redirect($this->generateUrl($nextAction));     
        }
        
        return $this->render('DavidGameBundle:Console:new.html.twig', array(
            'form' =>$form->createView(),
        ));
                
        
    }
    
    public function detailAction(Request $request)
    {
        $idConsole = $request->get('id');
        

        if(!$idConsole) {
            return $this->redirect('david_homepage');
        }
        
        $em = $this->getDoctrine()->getManager();
        
        $console = $em->find('DavidGameBundle:Console', $idConsole);
        
        return $this->render('DavidGameBundle:Console:detail.html.twig', array(
            'console' => $console,
        ));
        
    }
    
    public function deleteAction(Request $request)
    {
       $idConsole = $request->get('id');
       
        if(!$idConsole) {
            return $this->redirect('david_homepage');
        }
        
        $em = $this->getDoctrine()->getManager();
        $console = $em->find('DavidGameBundle:Console', $idConsole);

        
        $em->remove($console);
        $em->flush();
        return $this->redirect($this->generateUrl('david_console_index'));
        
    }
}

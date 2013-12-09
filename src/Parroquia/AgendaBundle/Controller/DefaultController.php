<?php

namespace Parroquia\AgendaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ParroquiaAgendaBundle:Default:index.html.twig');
    }
    
    public function eventosAction(Request $request)
    {
        $start_unix = $request->get('start');
        $end_unix = $request->get('end');
        
        $start = gmdate("Y-m-d", $start_unix);
        $end = gmdate("Y-m-d", $end_unix);

        $em = $this->getDoctrine()->getManager();
        
        $query = $em->getRepository('ParroquiaAgendaBundle:Evento')->createQueryBuilder('e')
            ->where('e.inicio <= :end')
            ->andWhere('e.termino >= :start')
            ->setParameters(array('start' => $start, 'end' => $end))
            ->getQuery();

        $entities = $query->getResult();        

        $eventos = array();
        
        foreach($entities as $entity)
        {
            $evento = array();
            $evento['id'] = $entity->getId();
            $evento['title'] = $entity->getNombre();
            $evento['start'] = $entity->getInicio()->format('Y-m-d H:i:s');
            $evento['end'] = $entity->getTermino()->format('Y-m-d H:i:s');
            $evento['allDay'] = $entity->getTodoElDia();
            $evento['url'] = $this->generateUrl('evento_edit', array('id' => $entity->getId()));
            if($entity->getLiturgico())
            {
                $evento['color'] = '#13B0C8';
            }
            
            $eventos[] = $evento;
        }
        
        $response = new JsonResponse();
        $response->setData($eventos);
        return $response;
    }
}

<?php

namespace Parroquia\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ParroquiaHomeBundle:Default:index.html.twig');
    }
    
    public function cumpleanosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $emConfig = $em->getConfiguration();
        $emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
        $emConfig->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');
        $emConfig->addCustomDatetimeFunction('DAY', 'DoctrineExtensions\Query\Mysql\Day');
        $emConfig->addCustomDatetimeFunction('DATEADD', 'DoctrineExtensions\Query\Mysql\DateAdd');
 
        $repository = $em->getRepository('ParroquiaComunidadBundle:Persona');

        $qb = $repository->createQueryBuilder('p')
                ->where("DAY(p.fecha_nacimiento) = :day")
                ->andwhere("MONTH(p.fecha_nacimiento) = :month");
     
        $fecha_actual = new \DateTime();
        
        $qb->setParameter('month',  $fecha_actual->format('m'))
           ->setParameter('day', $fecha_actual->format('d'));
 
        $entities = $qb->getQuery()->getResult(); //Cumpleaños del día de hoy
        
        
        $qb2 = $repository->createQueryBuilder('p');
        $qb2->addSelect('DATEADD(p.fecha_nacimiento, INTERVAL (YEAR(CURRENT_DATE())-YEAR(p.fecha_nacimiento)) YEAR) as sortidx')
            ->where($qb2->expr()->between('DATEADD(p.fecha_nacimiento, INTERVAL (YEAR(CURRENT_DATE())-YEAR(p.fecha_nacimiento)) YEAR)', "CURRENT_DATE()", "DATEADD(CURRENT_DATE(), INTERVAL 7 DAY)"))
            ->andWhere('DATEADD(p.fecha_nacimiento, INTERVAL (YEAR(CURRENT_DATE())-YEAR(p.fecha_nacimiento)) YEAR)  <> CURRENT_DATE()')
            ->orderBy('sortidx','ASC');
        
        $entities2 = $qb2->getQuery()->getResult(); //Cumpleaños dentro de los siguientes 7 días

        return $this->render('ParroquiaHomeBundle:Default:cumpleanos.html.twig', array(
            'entities' => $entities,
            'entities2' => $entities2
        ));

    }
}

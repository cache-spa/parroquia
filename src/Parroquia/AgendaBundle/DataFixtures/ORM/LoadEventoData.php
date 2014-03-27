<?php

namespace Parroquia\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Parroquia\AgendaBundle\Entity\Evento;

class LoadEventoData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $evento = new Evento();
        $evento->setNombre('Santa María Madre de Dios');
        $evento->setInicio(new \DateTime('2014-01-01 00:00'));
        $evento->setTermino(new \DateTime('2014-01-01 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Epifanía del Señor');
        $evento->setInicio(new \DateTime('2014-01-06 00:00'));
        $evento->setTermino(new \DateTime('2014-01-06 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Miércoles de Ceniza');
        $evento->setInicio(new \DateTime('2014-03-05 00:00'));
        $evento->setTermino(new \DateTime('2014-03-05 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('San José');
        $evento->setInicio(new \DateTime('2014-03-19 00:00'));
        $evento->setTermino(new \DateTime('2014-03-19 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Anunciación del Señor');
        $evento->setInicio(new \DateTime('2014-03-26 00:00'));
        $evento->setTermino(new \DateTime('2014-03-26 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Fiesta Inicio Año Discípulo y Misionero');
        $evento->setInicio(new \DateTime('2014-03-29 00:00'));
        $evento->setTermino(new \DateTime('2014-03-29 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Domingo de Ramos');
        $evento->setInicio(new \DateTime('2014-04-13 00:00'));
        $evento->setTermino(new \DateTime('2014-04-13 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Semana Santa');
        $evento->setInicio(new \DateTime('2014-04-14 00:00'));
        $evento->setTermino(new \DateTime('2014-04-20 23:59'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);        
        
        $evento = new Evento();
        $evento->setNombre('Jornada Arzobispado Santiago de Inicio de Año');
        $evento->setInicio(new \DateTime('2014-04-20 00:00'));
        $evento->setTermino(new \DateTime('2014-04-20 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Día del Trabajo');
        $evento->setInicio(new \DateTime('2014-05-01 00:00'));
        $evento->setTermino(new \DateTime('2014-05-01 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);        
        
        $evento = new Evento();
        $evento->setNombre('Glorias Navales');
        $evento->setInicio(new \DateTime('2014-05-21 00:00'));
        $evento->setTermino(new \DateTime('2014-05-21 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Comida Parroquial');
        $evento->setInicio(new \DateTime('2014-05-29 00:00'));
        $evento->setTermino(new \DateTime('2014-05-29 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);        
        $manager->persist($evento);   
        
        $evento = new Evento();
        $evento->setNombre('Ascención del Señor');
        $evento->setInicio(new \DateTime('2014-06-01 00:00'));
        $evento->setTermino(new \DateTime('2014-06-01 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);        
        
        $evento = new Evento();
        $evento->setNombre('Pentecostés y Envío Misionero');
        $evento->setInicio(new \DateTime('2014-06-08 00:00'));
        $evento->setTermino(new \DateTime('2014-06-08 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Santísima Trinidad, Día del Sagrado Corazón');
        $evento->setInicio(new \DateTime('2014-06-15 00:00'));
        $evento->setTermino(new \DateTime('2014-06-15 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);             
        
        $evento = new Evento();
        $evento->setNombre('Corpus Christi');
        $evento->setInicio(new \DateTime('2014-06-22 00:00'));
        $evento->setTermino(new \DateTime('2014-06-22 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('San Pedro y San Pablo');
        $evento->setInicio(new \DateTime('2014-06-29 00:00'));
        $evento->setTermino(new \DateTime('2014-06-29 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);        
        $manager->persist($evento);        

        $evento = new Evento();
        $evento->setNombre('Día del P. Pedro');
        $evento->setInicio(new \DateTime('2014-06-29 00:00'));
        $evento->setTermino(new \DateTime('2014-06-29 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);        
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Santa Teresa de Los Andes');
        $evento->setInicio(new \DateTime('2014-07-13 00:00'));
        $evento->setTermino(new \DateTime('2014-07-13 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Virgen del Carmen');
        $evento->setInicio(new \DateTime('2014-07-16 00:00'));
        $evento->setTermino(new \DateTime('2014-07-16 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Día del Párroco, San Juan María Vianney');
        $evento->setInicio(new \DateTime('2014-08-04 00:00'));
        $evento->setTermino(new \DateTime('2014-08-04 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);       
        
        $evento = new Evento();
        $evento->setNombre('Transfiguración del Señor');
        $evento->setInicio(new \DateTime('2014-08-06 00:00'));
        $evento->setTermino(new \DateTime('2014-08-06 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento); 
        
        $evento = new Evento();
        $evento->setNombre('Asunción de la Virgen');
        $evento->setInicio(new \DateTime('2014-08-15 00:00'));
        $evento->setTermino(new \DateTime('2014-08-15 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);   
        
        $evento = new Evento();
        $evento->setNombre('San Alberto Hurtado');
        $evento->setInicio(new \DateTime('2014-08-18 00:00'));
        $evento->setTermino(new \DateTime('2014-08-18 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);       
        
        $evento = new Evento();
        $evento->setNombre('Comida San Esteban');
        $evento->setInicio(new \DateTime('2014-08-18 00:00'));
        $evento->setTermino(new \DateTime('2014-08-18 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Esquinazo Fiestas Patrias');
        $evento->setInicio(new \DateTime('2014-09-07 00:00'));
        $evento->setTermino(new \DateTime('2014-09-07 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Natividad de la Virgen');
        $evento->setInicio(new \DateTime('2014-09-08 00:00'));
        $evento->setTermino(new \DateTime('2014-09-08 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);        

        $evento = new Evento();
        $evento->setNombre('Comida de Personal');
        $evento->setInicio(new \DateTime('2014-09-08 00:00'));
        $evento->setTermino(new \DateTime('2014-09-08 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Fiestas Patrias');
        $evento->setInicio(new \DateTime('2014-09-18 00:00'));
        $evento->setTermino(new \DateTime('2014-09-19 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);    
        
        $evento = new Evento();
        $evento->setNombre('Cumpleaños P. Pedro');
        $evento->setInicio(new \DateTime('2014-09-24 00:00'));
        $evento->setTermino(new \DateTime('2014-09-24 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);  
        
        $evento = new Evento();
        $evento->setNombre('Procesión Virgen del Carmen');
        $evento->setInicio(new \DateTime('2014-09-28 00:00'));
        $evento->setTermino(new \DateTime('2014-09-28 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento); 
        
        $evento = new Evento();
        $evento->setNombre('Encuentro de Catequistas de Santiago');
        $evento->setInicio(new \DateTime('2014-10-12 00:00'));
        $evento->setTermino(new \DateTime('2014-10-12 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);        

        $evento = new Evento();
        $evento->setNombre('Día del Migrante');
        $evento->setInicio(new \DateTime('2014-10-12 00:00'));
        $evento->setTermino(new \DateTime('2014-10-12 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);        
        
        $evento = new Evento();
        $evento->setNombre('Exposición Ayuda Iglesia que sufre');
        $evento->setInicio(new \DateTime('2014-10-12 00:00'));
        $evento->setTermino(new \DateTime('2014-10-12 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);  
        
        $evento = new Evento();
        $evento->setNombre('Confirmaciones');
        $evento->setInicio(new \DateTime('2014-10-12 00:00'));
        $evento->setTermino(new \DateTime('2014-10-12 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Día Iglesias Evangélicas');
        $evento->setInicio(new \DateTime('2014-10-31 00:00'));
        $evento->setTermino(new \DateTime('2014-10-31 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento); 
        
        $evento = new Evento();
        $evento->setNombre('Día de Todos los Santos');
        $evento->setInicio(new \DateTime('2014-11-01 00:00'));
        $evento->setTermino(new \DateTime('2014-11-01 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Día de Todos los Difuntos');
        $evento->setInicio(new \DateTime('2014-11-02 00:00'));
        $evento->setTermino(new \DateTime('2014-11-02 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);      
        
        $evento = new Evento();
        $evento->setNombre('Inicio del Mes de María');
        $evento->setInicio(new \DateTime('2014-11-08 00:00'));
        $evento->setTermino(new \DateTime('2014-11-08 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);  
        
        $evento = new Evento();
        $evento->setNombre('Panel Mes de María');
        $evento->setInicio(new \DateTime('2014-11-11 00:00'));
        $evento->setTermino(new \DateTime('2014-11-11 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);      
        
        $evento = new Evento();
        $evento->setNombre('Aniversario 22º P. Pedro');
        $evento->setInicio(new \DateTime('2014-11-21 00:00'));
        $evento->setTermino(new \DateTime('2014-11-21 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);        

        $evento = new Evento();
        $evento->setNombre('Jornada Consejos Pastorales en la Vicaría');
        $evento->setInicio(new \DateTime('2014-11-21 00:00'));
        $evento->setTermino(new \DateTime('2014-11-21 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento); 
        
        $evento = new Evento();
        $evento->setNombre('Cristo Rey');
        $evento->setInicio(new \DateTime('2014-12-07 00:00'));
        $evento->setTermino(new \DateTime('2014-12-07 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);         

        $evento = new Evento();
        $evento->setNombre('Celebración Fin Año Discípulo y Misionero');
        $evento->setInicio(new \DateTime('2014-12-07 00:00'));
        $evento->setTermino(new \DateTime('2014-12-07 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);        

        $evento = new Evento();
        $evento->setNombre('Inmaculada Concepción');
        $evento->setInicio(new \DateTime('2014-12-08 00:00'));
        $evento->setTermino(new \DateTime('2014-12-08 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);
        
        $evento = new Evento();
        $evento->setNombre('Comida Fin de Año Consejo Pastoral y Evaluación año');
        $evento->setInicio(new \DateTime('2014-12-08 00:00'));
        $evento->setTermino(new \DateTime('2014-12-08 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(false);                
        $manager->persist($evento);        
        
        $evento = new Evento();
        $evento->setNombre('Misa de Navidad');
        $evento->setInicio(new \DateTime('2014-12-24 00:00'));
        $evento->setTermino(new \DateTime('2014-12-24 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);  
        
        $evento = new Evento();
        $evento->setNombre('Navidad');
        $evento->setInicio(new \DateTime('2014-12-25 00:00'));
        $evento->setTermino(new \DateTime('2014-12-25 00:00'));
        $evento->setTodoElDia(true);
        $evento->setLiturgico(true);                
        $manager->persist($evento);        
        
        $manager->flush();
    }
}


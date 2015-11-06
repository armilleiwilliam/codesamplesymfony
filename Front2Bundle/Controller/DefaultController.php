<?php
namespace Casa\Front2Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JF\UtilityBundle\Controller\Traits\EnvironmentController;
use JF\UtilityBundle\Controller\Traits\ORMController;
use JF\UtilityBundle\Controller\Traits\OutputController;
use JF\CalendarBundle\Controller\Traits\CalendarController;
use JF\UtilityBundle\Controller\Traits\PaginatorController;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller implements \JF\CalendarBundle\Controller\CalendarControllerInterface {

    use EnvironmentController,
        ORMController,
        OutputController,
        CalendarController,
        PaginatorController;

    /**
     * @Route("/", name="home")
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction() {
        
   $categorie = $this->findAll("CasaFront2Bundle:Categoria");
        $form = $this->creaFormRicerca();
$last_vendite = $this->getDoctrine()->getRepository('CasaFront2Bundle:Contratto')->last_annunci();
$last_aste = $this->getDoctrine()->getRepository('CasaFront2Bundle:Contratto')->last_annunci('asta');
$carousel = $this->executeSql("
SELECT c.id, f.file
  FROM scheda_contratti c 
  LEFT JOIN scheda_foto f ON f.contratto_id = c.id
 ORDER BY RAND()
 LIMIT 3");
        return array(
            'form' => $form->createView(),
            'vendite' => $last_vendite,
            'aste' => $last_aste,
            'categoria' => $categorie,
            'carousel'  => $carousel,
        );
    }
    /**
     * @Route("/ajax/geo/{term}", name="geo_search", defaults={"_format":"json"}, options={"expose":true})
     */
    public function preleva_dati(){
        return new Response(json_encode("vai"));
        
    }
    


/**
     * 
     * @return \Symfony\Component\Form\Form
     */
    
    private function form_prova(){
             $form = $this->createFormBuilder(array('type'=>'search'))
               ->add('localita','text',array(
                   'required' => false,
                   'attr'=> array(
                       'placeholder' => 'Cerco il comune o localita'
                   ),
               ))
               ->setAction($this->generateUrl("ricerca"));
        ;
        return $form->getForm();
        
        
    }
    /**
     * 
     * @return \Symfony\Component\Form\Form
     */
    private function creaFormRicerca() {
        $form = $this->createFormBuilder(array('type' => 'SEARCH'))
                /*->add('localita', 'text', array(
                    'required' => false,
                    'attr' => array(
                        'icon' => 'map-marker',
                        'class' => 'form-control col',
                        'ref' => 'col_1',
                        'placeholder' => 'Cerca il Comune o la località',
                    ),
                    'label_attr' => array(
                        'class' => 'no-display-i',
                    ),
                ))*/
                ->add('categoria', 'entity', array(
                    'class' => 'CasaFront2Bundle:Categoria',
                    'empty_value' => 'Scegliere una categoria',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control col',
                        'ref' => 'col_2',
                    ),
                    'label_attr' => array(
                        'class' => 'no-display-i',
                    ),
                ))
                ->add('tipologia', 'entity', array(
                    'class' => 'CasaFront2Bundle:Tipologia',
                    'empty_value' => 'Scegliere una tipologia',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control col',
                        'ref' => 'col_2',
                    ),
                    'label_attr' => array(
                        'class' => 'no-display-i',
                    ),
                ))
                ->add('tipo_contratto', 'choice', array(
                    'choices' => array(
                        'c' => 'Cosa cerchi?',
                        'v' => 'In vendita',
                        'a' => 'In affitto',
                    ),
                    'preferred_choices' => array('c'),
                    'attr' => array(
                        'class' => 'form-control col',
                        'ref' => 'col_3',
                    ),
                    'label_attr' => array(
                        'class' => 'no-display-i',
                    ),
                ))
                ->add('prezzo_vendita', 'choice', array(
                    'choices' => array(
                        '50000' => '50.000,00 €',
                        '100000' => '100.000,00 €',
                        '150000' => '150.000,00 €',
                        '200000' => '200.000,00 €',
                        '250000' => '250.000,00 €',
                        '300000' => '300.000,00 €',
                        '400000' => '400.000,00 €',
                        '500000' => '500.000,00 €',
                        '600000' => '600.000,00 €',
                        '700000' => '700.000,00 €',
                        '800000' => '800.000,00 €',
                        '1000000' => '1.000.000,00 €',
                        '' => 'Nessun limite',
                    ),
                    'preferred_choices' => array(''),
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control col',
                        'ref' => 'col_3',
                    ),
                    'label_attr' => array(
                        'class' => 'no-display-i',
                    ),
                ))
                ->add('prezzo_affitto', 'choice', array(
                    'choices' => array(
                        '50' => '50,00 €',
                        '100' => '100,00 €',
                        '150' => '150,00 €',
                        '200' => '200,00 €',
                        '250' => '250,00 €',
                        '300' => '300,00 €',
                        '400' => '400,00 €',
                        '500' => '500,00 €',
                        '600' => '600,00 €',
                        '700' => '700,00 €',
                        '800' => '800,00 €',
                        '1000' => '800,00 €',
                        '1250' => '1250,00 €',
                        '1500' => '1500,00 €',
                        '' => 'Nessun limite',
                    ),
                    'preferred_choices' => array(''),
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control col',
                        'ref' => 'col_3',
                    ),
                    'label_attr' => array(
                        'class' => 'no-display-i',
                    ),
                ))
                ->add('invia', 'button', array('attr' => array('class' => 'btn btn-default theme-btn')))
                ->setAttribute("name","ricerca_imm")
                ->setAction($this->generateUrl('ricerca'))
        ;
        return $form->getForm();
    }

    /**
     * @Route("/agenzia", name="chi")
     * @Template()
     */
    public function chiAction() {
        $form = $this->creaFormRicerca();
        return array("form"=>$form->createView());
    }
    
        /**
     * @Route("/ind", name="home2")
     * @Route("/ind", name="index2")
     * @Template()
     */
    public function indAction() {
        
        $form = $this->form_prova();
        return ["form"=>$form->createView(),];
  
    }
    /**
     * @Route("/ajax/geo/{term}", name="geo_search", defaults={"_format":"json"}, options={"expose":true})
     */
    public function geosearchAction($term) {
        $_geo = $this->getRepository("JFGeoBundle:GeoNames");
        /* @var $_geo \JF\GeoBundle\Entity\GeoNamesRepository */
        $comuni = $_geo->cercaComune($term);
        $out = array();
        foreach ($comuni as $comune) {
            /* @var $comune \JF\GeoBundle\Entity\GeoNames */
            $out[] = array(
                'id' => $comune->getGeonameid(),
                'label' => $comune->getNomeComune(),
                'value' => $comune->getNomeComune()
            );
            if (count($out) == 10) {
                break;
            }
        }

        return $this->jsonResponse($out);
    }

    /**
     * @Route("/ajax/categoria/{id}", name="filtro_categoria", defaults={"_format":"json"}, options={"expose":true})
     */
    public function filtrocategoriaAction($id) {
        $categoria = $this->find("CasaFront2Bundle:Categoria", $id);
        /* @var $categoria \Casa\Front2Bundle\Entity\Categoria */
        $out = array();
        if ($categoria) {

            foreach ($categoria->getTipologie() as $tipo) {
                /* @var $tipo \Casa\Front2Bundle\Entity\Tipologia */
                $out[] = array(
                    'id' => $tipo->getId(),
                    'label' => $tipo->getTipologia()
                );
            }
        }
        return $this->jsonResponse($out);
    }

    /**
     * @Route("/dove-siamo", name="dove")
     * @Template()
     */
    public function doveAction(Request $request) {
        $categorie = $this->findAll("CasaFront2Bundle:Categoria");
         $form = $this->creaFormContatti();
         $mailer = $this->get('mailer');
$esito = null;
                $session = new Session();
         $form->handleRequest($request);
         
         if($form->isValid()){
             $dati = $form->getData();
                      $messaggio = $mailer->createMessage()
                 ->setSubject('Messaggio da:'.$dati['nome'])
                 ->setFrom("armilleiwilliam@gmail.com")
                 ->setTo("armslegs_76@yahoo.it")
                 ->setBody("Email: ".$dati["email"]."<br/><br/> Messaggio:".$dati["testo"], "text/html");
            $mailer->send($messaggio);
            
            if($mailer){
                $session->getFlashBag()->add("esito", "Email inviata correttamente");
                return $this->redirect($this->generateUrl("dove"));
            }else{
                $session->getFlashBag()->add("esito", "Email non inviata");
                return $this->redirect($this->generateUrl("dove"));
            }
                   
         }
         
          $form2 = $this->creaFormRicerca();
        
        return array(
            "form"=>$form2->createView(),
            "form_dov"=>$form->createView(),
            'categoria' => $this->getRepository("CasaFront2Bundle:Categoria")->findAll(),
            );
      
    }
    /**
     * 
     * @return \Symfony\Component\Form\Form
     */
    private function creaFormContatti() {
         
        $form = $this->createFormBuilder(array('type'=>'SEARCH'))
                 ->add('nome','text', array(
                     'required' => true,
                     'attr' => array(
                        'class' => 'form-control col',
                        'ref' => 'col_1',
                        'placeholder' => 'Nome',
                     ),
                     'label_attr' => array(
                         'class' => 'no-display-i',
                     )
                 ))
                ->add('email', 'text', array(
                    'required' => true,
                    'attr' => array(
                        'icon' => 'map-marker',
                        'class' => 'form-control col',
                        'ref' => 'col_1',
                        'placeholder' => 'Email',
                    ),
                    'label_attr' => array(
                        'class' => 'no-display-i',
                    )))
                ->add('testo','textarea', array(
                     'required' => true,
                    'attr' => array(
                        'icon' => 'map-marker',
                        'class' => 'form-control col',
                        'ref' => 'col_1',
                        'placeholder' => 'Messaggio',
                    ),
                    'label_attr' => array(
                        'class' => 'no-display-i',
                    )))
                ->add('invia_ora', 'button', array('attr' => array('class' => 'btn btn-default theme-btn')))
                ->setAttribute("name","ricerca_imm")
                ->setAction($this->generateUrl('dove'))
        ;
        return $form->getForm();
        
        
    }
    /**
     * @Route("/visualizza-annunci/{id}/{mode}", name="annunci", defaults={"mode": "all"})
     * @Template()
     */
    public function annunciAction($id, $mode) {
        try {
            $qb = $this->getRepository('CasaFront2Bundle:Contratto')->annunci($id, $mode, $this->container->getParameter('casa_core.agenzia'));
        } catch (\Exception $ex) {
            $qb = $this->getRepository('CasaFront2Bundle:Contratto')->annunci($id, $mode);
        }
        $entities = $this->createPagination($qb, 10);

        $form = $this->creaFormRicerca();

        return array(
            'form' => $form->createView(),
            'entities' => $entities,
            'categoria' => $this->find('CasaFront2Bundle:Categoria', $id),
            'categorie' => $this->getRepository("CasaFront2Bundle:Categoria")->findAll(),
            'mode' => $mode,
        );
    }

    /**
     * @Route("/risultati-ricerca", name="ricerca")
     * @Route("/risultati-ricerca", name="ricerca_json", defaults={"_format": "json"})
     * @Template("CasaFront2Bundle:Default:annunci.html.twig")
     */
    public function ricercaAction() {
        $form = $this->creaFormRicerca();
        $form->bind($this->getRequest());
        $data = $form->getData();
        $_contratto = $this->getRepository('CasaFront2Bundle:Contratto');
        /* @var $_contratto \Casa\Front2Bundle\Entity\ContrattoRepository */
        $qb = $_contratto->ricerca($data);
        $entities = $this->createPagination($qb, 10);
        return array(
            'form' => $form->createView(),
            'entities' => $entities,
            'categoria' => $data['categoria'],
            'mode' => $data['tipo_contratto'],
        );
    }

    /**
     * @Route("/visualizza-annuncio/{uid}/{id}/{mode}", name="annuncio", defaults={"mode": "all", "id": "auto"}, options={"expose": true})
     * @Template()
     */
    public function annuncioAction($uid, $id, $mode) {
        $annuncio = $this->find('CasaFront2Bundle:Contratto', $uid);
        $scheda = $this->getRepository('CasaFront2Bundle:Scheda')->createQueryBuilder('s')
                ->leftJoin('s.contratti', 'c')
                ->andWhere('c.id = :idc')
                ->setParameter('idc', $uid)->getQuery()
              ->execute();
        
        $rif = explode("-",$scheda[0]->getId());
        
        /* @var $annuncio \Casa\Front2Bundle\Entity\Contratto */
        if($id == 'auto') {
            $id = $annuncio->getScheda()->getTipologia()->getCategoria()->getId();
        }
        $localizzata = $this->get('request')->getLocale();
        $form2 = $this->creaFormMessaggio($uid, $id, $mode, $rif[0]);
        $form = $this->creaFormRicerca();
        return ['annuncio' => $annuncio,
            'form' => $form->createView(),
            'categoria' => $this->find('CasaFront2Bundle:Categoria', $id),
            'categorie' => $this->getRepository("CasaFront2Bundle:Categoria")->findAll(),
            'mode' => $mode,
            'form_due' => $form2->createView(),
            'locali' => $localizzata,
            ];
    }

    /**
     * 
     * @return \Symfony\Component\Form\Form
     */
    private function creaFormMessaggio($uid, $id, $mode, $rif) {
        $form = $this->createFormBuilder(array('type' => 'INF'))
                ->add('nome', 'text', array('attr' => array('class' => 'form-control')))
                ->add('cognome', 'text', array('attr' => array('class' => 'form-control')))
                ->add('rif', 'hidden', array('attr' => array('class' => 'form-control', 'placeholder'=> $rif)))
                ->add('email', 'email', array('attr' => array('class' => 'form-control')))
                ->add('telefono', 'text', array('attr' => array('class' => 'form-control')))
                ->add('messaggio', 'textarea', array('attr' => array('class' => 'form-control', 'rows' => 8)))
                ->add('invia_form', 'button', array('attr' => array('class' => 'btn btn-default theme-btn')))
                ->setAction($this->generateUrl('messaggio', array('uid' => $uid, 'id' => $id, 'mode' => $mode, 'rif' => $rif)))
                ->setAttribute('class', 'form_essaggio')
        ;
        return $form->getForm();
    }

    /**
     * @Route("/messaggio/{uid}/{id}/{rif}/{mode}", name="messaggio", defaults={"_format": "json", "mode": "all"})
     * @Method("GET")
     */
    public function messaggioAction($uid, $id, $mode, $rif) {
        $annuncio = $this->find('CasaFront2Bundle:Contratto', $uid);
        
        /* @var $annuncio \Casa\Front2Bundle\Entity\Contratto */
        $form = $this->creaFormMessaggio($uid, $id, $mode, $rif);
        $form->bind($this->getRequest());
        $data = $form->getData();
        try {
            $this->getEm()->beginTransaction();
            $contatto = $this->findOneBy('CasaFront2Bundle:Contatto', array('email' => $data['email']));
         $mailer = $this->get('mailer');
          $messaggio = $mailer->createMessage()
                    ->setSubject("Riferimento immobile:#".$rif)
                    ->setFrom("armilleiwilliam@gmail.com")
                    ->setTo("armslegs_76@yahoo.it")
                    ->setBody("Nome:".$data['nome']."<br/><br/> Email: ".$data["email"]."<br/><br/> Oggetto:appartamento #".$rif."<br/><br/>Cognome:".$data['cognome']."<br/><br/>Telefono:".$data['telefono']." <br/><br/>Contenuto:".$data['messaggio'],"text/html");
         $success = $mailer->send($messaggio);
         
            if($success){
          $esito = "Email inviata correttamente. Verrai contattato al più presto!";
      }else{
          $esito = "Email non inviata per un problema ignoto. Utilizzare l'email od il numero di telefono in alto per chiedere informazioni inerenti a questo immobile, ricordando di menzionare il numero di #Rif. Ci scusiamo per il disagio!";
      }
       
       

/*           $contatto = $this->findOneBy('CasaFront2Bundle:Contatto', array('email' => $data['email']));
         $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                 ->setUsername("armilleiwilliam@gmail.com")
                 ->setPassword("willettino200");
         $mailer = \Swift_Mailer::newInstance($transport);
          $messaggio = \Swift_Mailer::newInstance('Test')
                    ->setSubject("Riferimento immobile:#".$rif)
                    ->setFrom("armilleiwilliam@gmail.com")
                    ->setTo("armilleiwilliam@gmail.com")
                    ->setBody("Nome:".$data['nome']."<br/><br/> Email: ".$data["email"]."<br/><br/> Oggetto:appartamento #".$data['rif']."<br/><br/>Cognome:".$data['cognome']."<br/><br/>Telefono:".$data['telefono']." <br/><br/>Contenuto:".$data['messaggio'],"text/html");
         $success = $mailer->send($messaggio);
 
 */
       
        } catch (\Exception $ex) {
         
            throw $ex;
        }

        return $this->jsonResponse($esito);
    }

    public function eventClassName() {
        return '\Casa\CalendarBundle\Entity\Appuntamento';
    }

    public function typeClassName() {
        return '\Casa\CalendarBundle\Entity\Type';
    }

    public function typesParameterName() {
        return array();
    }

}


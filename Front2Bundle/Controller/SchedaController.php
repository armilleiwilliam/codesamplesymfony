<?php

namespace Casa\Front2Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JF\UtilityBundle\Controller\Traits\EnvironmentController;
use JF\UtilityBundle\Controller\Traits\ORMController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Filesystem\Filesystem;
use Casa\Front2Bundle\Form\SchedaType;
use Casa\Front2Bundle\Form\DocumentoType;
use Casa\Front2Bundle\Form\FotoType;
use Casa\Front2Bundle\Form\ContattoType;
use Casa\Front2Bundle\Entity\Scheda;
use Casa\Front2Bundle\Entity\Contratto;
use Casa\Front2Bundle\Entity\Contatto;
use Casa\Front2Bundle\Entity\Prezzo;
use Casa\Front2Bundle\Entity\Documento;
use Casa\Front2Bundle\Entity\Foto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Scheda controller.
 *
 * @Route("/scheda")
 */
class SchedaController extends Controller {

    use EnvironmentController,
        ORMController;

    /**
     * Lists all Scheda entities.
     *
     * @Route("//{page}/{lang}", name="scheda", options={"expose": true}, defaults={"page" = 0, "lang" = "it"})
     * @Method("GET")
     * @Template()
     * 
     */
    public function indexAction(Request $request, $page, $lang) {
        $data = null;
        $esito = null;
        # $session = new Session();
                $session = $request->getSession();
                $session->start();
if($lang == "en"){
    
        $request->setLocale("en_EN");
              $session->set("lang", "en");
}else{
  
      $request->setLocale("it_IT");
      $session->set("lang", "it");
    
}
        if($session->has("esito")){
            $esito = $session->getFlashBag()->get("esito",array());
        }
        $form = $this->form_ricerca_rif();
        
        $form->handleRequest($request);
        if($form->isValid()) {
        $data = $form->getData();
        }
        
          
        $entities = $this->getDoctrine()->getRepository("CasaFront2Bundle:Scheda")->scheda($data, $page);
        $entities2 = $this->getDoctrine()->getRepository("CasaFront2Bundle:Scheda")->scheda_pag($data);

        return array(
            'form_ric' => $form->createView(),
            'entities' => $entities,
            'pag' => $entities2,
            'esito' => $esito,
            'page' => $page,
        );
    }
    
     /**
     * @return \Symfony\Component\Form\Form
     */
    
    private function form_ricerca_rif(){
        $form = $this->createFormBuilder(array('type'=>'search'))
                ->add('riferimento','text', array(
                    'label' => 'Ricerca per riferimento:',
                    'required' => false,
                    'attr' => array(
                        'placeholder' => 'Inserire riferimento'
                    ),
                ))
                ->add('indirizzo','text', array(
                    'label' => 'Ricerca per Indirizzo:',
                    'required' => false,
                    'attr' => array(
                        'placeholder' => 'Inserire indirizzo'
                    ),
                ))
                ->add('locali','integer', array(
                    'label' => 'Ricerca per num. locali:',
                    'required' => false,
                    'attr' => array(
                        'placeholder' => 'Inserire num. locali'
                    ),
                ))
                ->add('tipologia','entity', array(
                    'label' => 'Ricerca per tipologia immobile:',
                    'class' => 'CasaFront2Bundle:Tipologia',
                    'empty_value' => 'Scegliere una tipologia',
                    'required' => false,
                    'attr' => array(
                        'placeholder' => ''
                    ),
                ))
                ->setAttribute('class', 'form_ricerca')
                ->add('Cerca','submit', array('attr' => array('class' => 'btn btn-default theme-btn')))
                ->setMethod('GET')
                ->setAction($this->generateUrl("scheda"));
        return $form->getForm();
    }
    
    /**
     * Show maps of all apparments
     * @Route("/mappe", name="mappe")
     * @Method("GET")
     * @Template()
     */
    public function mappeAction(){
        
        
        
     $lista = $this->getDoctrine()->getRepository("CasaFront2Bundle:Scheda")->mappe_list();
           
        
        return array(
            "app" => $lista,
        );
    }
        /**
     * Lists all Scheda entities.
     *
     * @Route("/canc/ {id}", name="canc_scheda")
     * @Method("GET")
     * @ParamConverter ("id", class="CasaFront2Bundle:Scheda")
     * @Template()
     * 
     */
    public function canc_schedaAction(Scheda $entity) {
        $session = new Session();
        $fs = new Filesystem();
       if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scheda entity.');
        }
        try{
            $this->getEm()->beginTransaction();
             $scheda = $this->getRepository('CasaFront2Bundle:Scheda')->find($entity);
             $scheda_id = $scheda->getId();
             $foto = $this->getEm()->createQuery("SELECT f from CasaFront2Bundle:Foto f LEFT JOIN f.contratto c  LEFT JOIN c.scheda s WHERE s.id = :scheda_id")->setParameter("scheda_id",$scheda_id)->getResult();
             $documento = $this->getEm()->createQuery("SELECT d from CasaFront2Bundle:Documento d LEFT JOIN d.contratto c  LEFT JOIN c.scheda s WHERE s.id = :scheda_id")->setParameter("scheda_id",$scheda_id)->getResult();
            $contratto = $this->getEm()->createQuery("SELECT c from CasaFront2Bundle:Contratto c LEFT JOIN c.scheda s WHERE s.id = :scheda_id")->setParameter("scheda_id",$scheda_id)->getResult();
          
             $doc = null;
             foreach($foto as $fotine){
                 $fs->remove("uploads/gallery/".$fotine->getFile());
                 $fs->remove("uploads/gallery/bigImage/".$fotine->getFile());
                 $fs->remove("uploads/gallery/icon/".$fotine->getFile());
                 $fs->remove("uploads/gallery/mediumImage/".$fotine->getFile());
                 $fs->remove("uploads/gallery/thumbnail/".$fotine->getFile());
                 $this->remove($fotine);
                 
             }
             foreach($documento as $docu){
                 $fs->remove($docu->getFile());
                 $this->remove($docu);
                 $doc = $docu->getContratto();
             }
             foreach($contratto as $con){
                 $doc = $con->getId();
                 $this->remove($con);
             }
                 
             if($doc!=null){
             $fs->remove("upload/".$doc."/documenti");
             $fs->remove("upload/".$doc);
             }
             
             $this->remove($scheda);
        
        $this->getEm()->commit();
        $session->getFlashBag()->add("esito", "Scheda cancellata correttamente");

         return $this->redirect($this->generateUrl("scheda"));
                  
            /* se il proprietario è già stato assegnato vuol dire che sarà reindirizzato alla modifica del proprietario, altrimenti significherà che si starà compilando una nuova scheda quindi sarà reindirizzato ad una nuova, appunto, scheda */
            
        } catch (\Exception $ex) {
            $this->getEm()->rollback();
             $session->getFlashBag()->add("esito", "Scheda non cancellata");

         return $this->redirect($this->generateUrl("scheda"));
            throw $ex;
            
        }
       
    }

    /**
     * Creates a new Scheda entity.
     *
     * @Route("/", name="scheda_create")
     * @Method("POST")
     * @Template("CasaFront2Bundle:Scheda:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Scheda();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->persist($entity);

            return $this->redirect($this->generateUrl('scheda_caratteristiche', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Scheda entity.
     *
     * @param Scheda $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Scheda $entity) {
        $form = $this->createForm(new SchedaType(), $entity, array(
            'action' => $this->generateUrl('scheda_create'),
            'method' => 'POST',
            'attr' => array(
                'class' => 'form-scheda',
            ),
        ));

        $form->add('button', 'button', array('label' => 'Avanti', 'attr' => array('class' => 'btn')));

        return $form;
    }
    
        /**
     * Creates a form to create a Contatto entity.
     *
     * @param Contatto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createContattoCreateForm(Contatto $entity) {
        $form = $this->createForm(new ContattoType(), $entity, array(
            'action' => $this->generateUrl('gestione-contatti_create_json'),
            'method' => 'POST',
            'attr' => array(
                'class' => 'proprietario',
            ),
        ));
        $form->add('button', 'button', array('label' => 'Salva', 'attr' => array('class' => 'btn no-display')));
        $form->add('reset', 'reset', array('label' => 'Resetta', 'attr' => array('class' => 'btn no-display')));

        return $form;
    }

    /**
     * Displays a form to create a new Scheda entity.
     *
     * @Route("/new", name="scheda_new")
     * @Method("GET")
     * @Template()
     */
    /* public function newAction() {
        $scheda = new Scheda();
        $form = $this->createCreateForm($scheda);
 
        
        

        return array(
            'entity' => $scheda,
            'form' => $form->createView(),
        );
    }*/

    public function newAction() {
        $contatto = new Contatto();
        $contatto->setCliente(false);
        $contatto->setProprietario(true);
        $formContatto = $this->createContattoCreateForm($contatto);
        $scheda = new Scheda();
        
        
        $form = $this->createCreateFormdue();
    
        
        

        return array(
            'entity' => $scheda,
            'form' => $form->createView(),
            'formContatto' => $formContatto->createView(),
        );
    }
/**
     * Creates a form to create a Scheda entity.
     *
     * @param Scheda $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateFormdue() {
       $form = $this->createFormBuilder(array('type' => 'SEARCH'))
            ->add('tipologia', 'entity', array(
                    'class' => 'CasaFront2Bundle:Tipologia',
                    'empty_value' => 'Scegliere una tipologia',
                    'required' => true,
                    'attr' => array(
                        'class' => 'form-control col',
                        'ref' => 'col_2',
                    ),
                    'label_attr' => array(
                        'class' => 'no-display-i',
                    ),
                ))
            ->add('indirizzo', 'text', array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'font'
                    )
                ))
            ->add('localita', 'text', array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'font'
                    )
                ))
            ->add('locali','integer',array(
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => "",
                    'icon' => 'font'
                )
                    ))
            ->add('cap', 'text', array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'font'
                    )
                ))
            ->add('descrizione', 'textarea', array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('difformita', 'textarea', array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    ),
                'required' => false,
                ))
            ->add('lat', 'hidden', array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('lon', 'hidden', array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('proprietario', 'entity', array(
                    'class' => 'CasaFront2Bundle:Contatto',
                    'empty_value' => 'Scegliere una Contatto',
                    'required' => true,
                    'attr' => array(
                        'class' => 'form-control col',
                        'ref' => 'col_2',
                    ),
                    'label_attr' => array(
                        'class' => 'no-display-i',
                    ),
                ))
                ->add('dataFirma', 'date', array(
                    'attr' => array(
                        'class' => 'form-control',
                    )
                ))
                ->add('esclusivita', 'checkbox', array(
                    'label' => 'In esclusiva',
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'required' => false,
                ))
                ->add('pullicazioneFoto', 'checkbox', array(
                    'label' => 'Pubblica foto',
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'required' => false,
                ))
                ->add('collaborazioni', 'checkbox', array(
                    'label' => 'Collaborazioni',
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'required' => false,
                ))
            ->add('vendita', 'checkbox', array(
                'label' => 'In vendita',
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    ),
                    'required' => false,
                ))
            ->add('prezzoVendita', 'text', array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'money'
                    ),
                    'required' => false,
                ))
            ->add('affitto', 'checkbox', array(
                'label' => 'In affitto',
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    ),
                    'required' => false,
                ))
            ->add('prezzoAffitto', 'text', array(
                'label' => 'Affitto mensile',
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'money'
                    ),
                    'required' => false,
                ))
            ->add('trattabili', 'checkbox', array(
                'label' => 'Prezzi trattabili',
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    ),
                    'required' => false,
                ))
            ->add('asta', 'checkbox', array(
                    'label' => 'Asta pubblica',
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'required' => false,
                ))
                ->add('invia', 'submit', array('attr' => array('class' => 'btn btn-default theme-btn')))
                ->setAction($this->generateUrl('scheda_create_due'))
                ->setAttribute('class', 'form_ricerca')
        ;
        return $form->getForm();
    }
      /**
     * @Route("/create_scheda_due", name="scheda_create_due")
     * @Method("POST")
     * @Template()
     */
    public function create_scheda_dueAction() {
        $scheda = new Scheda();
        $contratto = new Contratto();
        $prezzo = new Prezzo();
        $form = $this->createCreateFormdue();
        $form->bind($this->getRequest());
        $data = $form->getData();       
        if($form->isValid()){
           try {
                   $this->getEm()->beginTransaction();

            $scheda->setIndirizzo($data['indirizzo']);
            $scheda->setLocalita($data['localita']);
            $scheda->setLocali($data['locali']);
            $scheda->setCap($data['cap']);
            $scheda->setDescrizione($data['descrizione']);
            $scheda->setDifformita($data['difformita']);
            $scheda->setLat($data['lat']);
            $scheda->setLon($data['lon']);
            $scheda->setTipologia($data['tipologia']);
            $scheda->setAsta($data['asta']);
            $this->persist($scheda);

            $contratto->setDataFirma($data["dataFirma"]);
            $contratto->setProprietario($data["proprietario"]);
            $contratto->setEsclusivita($data["esclusivita"]);
            $contratto->setPullicazioneFoto($data["pullicazioneFoto"]);
            $contratto->setCollaborazioni($data["collaborazioni"]);
            $contratto->setScheda($scheda);
                        $this->persist($contratto);

            
            $prezzo->setVendita($data["vendita"]);
            $prezzo->setAffitto($data["affitto"]);
            $prezzo->setPrezzoVendita($data["prezzoVendita"]);
            $prezzo->setPrezzoAffitto($data["prezzoAffitto"]);
            $prezzo->setTrattabili($data['trattabili']);
            $prezzo->setContratto($contratto);
            $prezzo->setScheda($scheda);
             $this->persist($prezzo);
             
             $contratto->setPrezzo($prezzo);
             $scheda->addPrezzi($prezzo);
             $this->persist($contratto);
             $this->persist($scheda);
$this->getEm()->commit();
        } catch (\Exception $ex) {
            $this->getEm()->rollback();
            throw $ex;
        }
        }
return $this->redirect($this->generateUrl('scheda_caratteristiche', array('id'=>$scheda->getId())));
        
      
    }
    
    
    /**
     * Finds and displays a Scheda entity.
     *
     * @Route("/{id}/caratteristiche", name="scheda_caratteristiche")
     * @Method("GET")
     * @ParamConverter("id", class="CasaFront2Bundle:Scheda")
     * @Template()
     */
    public function caratteristicheAction(Scheda $entity) {
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scheda entity.');
        }

        $gruppi = $entity->getTipologia()->getGruppi();

        return array(
            'entity' => $entity,
            'gruppi' => $gruppi,
        );
    }

    /**
     * Finds and displays a Scheda entity.
     *
     * @Route("/{id}/caratteristiche", name="scheda_caratteristiche_salva")
     * @Method("POST")
     * @ParamConverter("id", class="CasaFront2Bundle:Scheda")
     * @Template("CasaFront2Bundle:Scheda:caratteristiche.html.twig")
     */
    public function caratteristicheSalvaAction(Scheda $entity) {
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scheda entity.');
        }
        $caratteristiche = $this->getParam('caratteristica', array());
        try {
            $this->getEm()->beginTransaction();
            foreach ($entity->getCaratteristiche() as $c) {
                $this->remove($c);
            }
            $entity->getCaratteristiche()->clear();
            $this->persist($entity);
//            \JF\UtilityBundle\Utility\Debug::pr(count($entity->getCaratteristiche()));
            foreach ($caratteristiche as $id => $value) {
                $caratteristica = new \Casa\Front2Bundle\Entity\SchedaCaratteristica();
                $caratteristica->setScheda($entity);
                $caratteristica->setGruppo($this->find('CasaFront2Bundle:Caratteristica', $id));
                $caratteristica->setValue($value);
                $this->persist($caratteristica);
                $entity->addCaratteristiche($caratteristica);
            }
            /* determino se esiste già il proprietario delle caratteristiche dell'immobile su cui sto lavorando, se non esiste vuol dire che starò compilando una scheda nuova */
            $em = $this->getDoctrine()->getManager()->getRepository("CasaFront2Bundle:Contratto")->prop_ex($entity);
   
            $this->getEm()->commit();
            /* se il proprietario è già stato assegnato vuol dire che sarà reindirizzato alla modifica del proprietario, altrimenti significherà che si starà compilando una nuova scheda quindi sarà reindirizzato ad una nuova, appunto, scheda */
            return $this->redirect($this->generateUrl('scheda', array('id' => $entity->getId())));
        } catch (\Exception $ex) {
            $this->getEm()->rollback();
            throw $ex;
        }

        $gruppi = $entity->getTipologia()->getGruppi();

        return array(
            'entity' => $entity,
            'gruppi' => $gruppi,
        );
    }

    /**
     * Creates a form to create a Documento entity.
     *
     * @param Documento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateDocForm(Documento $entity) {
        $form = $this->createForm(new DocumentoType(), $entity, array(
            'action' => $this->generateUrl('scheda-documento_create'),
            'method' => 'POST',
            'attr' => array(
                'class' => 'documento',
            ),
        ));
        $form->add('button', 'button', array('label' => 'Salva', 'attr' => array('class' => 'btn no-display')));
        $form->add('reset', 'reset', array('label' => 'Resetta', 'attr' => array('class' => 'btn no-display')));
        return $form;
    }

    /**
     * Finds and displays a Scheda entity.
     *
     * @Route("/{id}/documenti", name="scheda_documenti")
     * @Method("GET")
     * @Template()
     */
    public function documentiAction($id) {
        $contratto = $this->find('CasaFront2Bundle:Contratto', $id);
        /* @var $contratto Contratto */
        $entity = null;
        /* @var $entity Scheda */
        if (!$contratto) {
            $entity = $this->find('CasaFront2Bundle:Scheda', $id);
            $contratto = $entity->getContratti()->first();
            $con_id = $contratto->getId();
            if (!$contratto) {
                throw $this->createNotFoundException('Unable to find Contratto entity');
            }
        } else {
            $entity = $contratto->getScheda();
        }

        $gruppi = $this->findAll('CasaFront2Bundle:DocumentoGruppo');
       $em = $this->getDoctrine()->getManager();
$query = $em->createQuery(
    'SELECT d
    FROM CasaFront2Bundle:Documento d
    WHERE d.contratto = :con_id'
)->setParameter('con_id', $con_id);

$products = $query->getResult();

        $doc = new Documento();
        $form = $this->createCreateDocForm($doc);

        return array(
            'entity' => $entity,
            'contratto' => $contratto,
            'gruppi' => $gruppi,
            'docu' => $products,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Documento entity.
     *
     * @param Documento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateFotoForm(Foto $entity) {
        $form = $this->createForm(new FotoType(), $entity, array(
            'action' => $this->generateUrl('scheda-foto_create'),
            'method' => 'POST',
            'attr' => array(
                'class' => 'foto',
            ),
        ));
        $form->add('button', 'button', array('label' => 'Salva', 'attr' => array('class' => 'btn no-display')));
        $form->add('reset', 'reset', array('label' => 'Resetta', 'attr' => array('class' => 'btn no-display')));
        return $form;
    }

    /**
     * Finds and displays a Scheda entity.
     *
     * @Route("/{id}/fotografie", name="scheda_fotografie")
     * @Method("GET")
     * @Template()
     */
    public function fotografieAction($id) {
        $contratto = $this->find('CasaFront2Bundle:Contratto', $id);
        /* @var $contratto Contratto */
        $entity = null;
        /* @var $entity Scheda */
        if (!$contratto) {
            $entity = $this->find('CasaFront2Bundle:Scheda', $id);
            $contratto = $entity->getContratti()->first();
            if (!$contratto) {
                throw $this->createNotFoundException('Unable to find Contratto entity');
            }
        } else {
            $entity = $contratto->getScheda();
        }

        $foto = new Foto();
        $foto->setContratto($contratto->getId());
        $form = $this->createCreateFotoForm($foto);

        return array(
            'entity' => $entity,
            'contratto' => $contratto,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Scheda entity.
     *
     * @Route("/{id}", name="scheda_show")
     * @Method("GET")
     * @ParamConverter("id", class="CasaFront2Bundle:Scheda")
     * @Template()
     */
    public function showAction(Scheda $entity) {
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scheda entity.');
        }

        return array(
            'entity' => $entity,
        );
    }
    /**
     * Change scheda in evidenza.
     *
     * @Route("/posta/{id}", name="scheda_evidenza", options={"expose"=true})
     * ParamConverter("id", class="CasaFront2Bundle:Scheda")
     * @Method("POST")
     */
    public function scheda_evidenzaAction($id) {
        $ris = "ok";
        $vai = $this->getDoctrine()->getManager();
        $em = $vai->getRepository("CasaFront2Bundle:Scheda")->find($id);
        $ris = $em->getEvidenza();
        if($ris){
            $ris = 0;
        $em->setEvidenza(0);
        }else {
         $ris = 1;
        $em->setEvidenza(1);
    }
    $vai->flush();
        return new Response($ris);

    }
        /**
     * Change scheda in pubblicazione.
     *
     * @Route("/posta_pub/{id}", name="scheda_pubblicazione_tre", options={"expose"=true})
     * ParamConverter("id", class="CasaFront2Bundle:Scheda")
     * @Method("POST")
     */
    public function scheda_pubblicazioneAction($id) {
$ris = "ok";
        $vai = $this->getDoctrine()->getManager();
        $em = $vai->getRepository("CasaFront2Bundle:Scheda")->find($id);
        $ris2 = $em->getPubblicazione();
          if($ris2){
            $ris2 = 0;
       $em->setPubblicazione(0);
        }else {
         $ris2 = 1;
      $em->setPubblicazione(1);
    }
    $vai->flush();
        return new Response($ris2);

    }
        /**
     * Change esclusivita.
     *
     * @Route("/scheda_esc/{id}", name="scheda_esclusiva", options={"expose"=true})
     * ParamConverter("id", class="CasaFront2Bundle:Contratto")
     * @Method("POST")
     */
    public function scheda_esclusivaAction($id) {
        $ris = "ok";
        $vai = $this->getDoctrine()->getManager();
        $em = $vai->getRepository("CasaFront2Bundle:Contratto")->find($id);
        $ris = $em->getEsclusivita();
        if($ris){
            $ris = 0;
        $em->setEsclusivita(0);
        }else {
         $ris = 1;
        $em->setEsclusivita(1);
    }
    $vai->flush();
        return new Response($ris);

    }
        /**
     * Change esclusivita.
     *
     * @Route("/scheda_asta/{id}", name="scheda_asta", options={"expose"=true})
     * ParamConverter("id", class="CasaFront2Bundle:Contratto")
     * @Method("POST")
     */
    public function scheda_astaAction($id) {
        $ris = "ok";
        $vai = $this->getDoctrine()->getManager();
        $em = $vai->getRepository("CasaFront2Bundle:Scheda")->find($id);
        $ris = $em->getAsta();
        if($ris){
            $ris = 0;
        $em->setAsta(0);
        }else {
         $ris = 1;
        $em->setAsta(1);
    }
    $vai->flush();
        return new Response($ris);

    }
    /**
     * Displays a form to edit an existing Scheda entity.
     *
     * @Route("/{id}/edit", name="scheda_edit")
     * @Method("GET")
     * @ParamConverter("id", class="CasaFront2Bundle:Scheda")
     * @Template()
     */
    public function editAction(Scheda $entity) {
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scheda entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Scheda entity.
     *
     * @param Scheda $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Scheda $entity) {
        $form = $this->createForm(new SchedaType(), $entity, array(
            'action' => $this->generateUrl('scheda_update', array('id' => $entity->getId())),
            'attr' => array('class' => 'contratto'),
            'method' => 'PUT',
        ));

        $form->add('submit', 'button', array('label' => 'Salva', 'attr' => array('class' => 'btn')));

        return $form;
    }

    /**
     * Edits an existing Scheda entity.
     *
     * @Route("/{id}", name="scheda_update")
     * @Method("PUT")
     * @ParamConverter("id", class="CasaFront2Bundle:Scheda")
     * @Template("CasaFront2Bundle:Scheda:edit.html.twig")
     */
    public function updateAction(Scheda $entity) {
        $request = $this->getRequest();
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scheda entity.');
        }
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $this->persist($entity);

            return $this->redirect($this->generateUrl('scheda'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }


}

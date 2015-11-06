<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ContrattoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContrattoRepository extends EntityRepository {

    public function annunci($id, $mode, $agenzia = null) {
        $qb = $this->createQueryBuilder('c')
                ->leftJoin('c.scheda', 's')
                ->leftJoin('s.tipologia', 't')
                ->where('t.categoria = :id')
                ->setParameter('id', $id)
        ;
        switch ($mode) {
            case 'vendita':
                $qb->leftJoin('c.prezzo', 'p')
                        ->andWhere('p.vendita = :true')
                        ->orderBy('p.prezzoVendita', 'ASC')
                        ->setParameter('true', true)
                ;
                break;
            case 'affitto':
                $qb->leftJoin('c.prezzo', 'p')
                        ->andWhere('p.affitto = :true')
                        ->orderBy('p.prezzoAffitto', 'ASC')
                        ->setParameter('true', true)
                ;
                break;
            default:
                $qb->leftJoin('c.prezzo', 'p')
                ->orderBy('p.prezzoAffitto, p.prezzoVendita','ASC')
                ;
        }
        if ($agenzia) {
            $qb->andWhere('c.agenzia = :agenzia')
                    ->setParameter('agenzia', $agenzia)
            ;
        }
        return $qb; //->getQuery()->execute();
    }
    /* scegli se accedere alla scheda nuovo proprietario o modifica proprietario quando sono nelle caratteristiche premo su salve. Se il proprietario è esistente accedo alla scheda modifica, altrimenti nuova */
   public function prop_ex($entity){
       $query = $this->createQueryBuilder("s")->leftJoin("s.scheda", "c")->where("c.id = :id")->andWhere("s.proprietario IS NOT NULL")->andWhere("s.proprietario != ''")->setParameter("id", $entity)->getQuery()->getResult();
  $conto = count($query);
  return $conto;
       

       
   }
   public function last_annunci($contratto = 'vendita') {
        
   
        $qb2 = $this->createQueryBuilder('q')
                ->leftJoin('q.scheda','r')
                ->leftJoin('q.foto','i')
                ->leftJoin('q.prezzo','p')
                ->leftJoin('r.tipologia','t')
                ->leftJoin('t.categoria','c')
                ->where('r.evidenza = :evi')
                ->setParameter('evi', 1)
                ->orderBy('i.id','DESC')
        ;
 
        if($contratto == 'vendita'){
            $qb2->andWhere('p.vendita=1')
                    ->setFirstResult(0);
        }
        else if($contratto == 'asta'){
            $qb2->andWhere('r.asta=1')
                    ->setFirstResult(0);
        }else{
            $qb2->andWhere('p.affitto=1')
                    ->setFirstResult(0);
        }
     
       $ris = $qb2->getQuery()
              ->execute(); //->getQuery()->execute();
       $arr = array();
       foreach($ris as $risult){
              if($contratto == 'vendita'){
            $prezzo = $risult->getPrezzo()->getPrezzoVendita();
        }
        else if($contratto == 'asta'){
            $prezzo = $risult->getPrezzo()->getPrezzoVendita();
        }else{
            $prezzo = $risult->getPrezzo()->getPrezzoAffitto();
        }
           $foto_exist2 = false;
           $foto_exist = $risult->getFotoPrincipale() ? $risult->getFotoPrincipale()->getFile() : false;
           /* ci sono due percorsi immagini*/
           /* verifica l'esistenza dell'immagine principale secondo il vecchio percorso prima delle modifiche apportate con l'inserimento del drag and drop */
           if(!file_exists($foto_exist))
               $foto_exist2 = false;
           /* verifica dell'esistenza dell'immagine principale secondo il nuovo percorso stabilito da Ephraim dopo l'inserimento del drag and drop. Se non trova alcuna foto principale nemmeno ora rimane '$foto_exist2 = false' e quindi verrà mostrata
            * l'immagine sostituitiva "immagine non disponibile" */
           if(file_exists("uploads/gallery/thumbnail/".$foto_exist))
               $foto_exist2 = "uploads/gallery/thumbnail/".$foto_exist;
           
           $arr[] = array(
               'id' => $risult->getId(),
               'title' => $risult->__toString(),
               'foto' => $foto_exist2,
               'prezzo' => $prezzo,
               'cate' => $risult->getScheda()->getTipologia()->getCategoria()->getId(),
               'tipo' => $risult->getScheda()->getTipologia(),
               'id_scheda' => $risult->getScheda()->getId(),
                   
           );
           
       }
       return array('immo'=> $arr);
    }

    
        public function last_annunci_due() {
        $qb2 = $this->createQuery(
    'SELECT p
    FROM CasaFront2Bundle:Contratto p 
    left join CasaFront2Bundle:Foto f on
    f.contratto=p.id
    WHERE f.principale = :mi
    ORDER BY f.id ASC'
)->setParameter('mi', 1);
        return $qb2->getQuery()
              ->getResult(); //->getQuery()->execute();
    }

    /**
     * 
     * @param type $data
     * @param type $agenzia
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function ricerca($data, $agenzia = null) {
        $qb = $this->createQueryBuilder('c');
        $leftJoin = array();
        /*if ($data["localita"]) {
            $qb->leftJoin('c.scheda', 's')
                    ->andWhere('s.localita = :localita')
                    ->setParameter('localita', substr($data["localita"], 0, strlen($data['localita']) - 5));
            $leftJoin[] = 's';
        }*/
        if ($data["categoria"]) {
            if(!in_array('s', $leftJoin)) {
                $qb->leftJoin('c.scheda', 's');    
                $leftJoin[] = 's';
            }
            if ($data["tipologia"]) {
                $qb->andWhere('s.tipologia = :tipologia')->setParameter("tipologia", $data["tipologia"]->getId());
            } else {
                $qb->leftJoin('s.tipologia', 't')->andWhere('t.categoria = :categoria')->setParameter("categoria", $data["categoria"]->getId());
                $leftJoin[] = 't';
            }
        }

        if ($data["tipo_contratto"]) {
            switch ($data["tipo_contratto"]) {
                case 'v':
                    $qb->leftJoin('c.prezzo', 'p')
                            ->andWhere('p.vendita = :true')
                            ->orderBy('p.prezzoVendita', 'ASC')
                            ->setParameter('true', true)
                    ;
                    $leftJoin[] = 'p';
                    if($data["prezzo_vendita"]){
                        $qb->andWhere('p.prezzoVendita <= :prezzo_vendita')->setParameter("prezzo_vendita", $data["prezzo_vendita"]);
                    }
                    break;
                case 'a':
                    $qb->leftJoin('c.prezzo', 'p')
                            ->andWhere('p.affitto = :true')
                            ->orderBy('p.prezzoAffitto', 'ASC')
                            ->setParameter('true', true)
                    ;
                    $leftJoin[] = 'p';
                    if($data["prezzo_affitto"]){
                        $qb->andWhere('p.prezzoAffitto <= :prezzo_affitto')->setParameter("prezzo_affitto", $data["prezzo_affitto"]);
                    }
                    break;
            }
        }

    

        
        if ($agenzia) {
            $qb->andWhere('c.agenzia = :agenzia')
                    ->setParameter('agenzia', $agenzia)
            ;
        }
        return $qb; //->getQuery()->execute();
    }

}
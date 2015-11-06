<?php 
$link = 2;
$lingua = "it";
$title_tag = "Cani Dobermann: maschi, femmine e campioni";
$description_tag = "Lista dei cani Dobermann nell'allevamento Di Casa Fox, suddivisi in maschi, femmine e campioni";
require_once("inc/header.inc"); ?>
<!-- Bread crump -->
 
<ul class="breadcrumb text-left">
  <li>Sei qui: <a href="index.php">Home</a></li>
  <li><a href="cuccioli_maschi_femmine.php">Dobermann</a></li>
</ul>
<span class="clearfix"></span>
<h1>Dobermann del nostro allevamento </h1> 
<section class="col-sm-12">
    <h5>Fai lo scrolling con la rotella di scorrimento del mouse sulle gallerie sotto per vedere i cani successivi</h5>
  </section>
<section class="cont_dob">
<ul class="nav nav-tabs nav-justified">
  <li class="active"><a href="#tab-1" data-toggle="tab">Maschi</a></li>
  <li><a href="#tab-2" data-toggle="tab">Femmine</a></li>
  <li><a href="#tab-3" data-toggle="tab">Campioni</a></li>
</ul>
  
  <div class="tab-content">
      <section class="col-sm-12 scroll_img tab-pane active" id="tab-1">
      
      <!-- Titolo sotto che verrà mostrato solo ai cellulari o schermi di dimensione ridotta -->
      <h3 class="header_gallery">Maschi</h4>
       <?php 
$query = mysql_query("select id, nome, description, testo from cani where maschio=1 and proprieta=1 order by nome asc");
while($result = mysql_fetch_assoc($query)){
extract($result);
$first_image = 0;
$find_image = mysql_query("select foto_cani.immagine from foto_cani where cane=$id and evidenza=1");
while($find_im = mysql_fetch_assoc($find_image)){
	extract($find_im);
	
// qui indico che venga salvata nella variabile solo la prima immagine perché solo quella voglio mostrare
if($first_image==0){
$img = $immagine;
$first_image++;
}
	}
// se la foto non fosse disponibile inserisco l'immagine opportuna
if(mysql_num_rows($find_image)==0)
$img = "img-non-disp2.jpg";
echo "<article class='col-sm-12 gal_cane2'><article class='col-sm-4 col-ie-7-4'><a href='scheda_cane_dobermann.php?cane=$id' target='blank'><img src='images/dobermann/".$img."' class='img-responsive img-rounded'/></a></article><article class='col-sm-7' ><h5 class='tt_dob'>".$nome."</h5>";
if($description=="")
echo strip_tags(substr($testo,0,250));
 else 
 echo $description;
 echo "<div class='link_dt'><a href='scheda_cane_dobermann.php?cane=$id' target='_blank'> --> SCHEDA TECNICA COMPLETA, PEDIGREE E FOTO GALLERY QUI <-- </a></div></article></article>";
	}


?>
                 
    <!-- Galleria maschi -->

  </section> 
  <section class="col-sm-12 scroll_img tab-pane" id="tab-2">
     <h3 class="header_gallery">Femmine</h4>
            
    <?php 
	$query = mysql_query("select id, nome, testo, description from cani where femmina=1 and proprieta=1 order by nome asc");
while($result = mysql_fetch_assoc($query)){
extract($result);
$first_image = 0;
$find_image = mysql_query("select foto_cani.immagine from foto_cani where cane=$id and evidenza=1");
while($find_im = mysql_fetch_assoc($find_image)){
	extract($find_im);
if($first_image==0){
$img = $immagine;
$first_image++;
}
	} 
if(mysql_num_rows($find_image)==0)
$img = "img-non-disp2.jpg";
echo "<article class='col-sm-12 gal_cane2'><article class='col-sm-4 col-ie-7-4'><a href='scheda_cane_dobermann.php?cane=$id' target='blank'><img src='images/dobermann/".$img."' class='img-responsive img-rounded'/></a></article><article class='col-sm-7' ><h5 class='tt_dob'>".$nome."</h5>";
if($description=="")
echo strip_tags(substr($testo,0,250));
 else 
 echo $description;
 echo "<div class='link_dt'><a href='scheda_cane_dobermann.php?cane=$id' target='_blank'> --> SCHEDA TECNICA COMPLETA, PEDIGREE E FOTO GALLERY QUI <-- </a></div></article></article>";
		}

?>

  </section>
  <section class="col-sm-12 scroll_img tab-pane" id="tab-3">
     <h3 class="header_gallery">Campioni</h3>
      <?php 
	$query = mysql_query("select id, nome, testo, description from cani where campioni=1 and proprieta=1 order by nome asc");
while($result = mysql_fetch_assoc($query)){
extract($result);
$first_image = 0;
$find_image = mysql_query("select foto_cani.immagine from foto_cani where cane=$id and evidenza=1");
while($find_im = mysql_fetch_assoc($find_image)){
	extract($find_im);
if($first_image==0){
$img = $immagine;
$first_image++;
}
	} 
if(mysql_num_rows($find_image)==0)
$img = "img-non-disp2.jpg";
	
echo "<article class='col-sm-12 gal_cane2'><article class='col-sm-4 col-ie-7-4'><a href='scheda_cane_dobermann.php?cane=$id' target='blank'><img src='images/dobermann/".$img."' class='img-responsive img-rounded'/></a></article><article class='col-sm-7' ><h5 class='tt_dob'>".$nome."</h5>";
if($description=="")
echo strip_tags(substr($testo,0,250));
 else 
 echo $description;
 echo "<div class='link_dt'><a href='scheda_cane_dobermann.php?cane=$id' target='_blank'> --> SCHEDA TECNICA COMPLETA, PEDIGREE E FOTO GALLERY QUI <-- </a></div></article></article>";
	}

?>

  </section>
<div class="clearfix"></div>
  </div>
<div class="clearfix"></div>
     
     <?php 
require_once("inc/footer.inc"); ?>

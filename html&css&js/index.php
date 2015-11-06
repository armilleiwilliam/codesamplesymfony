<?php 
$link = 1;
$lingua = "it";
$title_tag =  "Allevamento Dobermann alto pedigree e vendita cuccioli (Livorno)";
$description_tag = "Vendita e allevamento di cani (cuccioli o adulti) Dobermann con elevato Pedigree ";
if($lingua == "en")
$title = "Dobermann Kennel and breeding, puppies sale (Livorno)";

require_once("inc/header.inc"); ?>

<div class="img_home_top"><img src="image/dobermann_central_home.jpg" class="img-responsive" /></div>
<h1>
Allevamento Dobermann e vendita cuccioli
</h1>
<article class="col-sm-6 col-ie-7">
<h3>Chi Siamo</h3>
<div class="col-sm-12"><img src="images/dobermann_home1.jpg" class="img-responsive thumbnail" style="float:left;width:40%;margin-right:15px;" /><p>L&rsquo;allevamento &ldquo;Di Casa Fox Dobermann&rdquo; nasce dalla passione di Stefano Sardelli per questa meravigliosa razza, passione che comincia con l&rsquo;acquisto, nel 1993, quando era ancora un ragazzo, del suo primo Dobermann in un allevamento in Toscana.</p>
Negli anni successivi, grazie al lavoro svolto con professionalit&agrave;, l&rsquo;allevamento ottiene il riconoscimento ENCI ed FCI con l&rsquo;affisso &ldquo;DI CASA FOX&rsquo;.
<br/><br/>
</div>
<h3>Alleviamo e vendiamo Dobermann e offriamo servizio di pensione per cani</h3>
<p>Selezioniamo per carattere, salute e bellezza i nostri cani per potervi dare il meglio. La nostra struttura, sita tra le colline di Collesalvetti (Livorno), istruisce il cucciolo fin dalla sua nascita, <b>infatti accoglie al suo interno, oltre a box di ultima generazione, un ampio e confortevole parco giochi in sabbia per i cuccioli e un campo di addestramento in erba (vedi slideshow sotto)</b> per aiutarli a diventare adulti e quindi inserirsi al meglio nella nostra societ&agrave;. </p>
<p>La nostra struttura, regolarizzata a norme USL, &egrave; affiliata allo CSEN con l&rsquo;<u>associazione sportiva FOXDOGCENTER che sar&agrave; lieta, per tutti coloro che desidereranno essere soci, di accogliere e prendersi cura dei vostri cani in pensione</u>.</p></article><article class="col-sm-6 col-ie-7"><h3>Oltre alla vendita di cuccioli offriamo anche i seguenti servizi:</h3>

<ul>
<li>Imprinting e socializzazione del cucciolo</li>
<li>Educazione di base</li>
<li>Riabilitazione cani problematici</li>
<li>Obbedienza</li>
<li>Preparazione di cani da utilit&agrave; e difesa<ul style="margin-left:30px;">
<li>SELEZIONE</li>
<li>ZTP</li>
<li>BREVETTI ENCI - FCI (Enci2 - IpoV- Ipo 1.2.3. Ecc..)</li>
</ul></li>
<li>Preparazione cani da expo (presentazione da ring e allenamento fisico)</li>
<li>AGILITY</li></ul>
<h3>Conttataci per ricevere maggiori informazioni sui nostri servizi:</h3><br />
<div class="alert alert-info text-center"><span class="glyphicon glyphicon-phone-alt"></span> Tel. +39-3332654996</div>
<div class="alert alert-info text-center"><span class="glyphicon glyphicon-envelope"></span> Email: dicasafox@virgilio.it</div>
 <h3 class='text-center' style='border-top:2px groove;padding:10px;'><a href="scheda_cane_dobermann.php?cane=49" target="_blank">Kora di Casa Fox</a>: primo dobermann nato e allevato in Italia a confermare la K&#246;rung a vita</h3>

</article>

<div class="clearfix"></div>
<article class="col-sm-6 panel panel-default col-ie-7">
<h3 class="hd_news" >News</h3>
<table class="table table-bordered">
<?php 
$news = $conn->query("select id, titolo, data, permalink from news order by id desc limit 0,8"); 
$list = 1;
while($result = mysql_fetch_array($news)){
extract($result);
echo "<tr><td>".date("d/m/Y",$data)."</td><td><a href='news.php#$id' target='_blank'>$titolo</a></td></tr>";
$list++;

};

?>

</table>
</article><article class="col-sm-6 text-left col-ie-7">
 
<div style="max-width:487px;margin:0 auto;">
	<!-- Start VisualSlideShow.com BODY section -->
	<div id="show" class="slideshow">
	<div class="slideshow-images">
<a href=""><img id="slide-0" src="data/images/1.jpg" alt="1" title="1" /></a>
<a href=""><img id="slide-1" src="data/images/4.jpg" alt="4" title="4" /></a>
<a href=""><img id="slide-2" src="data/images/3.jpg" alt="3" title="3" /></a>
<a href=""><img id="slide-3" src="data/images/2.jpg" alt="2" title="2" /></a>
</div>
<a id="vlb" href="http://visualslideshow.com">Picture Slideshow by VisualSlideshow.com v1.6m</a>
	</div>
	<!-- End VisualSlideShow.com BODY section -->
</div>


</article>
<article class="col-sm-12 bottom-home">
<h2 class="text-center">I nostri Dobermann</h2>
<div class="col-sm-4 text-center col-ie-7-4">
<h3>Maschi</h3>
<a href="campioni_maschi_femmine.php" target="_blank"><img src="image/maschi.jpg" class="img-responsive" style="margin:0 auto;"/></a>

</div>
<div class="col-sm-4 text-center col-ie-7-4">
<h3>Femmine</h3>
<a href="campioni_maschi_femmine.php" target="_blank"><img src="image/femmine.jpg" class="img-responsive" style="margin:0 auto;"/></a>

</div>
<div class="col-sm-4 text-center col-ie-7-4">
<h3>Cuccioli</h3>
<a href="cuccioli.php" target="_blank"><img src="image/cuccioli.jpg" class="img-responsive" style="margin:0 auto;"/></a>

</div>
</article>

<?php 
require_once("inc/footer.inc"); ?>

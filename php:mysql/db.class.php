<?php 

class db {
public $dbconn;
public $user;
public $host;
public $pass;
public $dbase;
public $myquery;
public $error;
public $risult;

function __construct(){
$this->user = DB_USER;
$this->host = DB_HOST;
$this->pass = DB_PASS;
$this->dbase = DB_NAME;
	}
function connect(){
$this->dbconn = mysql_connect($this->host,$this->user,$this->pass) or die("Impossibile accedere al database");
mysql_select_db($this->dbase);
	}
function prepare($query){
$this->myquery = mysql_query($query);
return $this->myquery;

	}
function numrows($query){
return mysql_num_rows($this->myquery);
	}
function disconnect(){
mysql_close($this->dbconn);
	}
function num_limit_database($page_num, $tabella = "cani"){
$this->risult = $this->prepare("select id from $tabella");
return ceil($this->numrows($this->risult)/$page_num);


}

// ZTP 
function inserisci_ztp(){
if(isset($_POST["titolo"])&&$_POST["titolo"]!=""){
$titolo = ($_POST["titolo"]!="")?trim($_POST["titolo"]):"";
$titolo_en = ($_POST["titolo_en"]!="")?trim($_POST["titolo_en"]):"";
$desc = ($_POST["desc_lt"]!="")?trim($_POST["desc_lt"]):"";
$desc_en = ($_POST["desc_lt_en"]!="")?trim($_POST["desc_lt_en"]):"";
$cane = $_POST["cane"];
$query5 = mysql_query("insert into ztp values(null,$cane,'','','','','$titolo','$titolo_en','$desc','$desc_en','','')");
return $query5;

}
}
function modifica_ztp(){
if(isset($_POST["titolo"])&&$_POST["titolo"]!=""){
$id_ztp = $_GET["mod_ztp"];
$titolo = ($_POST["titolo"]!="")?trim($_POST["titolo"]):"";
$titolo_en = ($_POST["titolo_en"]!="")?trim($_POST["titolo_en"]):"";
$desc = ($_POST["desc_lt"]!="")?trim($_POST["desc_lt"]):"";
$desc_en = ($_POST["desc_lt_en"]!="")?trim($_POST["desc_lt_en"]):"";
$cane = $_POST["cane"];
$query5 = mysql_query("update ztp set cane=$cane, titolo='$titolo', titolo_en='$titolo_en', testo='$desc', testo_en='$desc_en' where id=$id_ztp");
return $query5;

}
}
function dettagli_ztp($ztp){
$query = $this->prepare("select * from ztp where id=$ztp");
if($query)
$ris = mysql_fetch_array($query);
return $ris;
}
// DOBERMANN
function inserisci(){
if(isset($_POST["name"])&&$_POST["name"]!=""){
$nome = (!empty($_POST["name"])&&$_POST["name"]!="")?$_POST["name"]:"";
$padre = (!empty($_POST["padre"])&&$_POST["padre"]!="")?$_POST["padre"]:"";
$madre = (!empty($_POST["madre"])&&$_POST["madre"]!="")?$_POST["madre"]:"";
$proprietario = (!empty($_POST["proprietario"])&&$_POST["proprietario"]!="")?$_POST["proprietario"]:"";
$desc_lt = (!empty($_POST["desc_lt"])&&$_POST["desc_lt"]!="")?$_POST["desc_lt"]:"";
$desc_lt_en = (!empty($_POST["desc_lt_en"])&&$_POST["desc_lt_en"]!="")?$_POST["desc_lt_en"]:"";
$desc = (!empty($_POST["desc"])&&$_POST["desc"]!="")?$_POST["desc"]:"";
$desc_en = (!empty($_POST["desc_en"])&&$_POST["desc_en"]!="")?$_POST["desc_en"]:"";
$sesso = $_POST["sesso"];
if($sesso==1){
$maschio = 1;
$femmina = 0;
}else{
$maschio = 0;
$femmina = 1;
}
$dicasa = (isset($_POST["dicasa"]))?1:0;
$promessa = (isset($_POST["promessa"]))?1:0;
$campione = (isset($_POST["campione"]))?1:0;
$riproduttore = (isset($_POST["riproduttore"]))?1:0;
$cuccioli = (isset($_POST["cuccioli"]))?1:0;
$data = explode("/",$_POST["data_birth"]);
$data = $data[2]."-".$data[1]."-".$data[0];
$nonno1 = $_POST["nonno1"];
$nonno2 = $_POST["nonno2"];
$nonno3 = $_POST["nonno3"];
$nonno4 = $_POST["nonno4"];
$bis1 = $_POST["bis1"];
$bis2 = $_POST["bis2"];
$bis3 = $_POST["bis3"];
$bis4 = $_POST["bis4"];
$bis5 = $_POST["bis5"];
$bis6 = $_POST["bis6"];
$bis7 = $_POST["bis7"];
$bis8 = $_POST["bis8"];
$tris1 = $_POST["tris1"];
$tris2 = $_POST["tris2"];
$tris3 = $_POST["tris3"];
$tris4 = $_POST["tris4"];
$tris5 = $_POST["tris5"];
$tris6 = $_POST["tris6"];
$tris7 = $_POST["tris7"];
$tris8 = $_POST["tris8"];
$tris9 = $_POST["tris9"];
$tris10 = $_POST["tris10"];
$tris11 = $_POST["tris11"];
$tris12 = $_POST["tris12"];
$tris13 = $_POST["tris13"];
$tris14 = $_POST["tris14"];
$tris15 = $_POST["tris15"];
$tris16 = $_POST["tris16"];
$video = $_POST["video"];
$query_ins = mysql_query("insert into cani values(null,\"$nome\",\"$proprietario\",\"$padre\",\"$madre\",\"$nonno1\",\"$nonno2\",\"$nonno3\",\"$nonno4\",\"$bis1\",\"$bis2\",\"$bis3\",\"$bis4\",\"$bis5\",\"$bis6\",\"$bis7\",\"$bis8\",\"$tris1\",\"$tris2\",\"$tris3\",\"$tris4\",\"$tris5\",\"$tris6\",\"$tris7\",\"$tris8\",\"$tris9\",\"$tris10\",\"$tris11\",\"$tris12\",\"$tris13\",\"$tris14\",\"$tris15\",\"$tris16\",'$desc','$desc_en','$data',\"$title\",\"$title_en\",\"$desc_lt\",\"$desc_lt_en\",'','',$dicasa,$maschio,$femmina,$cuccioli,$promessa,$campione,$riproduttore,'$video')");
return $query_ins;
}
}	
function dettagli_cane($cane){
$query = $this->prepare("select * from cani where id=$cane");
if($query)
$ris = mysql_fetch_array($query);
return $ris;
}
function canc_foto_from_database($foto){
$canc_foto_from_data = $this->prepare("delete from foto_cani where immagine='$foto'");
return mysql_error();
}
function modifica_cane($cane){
if(isset($_POST["name"])&&$_POST["name"]!=""){
$nome = trim($_POST["name"]);
$padre = trim($_POST["padre"]);
$madre = trim($_POST["madre"]);
$proprietario = trim($_POST["proprietario"]);
$testo = $_POST["desc_lt"];
$testo_en = $_POST["desc_lt_en"];
$description = $_POST["desc"];
$description_en = $_POST["desc_en"];
$sesso = $_POST["sesso"];
$video = $_POST["video"];
if($sesso==1){
$maschio = 1;
$femmina = 0;
}else{
$maschio = 0;
$femmina = 1;
}
$proprieta = (isset($_POST["dicasa"]))?1:0;
$promesse = (isset($_POST["promessa"]))?1:0;
$campioni = (isset($_POST["campione"]))?1:0;
$riproduttore = (isset($_POST["riproduttore"]))?1:0;
$cuccioli = (isset($_POST["cuccioli"]))?1:0;
$data = explode("/",$_POST["data_birth"]);
$data_nascita = $data[2]."-".$data[1]."-".$data[0];
$nonno1 = $_POST["nonno1"];
$nonno2 = $_POST["nonno2"];
$nonno3 = $_POST["nonno3"];
$nonno4 = $_POST["nonno4"];
$bis1 = $_POST["bis1"];
$bis2 = $_POST["bis2"];
$bis3 = $_POST["bis3"];
$bis4 = $_POST["bis4"];
$bis5 = $_POST["bis5"];
$bis6 = $_POST["bis6"];
$bis7 = $_POST["bis7"];
$bis8 = $_POST["bis8"];
$tris1 = $_POST["tris1"];
$tris2 = $_POST["tris2"];
$tris3 = $_POST["tris3"];
$tris4 = $_POST["tris4"];
$tris5 = $_POST["tris5"];
$tris6 = $_POST["tris6"];
$tris7 = $_POST["tris7"];
$tris8 = $_POST["tris8"];
$tris9 = $_POST["tris9"];
$tris10 = $_POST["tris10"];
$tris11 = $_POST["tris11"];
$tris12 = $_POST["tris12"];
$tris13 = $_POST["tris13"];
$tris14 = $_POST["tris14"];
$tris15 = $_POST["tris15"];
$tris16 = $_POST["tris16"];
$this->risult = $this->prepare("UPDATE cani SET nome = \"$nome\", proprietario = \"$proprietario\", madre = \"$madre\", padre = \"$padre\", nonno1 = \"$nonno1\", nonno2 = \"$nonno2\", nonno3 = \"$nonno3\", nonno4 = \"$nonno4\", bis1 = \"$bis1\", bis2 = \"$bis2\", bis3 = \"$bis3\", bis4 = \"$bis4\", bis5 = \"$bis5\", bis6 = \"$bis6\", bis7 = \"$bis7\", bis8 = \"$bis8\", tris1 = \"$tris1\", tris2 = \"$tris2\", tris3 = \"$tris3\", tris4 = \"$tris4\", tris5 = \"$tris5\", tris6 = \"$tris6\", tris7 = \"$tris7\", tris8 = \"$tris8\", tris9 = \"$tris9\", tris10 = \"$tris10\", tris11 = \"$tris11\", tris12 = \"$tris12\", tris13 = \"$tris13\", tris14 = \"$tris14\", tris15 = \"$tris15\", tris16 = \"$tris16\", testo = '$testo', testo_en = '$testo_en', data_nascita = '$data_nascita', description = '$description', description_en = '$description_en', proprieta = '$proprieta', maschio = '$maschio', femmina = '$femmina', promesse = '$promesse', campioni = '$campioni', riproduttore = '$riproduttore', video = '$video' where id=$cane");
return $this->risult;
}
}

// ADDESTRAMENTO
function inserisci_addestramento(){
if(isset($_POST["titolo"])&&$_POST["titolo"]!=""){
$titolo = ($_POST["titolo"]!="")?trim($_POST["titolo"]):"";
$titolo_en = ($_POST["titolo_en"]!="")?trim($_POST["titolo_en"]):"";
$desc = ($_POST["desc_lt"]!="")?trim($_POST["desc_lt"]):"";
$desc_en = ($_POST["desc_lt_en"]!="")?trim($_POST["desc_lt_en"]):"";
$query5 = mysql_query("insert into addestramento values(null,'','','','','$titolo','$titolo_en','$desc','$desc_en','','','')");
return $query5;

}
}
function modifica_addestramento(){
if(isset($_POST["titolo"])&&$_POST["titolo"]!=""){
$id_addestramento = $_GET["mod_addestramento"];
$titolo = ($_POST["titolo"]!="")?trim($_POST["titolo"]):"";
$titolo_en = ($_POST["titolo_en"]!="")?trim($_POST["titolo_en"]):"";
$desc = ($_POST["desc_lt"]!="")?trim($_POST["desc_lt"]):"";
$desc_en = ($_POST["desc_lt_en"]!="")?trim($_POST["desc_lt_en"]):"";
$cane = $_POST["cane"];
$query5 = mysql_query("update addestramento set titolo='$titolo', titolo_en='$titolo_en', testo='$desc', testo_en='$desc_en' where id=$id_addestramento");
return $query5;

}
}
function dettagli_addestramento($addestramento){
$query = $this->prepare("select * from addestramento where id=$addestramento");
if($query)
$ris = mysql_fetch_array($query);
return $ris;
}
function galleria_img($image_id, $tipo = "cani"){
if($tipo == "cani")
$this->risult = $this->prepare("select * from foto_cani where cane=$image_id");
if($tipo == "addestramento")
$this->risult = $this->prepare("select * from addestramento where id=$image_id and immagine!=''");
if($tipo == "cucciolata")
$this->risult = $this->prepare("select * from foto_cuccioli where cucciolata=$image_id");
if($tipo == "news")
$this->risult = $this->prepare("select * from news where id=$image_id and immagine!=''");
if($this->numrows($this->risult)>0)
return $this->risult;
else
return "no";
}
// ACCOPPIAMENTI 

function riproduttori($sesso, $genitore = ""){
$this->risult = $this->prepare("select id, nome from cani where $sesso=1 order by nome");
while($ris = mysql_fetch_array($this->risult)){
extract($ris);
echo "<option value='$id'";
if($genitore==$id) echo " selected ";
echo ">$nome</option>";
}
}
function inserisci_accoppiamento(){
if(isset($_POST["data_birth"])&&$_POST["data_birth"]!=""){
$testo = ($_POST["desc_lt"]!="")?trim($_POST["desc_lt"]):"";
$testo_en = ($_POST["desc_lt_en"]!="")?trim($_POST["desc_lt_en"]):"";
$padre = $_POST["maschio"];
$madre = $_POST["femmina"];
$data = explode("/",$_POST["data_birth"]);
$data = $data[2]."-".$data[1]."-".$data[0];
/*$alphaB = array("A","B","C","D","E","F","G","H","I","L","M","N","O","P","Q","R","S","T","U","V","Z"); 
$last_element = $this->prepare("select let from accoppiamenti order by id desc limit 0,1");
$let = mysql_fetch_array($last_element);
extract($let);
foreach($alphaB as $key=>$alpha){
if($alpha==$let){
$lettera = $alphaB[$key+1];
if($alphaB[$key]=="Z")
$lettera = "A";}
}*/
$let = trim($_POST["let"]);
$lista = trim($_POST["lista"]);
$query5 = mysql_query("insert into accoppiamenti values(null,'$data','$testo','$testo_en','','','','','','',$padre,$madre,'$let',$lista)");
return $query5;

}
}
function dettagli_accoppiamento($accoppiamento){
$query = $this->prepare("select DATE_FORMAT(data,'%d/%c/%Y'), padre, madre, let, lista, testo_en, testo, id from accoppiamenti where id=$accoppiamento");
if($query)
$ris = mysql_fetch_array($query);
return $ris;
}
function modifica_accoppiamento(){
if(isset($_POST["data_birth"])&&$_POST["data_birth"]!=""){
$id_accoppiamento = $_GET["mod_accoppiamento"];
$testo = ($_POST["desc_lt"]!="")?trim($_POST["desc_lt"]):"";
$testo_en = ($_POST["desc_lt_en"]!="")?trim($_POST["desc_lt_en"]):"";
$madre = $_POST["femmina"];
$padre = $_POST["maschio"];
$lista = trim($_POST["lista"]);
$let = trim($_POST["let"]);
$data = explode("/",$_POST["data_birth"]);
$data = $data[2]."-".$data[1]."-".$data[0];
$query5 = mysql_query("update accoppiamenti set data='$data', testo_en='$testo_en', testo='$testo', padre='$padre', madre='$madre', let='$let', lista='$lista' where id=$id_accoppiamento");
return $query5;
}
}
// CUCCIOLATE
function find_nome($nome){
$esito = $this->prepare("select nome from cani where id=$nome order by nome");
echo mysql_error();
$ris = mysql_fetch_array($esito);
return $ris["nome"];
}
function lista_accoppiamenti($accoppiamento = 0){
$esito = $this->prepare("select DATE_FORMAT(data,'%d/%c/%Y'), id, padre, madre from accoppiamenti order by data desc");
while($ris = mysql_fetch_array($esito)){
extract($ris);
$madre = $this->find_nome($madre);
$padre = $this->find_nome($padre);
echo "<option value='$id'";
if($accoppiamento==$id) echo " selected ";
echo ">Data: ".$ris["DATE_FORMAT(data,'%d/%c/%Y')"]." - Genitori: ".$padre.", ".$madre."</option>";

}

}

function inserisci_cucciolata(){
if(isset($_POST["data_birth"])&&$_POST["data_birth"]!=""){
$testo = ($_POST["desc_lt"]!="")?trim($_POST["desc_lt"]):"";
$testo_en = ($_POST["desc_lt_en"]!="")?trim($_POST["desc_lt_en"]):"";
$data = strtotime($_POST["data_birth"]);
$data = date("Y-m-d", $data);
$padre = $_POST["padre"];
$madre = $_POST["madre"];
$accoppiamenti = $_POST["accoppiamenti"];
$query5 = mysql_query("insert into cucciolate values(null,'$data','$testo','$testo_en','','','','','','',$padre,$madre,$accoppiamenti)");
echo mysql_error();
return $query5;

}
}
function dettagli_cucciolata($cucciolata){
$query = $this->prepare("select DATE_FORMAT(data,'%d/%c/%Y'), padre, madre, accoppiamenti, testo_en, testo, id from cucciolate where id=$cucciolata");
echo mysql_error();
if($query)
$ris = mysql_fetch_array($query);
return $ris;
}
function modifica_cucciolata(){
if(isset($_POST["data_birth"])&&$_POST["data_birth"]!=""){
$id_cucciolata = $_GET["mod_cucciolata"];
$testo = ($_POST["desc_lt"]!="")?trim($_POST["desc_lt"]):"";
$testo_en = ($_POST["desc_lt_en"]!="")?trim($_POST["desc_lt_en"]):"";
$madre = $_POST["madre"];
$padre = $_POST["padre"];
$accoppiamenti = $_POST["accoppiamenti"];
$query5 = mysql_query("update cucciolate set data=DATE_FORMAT(data, '%Y-%c-%d'), testo_en='$testo_en', testo='$testo', padre=$padre, madre=$madre, accoppiamenti=$accoppiamenti where id=$id_cucciolata");
echo mysql_error();
return $query5;
}
}
// NEWS
function inserisci_news(){
if(isset($_POST["titolo"])&&$_POST["titolo"]!=""){
$titolo = ($_POST["titolo"]!="")?trim($_POST["titolo"]):"";
$titolo_en = ($_POST["titolo_en"]!="")?trim($_POST["titolo_en"]):"";
$desc = ($_POST["desc_lt"]!="")?trim($_POST["desc_lt"]):"";
$desc_en = ($_POST["desc_lt_en"]!="")?trim($_POST["desc_lt_en"]):"";
$data = time();
$query5 = mysql_query("insert into news values(null,'$titolo','$desc','$titolo_en','$desc_en',$data,'','','','','','','')");
return $query5;

}
}
function modifica_news(){
if(isset($_POST["titolo"])&&$_POST["titolo"]!=""){
$id_news = $_GET["mod_news"];
$titolo = ($_POST["titolo"]!="")?trim($_POST["titolo"]):"";
$titolo_en = ($_POST["titolo_en"]!="")?trim($_POST["titolo_en"]):"";
$desc = ($_POST["desc_lt"]!="")?trim($_POST["desc_lt"]):"";
$desc_en = ($_POST["desc_lt_en"]!="")?trim($_POST["desc_lt_en"]):"";
$cane = $_POST["cane"];
$query5 = mysql_query("update news set titolo='$titolo', titolo_en='$titolo_en', testo='$desc', testo_en='$desc_en' where id=$id_news");
return $query5;

}
}
function dettagli_news($news){
$query = $this->prepare("select * from news where id=$news");
if($query)
$ris = mysql_fetch_array($query);
return $ris;
}
}
?>
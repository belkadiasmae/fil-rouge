<?php
	//db connection
	require('security/db.php');

	//le formulaire a était envoyé avec la méthode POST
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        //Récupération sécurisé des données
			
            $nom = $mysqli->real_escape_string($_POST['nom']);
            $prenom = $mysqli->real_escape_string($_POST['prenom']);
            $cne = $mysqli->real_escape_string($_POST['cne']);
            $cni = $mysqli->real_escape_string($_POST['cni']);
            $date = $mysqli->real_escape_string($_POST['date_nais']);
            $dep = $mysqli->real_escape_string($_POST['pro_nais']);
            $natio = $mysqli->real_escape_string($_POST['natio']);
            $fonction = $mysqli->real_escape_string($_POST['tedt']);
            $descfct = $mysqli->real_escape_string($_POST['fonction']);
            $adr = $mysqli->real_escape_string($_POST['adresse']);
            $ville = $mysqli->real_escape_string($_POST['vil_adr']);
            $tel = $mysqli->real_escape_string($_POST['telephone']);
            $email = $mysqli->real_escape_string($_POST['mail']);
            $sujet = $mysqli->real_escape_string($_POST['sujet']);
            $labo = $mysqli->real_escape_string($_POST['laboratoire']);
                
        //insert user data into database
			
            $sql = "INSERT INTO individu (cne,cni,nom,prenom,date_nais,cod_dep,cod_pay,lib_adr,vil_adr,telephone,mail,sujet,cod_lab,fonctionnaire,descfct) VALUES ('$cne','$cni','$nom','$prenom','$date','$dep','$natio','$adr','$ville','$tel','$email','$sujet','$labo','$fonction','$descfct')";

			//check if mysql query is successful
			if ($mysqli->query($sql) === false){
                // header('Location: http://ent.uit.ac.ma');
                header('Location: eng_doctorant.php');

			}
        
        $mysqli->close();
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
<link rel="stylesheet" href="print.css" type="text/css" media="print" />
<title>Universit&eacute; Ibn Tofail - Re&ccedil;u de pr&eacute;inscription en doctorat</title>
<style type="text/css">
#doctorat table tr td {
	font-family: Verdana, Geneva, sans-serif;
}
#doctorat table tr td table tr td {
	font-family: Verdana, Geneva, sans-serif;
}
.titre {
	font-family: Verdana, Geneva, sans-serif;
}
#doctorat table tr td h5 {
	color: #FFF;
}
#doctorat table tr td h6 {
	color: #C0C0C0;
}
#doctorat table tr td h6 {
	color: #808080;
}
#doctorat table tr td h5 {
	color: #000;
}
#doctorat table tr td h5 u {
	color: #808080;
}
.Style5 {	font-size: 9px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #424244;
}
.titre {
	color: #808080;
}
.basdepage {
	font-family: Verdana, Geneva, sans-serif;
}
.basdepage {
	color: #C0C0C0;
}
.sig {
	font-family: Verdana, Geneva, sans-serif;
}
</style>
<script type="text/javascript">
function imprimer_page(){
  window.print();
}



</script>
</head>

<body>
<h5 align="center"><img src="images/logo.jpg" alt="" width="129" height="141"  /><br />
  <span class="titre"><u>Universit&eacute; Ibn Tofail - K&eacute;nitra<br />
Facult&eacute; des Sciences</u></span></h5>
<h5 align="center"><span class="titre"><u>Re&ccedil;u de 
  Pr&eacute;insription en doctorat 2018/2019</u></span>
</h5>
<div align="center">
  <table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="15" valign="bottom" bgcolor="#FFFFFF"><h5 class="titre"><u><strong>Individu</strong></u></h5></td>
    </tr>
    <tr>
      <td><table width="100%">
        <tr>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Nom</td>
          <td width="180" class="Style5"><h3><?php echo $_POST['nom']; ?></h3></td>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Prenom</td>
          <td width="180" class="Style5"><h3><?php echo $_POST['prenom']; ?></h3></td>
          </tr>
        <tr>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;"> CNE</td>
          <td width="180" class="Style5"><h3><?php echo $_POST['cne'];?></h3></td>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;"> CNI</td>
          <td width="180" class="Style5"><h3><?php echo $_POST['cni'];?></h3></td>
          </tr>
        <tr>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;"> Date de naissance</td>
          <td width="180" class="Style5"><h3><?php echo $_POST['date_nais']; ?></h3></td>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Lieu de naissance</td>
          <td width="180" class="Style5"><h3>
            <?php echo $_POST['pro_nais']; ?>
            </h3></td>
          </tr>
        <tr>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Nationalit&eacute;</td>
          <td width="180" class="Style5"><h3><span class="arabe">
           <?php echo $_POST['natio']; ?>
            </span></h3></td>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Fonction</td>
          <td width="180" valign="middle" class="Style5" id="fonctionnaire"><h3>
            <?php echo $_POST['tedt']; ?>
          </h3></td>
          </tr>
        <tr>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Fonction(description)</td>
          <td colspan="3" class="Style5"><?php echo $_POST['fonction']; ?></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="15" valign="bottom" bgcolor="#FFFFFF"><h5 class="titre"><u><strong><br />
      Adresse</strong></u></h5></td>
    </tr>
    <tr>
      <td><table width="100%">
        <tr>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Adresse</td>
          <td width="540" class="Style5">
            <h3><?php echo $_POST['adresse']; ?>
            </h3></td>
          </tr>
        <tr>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Ville</td>
          <td width="540" class="Style5"><h3><span class="arabe">
            <?php echo $_POST['vil_adr']; ?>
            </span></h3></td>
          </tr>
        <tr>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">T&eacute;l&eacute;phone</td>
          <td width="540" class="Style5"><h3><?php echo $_POST['telephone']; ?></h3></td>
          </tr>
        <tr>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Mail</td>
          <td width="540" class="Style5"><h3><span class="arabe"><?php echo $_POST['mail']; ?></span></h3></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="15" valign="bottom" bgcolor="#FFFFFF"><h5 class="titre"><u><strong><br />
      Doctorat</strong></u></h5></td>
    </tr>
    <tr>
      <td><table width="100%">
        <tr>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Sujet</td>
          <td width="540" class="Style5"><h3><?php echo $_POST['sujet']; ?></h3></td>
          </tr>
        <tr>
          <td width="180" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Laboratoire</td>
          <td width="540" class="Style5"><h3><span class="arabe">
            <?php echo $_POST['laboratoire']; ?>
            </span></h3></td>
          </tr>
        <tr>
          
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="right">
        <p>&nbsp;</p>
        <h5><span class="sig">Signature du Directeur de th&egrave;se</span></h5>
        <form>
          <div align="center">
            <input id="impression" name="impression" type="button" onclick="imprimer_page()" value="Imprimer le re&ccedil;u" />
          </div>
        </form>
        <p>&nbsp;</p>
      <h6 class="basdepage">&nbsp;</h6></td>
    </tr>
  </table>
</div>
<p align="center">&nbsp;</p>
</body>
</html>
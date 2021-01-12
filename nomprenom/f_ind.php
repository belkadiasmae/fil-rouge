<?php
require 'security/db.php';
include 'requetes/getinfo.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ENT - [PREINSCRIPTION]</title>
<link rel="stylesheet" type="text/css" href="css/theme.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<script type="text/javascript" src="keyboard.js" charset="UTF-8"></script>
<script type="text/javascript">
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-101912355-1', 'auto');
  ga('send', 'pageview');


function verif_form()
{ var msg = "";
var numbers = /^[0-9]+$/;
 if(document.form.nom.value == "")  {
   msg = "Veuillez saisir votre Nom\n";
		
	     }
		 

	if(document.form.prenom.value == "")  {
   msg += "Veuillez saisir votre Prénom\n";
		
  		
     }
		 
	  
if(document.form.date_nais.value == "")  {
   msg += "Veuillez saisir votre date de naissance\n";
		
  	     }
		 
if(document.form.natio.value == "0")  {
   msg += "Veuillez saisir votre nationalité\n";
		
  	     }


	 if(document.form.pro_nais.value == "0")  {
   msg += "Veuillez choisir la ville de naissance\n";
		
  		
     }
if(document.form.adresse.value == "")  {
   msg += "Veuillez saisir votre adresse\n";
		
  		
     }


if(document.form.vil_adr.value == "")  {
   msg += "Veuillez saisir la ville de l'adresse \n";
		
  		
     }
	 
if(document.form.mail.value == "")  {
   msg += "Veuillez saisir votre adresse mail\n";
		
  		
     }
	 
	 if(document.form.sujet.value == "")  {
   msg += "Veuillez saisir votre sujet\n";
		
  		
     }
	 
	  if(document.form.laboratoire.value == "0")  {
   msg += "Veuillez saisir le laboratoire\n";
		
  		
     }
	 
	 if(document.form.enseignants.value == "0")  {
   msg += "Veuillez saisir un enseignant\n";
		
  		
     }
	 

if(document.form.telephone.value == "xxx")  {
   msg += "Veuillez saisir votre téléphone\n";
		
  		
     } else
	 {
		 
		
      var numbers = /^[0-9]+$/;
      if(document.form.telephone.value.match(numbers))
      {
      if(document.form.telephone.value.length!=10){
	  msg += "Assurez-vous de rentrer un numéro à 10 chiffre 061xxxxxxx \n";
      
		  
		  
	  }
      }
      else
      {
      msg += "Veuillez saisir votre numéro de téléphone correctement\n";
      
      
	  }
		 
		 
		 
		 }
	 

	 

	   
	  

	

  if (msg == "") {
  
  return(true);
}
//Si un message d'alerte a t initialis on lance l'alerte
	else	{
		alert(msg);
		return(false);
	}
  
} 
//-->



		$(document).ready(function() {


			$("#doctorat").validationEngine();


		});

 
			function getXhr(){
                                var xhr = null; 
				if(window.XMLHttpRequest) // Firefox et autres
				   xhr = new XMLHttpRequest(); 
				else if(window.ActiveXObject){ // Internet Explorer 
				   try {
			                xhr = new ActiveXObject("Msxml2.XMLHTTP");
			            } catch (e) {
			                xhr = new ActiveXObject("Microsoft.XMLHTTP");
			            }
				}
				else { // XMLHttpRequest non supporté par le navigateur 
				   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
				   xhr = false; 
				} 
                                return xhr;
			}
 
			/**
			* Méthode qui sera appelée sur le click du bouton
			*/
			function go(){
				var xhr = getXhr();
				// On défini ce qu'on va faire quand on aura la réponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
						leselect = xhr.responseText;
						// On se sert de innerHTML pour rajouter les options a la liste
						document.getElementById('enseignants').innerHTML = leselect;
					}
				}

				// Ici on va voir comment faire du post
				xhr.open("POST","option.php",true);
				// ne pas oublier ça pour le post
				xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				// ne pas oublier de poster les arguments
				// ici, l'id de l'auteur
				sel = document.getElementById('lab'); 
				enseignants = sel.options[sel.selectedIndex].value;
				xhr.send("enseignants="+enseignants);
				
			}
	

function active() {
		 document.formulaire.fonction.disabled = false;
		 
	     document.formulaire.fonction.style.backgroundColor="white";
}
 
function desactive() {
		 
		 document.formulaire.fonction.disabled = true;
	     document.formulaire.fonction.style.backgroundColor="#CCCCCC";
}
 

</script>

<style type="text/css">
.Style9 {color: #006699}
.Style11 {font-size: 10px; font-weight: bold; }
.Style14 {color: #003366}
.col_lib_tab {color: #006699;
	font-family: Verdana, Geneva, sans-serif;
	font-size:12px;
}
.lib_tab {font-family: Verdana, Geneva, sans-serif;
	color: #808080;
	font-size:12px;
}
.message_alert {font-family: Verdana, Geneva, sans-serif;
	color: #F00;
	font-size:14px;
}
</style>

</head>

<body onload='go(),desactive()'>
<h5 align="center"><!-- end #header -->
      
<!-- end #menu --></h5>
<p align="center">&nbsp;</p>
<div id="container">
  <div id="wrapper">
    <div id="box">
      <h3 class="Style14"  id="adduser">
        <?php 				
					$annee=date("Y");
					echo 'Preinscription en doctorat (Facult&eacute; des Sciences) au titre de L\'ann&eacute;e universitaire '.$annee.'/'.($annee + 1);
        ?>
      </h3>
      <div id="div">
      <form name="form" id="form" method="post" action="eng_doctorant.php" onsubmit="return(verif_form())" >
        <fieldset id="personal">
          <legend><span class="Style9">Information Personnelle</span>          </legend>
          <table width="100%">
            <tr>
              <td width="20%" height="20" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Nom</td>
              <td width="611" height="20">
                  <input placeholder="votre nom" name="nom" type="text"   value="" class="validate[required] text-input" id="nom" size="40" maxlength="100" /></td>
            </tr>
            <tr>
              <td width="177" height="20" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Prenom</td>
              <td height="20"><span class="arabe">
                <input placeholder="votre prénom" name="prenom" value="" type="text"  class="validate[required] text-input" id="prenom" size="40" maxlength="100"/>
              </span></td>
            </tr>
            <tr>
              <td width="177" height="20" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">CNI</td>
              <td height="20"><span class="arabe">
                <input name="cni" type="text"  id="cni" value="<?php echo $_POST['txtcniopi'];?>" readonly="readonly"/>
              </span></td>
            </tr>
            <tr>
              <td width="177" height="20" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">CNE</td>
              <td height="20"><h5>
                  <input name="cne" type="text" id="cne" value="<?php echo $_POST['txtcneopi']?>" readonly="readonly"/>
                </h5></td>
            </tr>
            <tr>
              <td height="20" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Date de naissance</td>
              <td height="20"><input name="date_nais" type="date" class="validate[required,custom[date]] text-input" id="datenai" size="10" maxlength="10"/></td>
            </tr>
            <tr>
              <td height="20" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Lieu de naissance</td>
              <td height="20"><span class="arabe">
               
                    <select name="pro_nais" class="Style5" id="pro_nais" onchange="javascript:couleur(this);">
                        <?php echo $villes; ?>
                    </select>
              </span></td>
            </tr>
            <tr>
              <td height="20" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Nationalit&eacute;</td>
              <td height="20"><span class="arabe">
               
                    <select name="natio" class="Style5" id="natio" onchange="javascript:couleur(this);">
                        <?php echo $nat; ?>
                    </select>
              </span></td>
            </tr>
            <tr>
              <td height="9" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Fonction</td>
              <td height="9"><table width="100%" border="0">
                <tr class="col_lib_tab">
                  <td width="33%" valign="middle"><h5><span style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Etudiant</span>
                    <input name="tedt" type="radio" id="etd" value="etudiant" checked="checked" onclick="desactive()" />
                  </h5></td>
                  <td width="33%"><h5><span style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Salari&eacute;</span>
                    <input type="radio" name="tedt" id="sal" value="salari&eacute;" onclick="active()"/>
                  </h5></td>
                  <td width="33%"><h5><span style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Fonctionnaire</span>
                      <input type="radio" name="tedt" id="fct" value="fonctionnaire" onclick="active()"/>
                  </h5></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">A pr&eacute;ciser (Fonction)</td>
              <td height="9"><textarea name="fonction" cols="70" id="fonction" placeholder="précisez votre fonction ici..."></textarea></td>
            </tr>
          </table>
        </fieldset>
        <fieldset id="address">
          <legend><span class="Style9">Adresse</span></legend>
          <table width="100%">
            <tr>
              <td width="20%" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Adresse</td>
              <td width="955" height="20" bgcolor="#FFFFFF">
                  <input placeholder="votre adresse de résidence actuelle" name="adresse" type="text" id="adresse" size="100" maxlength="100" /></td>
            </tr>
            <tr>
              <td width="337" height="20" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;"> T&eacute;l&eacute;phone</td>
              <td height="20">
                  <input placeholder="votre numéro de téléphone" name="telephone" type="text" class="validate[required,custom[phone]] text-input" id="telephone" size="25" maxlength="10"/></td>
            </tr>
            <tr>
              <td width="337" height="20" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Ville</td>
              <td height="20"><span class="arabe">
               
                <select name="vil_adr" class="Style5" id="vil_adr" >
                    <?php echo $villes; ?>
                </select>
              </span></td>
            </tr>
            <tr>
              <td width="337" height="20" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Mail</td>
              <td height="20"><span class="arabe">
                <input placeholder="votre email" name="mail" type="email"  class="validate[required,custom[email]] text-input" id="mail" size="30" maxlength="100"/>
              </span></td>
            </tr>
          </table>
        </fieldset>
        <fieldset id="doctorat">
          <legend><span class="Style9">Doctorat</span></legend>
          <table width="100%">
            <tr>
              <td width="20%" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Sujet</td>
              <td width="956" height="20"><textarea placeholder="placez votre sujet du doctorat ici..." name="sujet" cols="100" rows="3"  id="sujet"></textarea></td>
            </tr>
            <tr>
              <td width="336" height="20" class="col_lib_tab" style="padding-left : 20px; padding-right : 20px;font-family:Verdana, Geneva, sans-serif; font-size : 11px; font-weight:bold;">Laboratoire</td>
              <td height="20"><span class="arabe">
                
                <select name="laboratoire" class="Style5" id="lab" onchange='go()'>
                  <option selected="selected"></option>
                    <?php echo $labos; ?>                 
                </select>
              </span></td>
            </tr>
           
          </table>
        </fieldset>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="5">
          
          <tr valign="middle">
            <td height="20" colspan="7" bgcolor="#FFFFFF"><div align="center">
              <p>
                <input name="valider" type="submit" class="Style5" value="s'inscrire" />
                <br />
              </p>
            </div></td>
          </tr>
        </table>
      </form>
    </div> </div>
  </div>
</div>
<p align="center">&nbsp;</p>
    <!-- end #footer -->
</body>
</html>

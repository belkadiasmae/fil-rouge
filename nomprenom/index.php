<?php include("parametres/parametres_connexion.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ENT - [PREINSCRIPTION]</title>
<link rel="stylesheet" type="text/css" href="css/theme.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>


<script language="JavaScript">
<!--
function couleur(obj) {
     obj.style.backgroundColor = "#FFFFFF";
}
function verif_formulaire()
{ var msg = "";
 if(document.form.txtcneopi.value == "")  {
   msg = "Veuillez saisir votre CNE/MASSAR\n";
		document.form.txtcneopi.style.backgroundColor = "#FFCC00";
	     }
 if(document.form.txtcniopi.value == "")  {
   msg+= "Veuillez saisir votre CNI\n";
		document.form.txtcniopi.style.backgroundColor = "#FFCC00";
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
</script>
<style type="text/css">
<!--
body {
	background-image: url();
}
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
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<body>
    <div id="container">
        <div id="wrapper">
            <div id="content"><br />
                <div id="box">
                    <h3 class="Style14"  id="adduser">
                      <?php 				
                        $annee=date("Y");
                        echo 'Preinscription en doctorat (Faculté des Sciences) au titre de L\'ann&eacute;e universitaire '.$annee.'/'.($annee + 1);
     ?>
                    </h3> 
                    <div id="div">
                        <form name="form" id="form" class="formular" onSubmit="return(verif_formulaire())" action="post">
                            <fieldset id="personal">
                                <legend><span class="Style9">Authentification</span></legend>
                                <div align="left" class="col_lib_tab">
                                      <p>L'inscription n'est définitive qu'aprés la validation des services du CED de la faculté des Sciences. <br />
                                        </p>
                                        <p><strong>Comment remplir la fiche de préinscription ?</strong></p>

                                          -Entrez votre (CNE/MASSAR) et votre CNI<br />
                    -Cliquer sur   <strong>Valider</strong>
                                          <br />
                                      -Compléter la fiche de préinscription.
                                      <br />
                                      -Cliquer sur   <strong>Enregistrer</strong>

                    <p>&nbsp;</p>
                    <p><strong><u>Trés Important</u></strong></p>
                                          <p>Avant d'entamet la préinscription en ligne, le candidat doit avoir eu l'accord d'un directeur de th&egrave;se (PES ou PH) et avoir défini le sujet de th&egrave;se au préalable.</p>
                                    </div>
                                <table width="300" border="0" align="center">
                                    <tr>
                                        <td width="490">
                                            <table width="100%" height="88"  border="0" cellpadding="3" cellspacing="5">
                                            <!--DWLayoutTable-->
                                                <tr valign="middle">
                                                    <td width="25%" height="5" ><span class="col_lib_tab">CNI</span></td>
                                                        <td width="75%" ><input name="txtcniopi" type="text"  id="txtcniopi"  onKeyUp="javascript:couleur(this);" maxlength="12" ></td>
                                                </tr>
                                                <tr valign="middle">
                                                    <td width="25%" height="9" ><span class="col_lib_tab">CNE/MASSAR</span></td>
                                                    <td ><input name="txtcneopi" type="text"  id="txtcneopi"  onkeyup="javascript:couleur(this);" maxlength="12" /></td>
                                                </tr>

                                                <tr valign="middle">
                                                    <td height="30" colspan="2" >
                                                        <div align="center">
                                                            <p><span class="col_lib_tab">Tapez votre CNE/MASSAR et votre CNI puis cliquez sur valider.</span> </p>
                                                            <p>&nbsp;</p>
                                                            <table width="100%" border="0">
                                                                <tr>
                                                                    <td width="50%" align="right"><input name="valider" type="submit" formmethod="post" formaction="f_ind.php" class="Style5" value="Valider" /></td>
                                                                    <td width="50%" align="left"></td>
                                                                </tr>
                                                            </table>
                                                            <p><br>
                                                            <br>
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </body>
</html>

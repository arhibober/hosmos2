<?php

// recuperation du jour, mois, et année actuel
$jour_actuel = date("j", time());
$mois_actuel = date("m", time());
$an_actuel = date("Y", time());
$jour = $jour_actuel;

// include("fonctions.php"); 23-04-2012:removed

// jQuery UI

$html .= '
<script type="text/javascript">';
$html .= 'jQuery(document).ready(function(){';
$html .= '
jQuery(function() {
		jQuery( "#accordion'.$widget['number'].'" ).accordion(
		{
			autoHeight: false,
			navigation: true
		});
	});;
});
</script>';


// si la variable mois n'existe pas, mois et année correspondent au mois et à l'année courante

$mois = $mois_actuel;
$an = $an_actuel;

$options = get_option($this->adminOptionsName);

// the accordion

$html .= '
<div class="postbox wcal-box" style="width:200px;">';
$html .= '
<div id="accordion'.$widget['number'].'" class="inside">';


$nmonths_displayed = 0;
while ( $nmonths_displayed < $nchdis ) { 

//affichage du mois et de l'année 

$mois_en_clair = $this->mois_de_annee[$mois - 1];
$moisan = $mois_en_clair." ".$an;

// connexion à la bdd pour remplir $tab_jours[] et $tab_nch[]

include("fillmonth.php");

//  le calendrier
 
$html .= '
<h3 href="#" class="wcal-title">'.$mois_en_clair.' '.$an.'</a></h3>';
$html .= '
<div><table cellpadding="0" cellspacing="0" class="widget-chotcal">';


$html .= '
<tr>
<th class="wcal-1">'.MSG_cha.'</th>
<th>'.MSG_lundi.'</th>
<th>'.MSG_mardi.'</th>
<th>'.MSG_mercredi.'</th>
<th>'.MSG_jeudi.'</th>
<th>'.MSG_vendredi.'</th>
<th>'.MSG_samedi.'</th>
<th>'.MSG_dimanche.'</th>
</tr>';


//Détection du 1er et dernier jour du moiS
$nombre_date = mktime(0,0,0, $mois, 1, $an);
$premier_jour = date('w', $nombre_date);
if ( $premier_jour  == 0 ) $premier_jour = 7;
$dernier_jour = 28;
while (checkdate($mois, $dernier_jour + 1, $an))
	{ $dernier_jour++;}

// Affichage de 7 jours du calendrier

$weekprint = 0;
	
$nr= (int)(($premier_jour+$dernier_jour)/7);
$r = 0;
while ( true )
	{

	$weekhit = false;
	$htmladd = '<tr class="days"><td class="wcal-0"></td>';
	// numero des jours
	for ($i = 1; $i < 8; $i++)
		{
		$ce_jour = $r * 7 + $i+1 - $premier_jour;
		if ( $ce_jour <= 0 || $ce_jour > $dernier_jour )
			{ 
			$htmladd .= '<td class="day-out"></td>';
			}
		else
			{			
			if ( ( $fete = getPublicHoliday((int)$ce_jour,(int)$mois,$an) ) != false )
				{ 
				$htmladd .= '<td class="day-sun" >'; //ferie
				$htmladd .= '<div class="tooltip"><span>'.$fete.'</span>'.$ce_jour.'</div></td>';
				}
			else if ( $i == 7 ) 
				{
				$htmladd .= '<td class="day-sun" >'.$ce_jour.'</td>'; // dimanche simple
				}
			else
				$htmladd .= '<td>'.$ce_jour.'</td>';
			}
		}
	$htmladd .= '</tr>';
		
	for ( $j = 0 ; $j < (int)$options['nbch'] ; $j++ )
		{
		$doit = ( $params['roomdisplay'] == 0 || $params['roomdisplay'] == $j+1 ) ? true : false;
		if ( !$doit ) continue;
		
		$htmladd .= '<tr><td class="wcal-1" ';
		$htmladd .= ' style="color:black; background-color:#'.$options['col'][$j].';">'; 
		
		$htmladd .= $options['abr'][$j].'</td>';
    
		for ($i = 1; $i < 8; $i++)
			{
			$ce_jour = $r * 7 + $i+1 - $premier_jour;
			if ( $ce_jour <= 0 || $ce_jour > $dernier_jour )
				{ 
				$htmladd .= '<td class="day-out"></td>';
				}
			else
				{		
				$htmladd .= '<td class="wfd'.$tab_interv[$j][$ce_jour].'">';
					
				if ( is_passe($ce_jour,$mois,$an,$jour_actuel,$mois_actuel,$an_actuel) )
					$imgclass = "img-wcal-passe";
				else
				{ $imgclass = "img-wcal"; $weekhit = true; }
					
				if ( $tab_vacances[$j][$ce_jour] )	
					$htmladd .= '<img class="'.$imgclass.'" src="'.plugins_url( "/img/cadenas.png", dirname(__FILE__) ).'" />'; 
				else
					{
					if ( $tab_reserv[$j][$ce_jour] )
						{						
						$htmladd .= '<img class="'.$imgclass.'" src="'.plugins_url( "/img/occupe.png", dirname(__FILE__) ).'" />'; 
						}
					else
						{		
						$htmladd .= '<img class="'.$imgclass.'" src="'.plugins_url( "/img/libre.png", dirname(__FILE__) ).'" />';					
						}
					}
				$htmladd .= '</td>';	
				}
			
			}
		$htmladd .= '</tr>';	
		}
		
	if ( $weekhit ) // semaine du passé : inutile !
		{ $html .= $htmladd; $weekprint++; }
	
	if ( $ce_jour >= $dernier_jour )
		break;
	$r++;
	}


$html .= '</table></div>';

// les autres mois
 
$nmonths_displayed++;

//definir le mois suivant 
$mois = $mois + 1;
if ( $mois == 13 )
	{
	$mois = 1;
	$an = $an + 1;
	}
} // $nmonth loop

$html .= '</div></div>';
// please do not remove link !
$html .= '<p class="nota">'.MSG_bylink2.' <a href="http://www.jourdets.com/codage/fr_calendar.html">les Jourdets</a></p>';
?>
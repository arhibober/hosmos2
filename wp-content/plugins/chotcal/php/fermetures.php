<?php

$confirm_bd = false;

$locale = get_locale();
if ( strstr($locale,'fr') )
	$locale = 'fr';
else
	$locale = '';
	
$options = get_option($this->adminOptionsName);

// on va faire d'éventuelles modifs en BD

include("bdeventf.php");

$html .= '
<script type="text/javascript">';
$html .= '
jQuery(document).ready(function(){';

if ( $confirm_bd )
{
$html .= 'jQuery("#confirm_form").submit();
});
</script>';
}
else
{
	
/** recherche en BD ***/
	
global $wpdb;  	
$table_name = $wpdb->prefix.'chotcal_fermetures';  
$sql = $wpdb->prepare("SELECT * FROM $table_name");  
$fermetures = $wpdb->get_results($sql);  

if ( $locale == 'fr' ) {
$html .= "jQuery(function(jQuery){
	jQuery.datepicker.regional['fr'] = {
		closeText: 'Fermer',
		prevText: '&#x3c;Préc',
		nextText: 'Suiv&#x3e;',
		currentText: 'Courant',
		monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
		'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
		monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
		'Jul','Aoû','Sep','Oct','Nov','Déc'],
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
		dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	jQuery.datepicker.setDefaults(jQuery.datepicker.regional['fr']);
}); ";
}

$html .= '
jQuery( ".date" ).datepicker({
   onSelect: function(dateText, inst) 
   	{ 
   	var name1 = inst.id;
   	var v12 = name1.substr(2,1);
   	if ( v12 == "1" )
   		{
   		name2 = "#"+name1.substr(0,2)+"2"+name1.substr(3);
   		jQuery(name2).datepicker( "option", "minDate", dateText);
   		}
   	else if ( v12 == "2" )
   		{
   		name2 = "#"+name1.substr(0,2)+"1"+name1.substr(3);
   		jQuery(name2).datepicker( "option", "maxDate", dateText);
   		}
   		
	}
});';
$html .= '
jQuery( ".date" ).datepicker( "option", "dateFormat", "yy-mm-dd" );';

/* on remplit les champs */

for ( $i = 0 ; $i < count($fermetures); $i++ ) {
$html .= '
jQuery("#dt1'.$i.'").datepicker( "setDate", "'.$fermetures[$i]->ffrom.'" );
jQuery("#dt2'.$i.'").datepicker( "setDate", "'.$fermetures[$i]->fto.'" );';
$html .= '
jQuery("#dt2'.$i.'").datepicker( "option", "minDate", jQuery("#dt1'.$i.'").datepicker( "getDate" ));';
$html .= '
jQuery("#dt1'.$i.'").datepicker( "option", "maxDate", jQuery("#dt2'.$i.'").datepicker( "getDate" ));';
} 

$html .= '
});
</script>';

}

$html .= '
<div class=wrap>  
<div class="icon32" id="icon-edit"><br /></div>  
<h2>'.MSG_gferm.'</h2>';

if ( $confirm_bd )
{
$furl = admin_url('admin.php');
$html .= '<form name="confirm_form" id="confirm_form" class="wrap" method="get" action="'.$furl.'" >';
$html .= '<input name="page" type="hidden" value="chotcal_3" />';
$html .= '</form>';
}
else
{
$furl = admin_url('admin.php?page=chotcal_3');

for ( $i = 0 ; $i < count($fermetures); $i++ ) {
	$html .= '
	<div class="postbox fermdiv">
	<form action="'.$furl.'" method="post" >';
	$html .= '<input name="page" type="hidden" value="chotcal_3" />';
	$html .= '<input name="id" type="hidden" value="'.$fermetures[$i]->id.'" />';
	$html .= '<label for="from">'.MSG_tfrom.'</label> : <input type="text" id="dt1'.$i.'" name="from" class="date" value=""/>';
	$html .= '<label for="to">'.MSG_tto.'</label> : <input type="text" id="dt2'.$i.'" name="to" class="date" value=""/>';
	
	$mask = $fermetures[$i]->nch;
	$m = 1;
	for ( $j = 0 ; $j < (int)$options['nbch'] ; $j++ )
		{
		$name = 'ch['.$j.']';
		$html .= '<label for="'.$name.'"><input name="'.$name.'" type="checkbox" ';
		if ( $mask & $m ) $html .= ' checked="checked"';
		$html .= '/>'.$options['abr'][$j].'</label>';
		$m = $m << 1;
		}
		
	
	$html .= '<input class="button-primary bdbut" type="submit" name="bd_edit" id="b_edit" value="'.MSG_t_modif.'" />';
	$html .= '<input class="button-primary bdbut" type="submit" name="bd_delete" id="b_delete" value="'.MSG_t_delete.'" />';
	$html .= '</form></div>';
}

// le créer

$html .= '
<div class="postbox fermdiv">
<form action="'.$furl.'" method="post" >';
$html .= '<input name="page" type="hidden" value="chotcal_3" />';
$html .= '<label for="from">'.MSG_tfrom.'</label> : <input id="dt1000" type="text" name="from" class="date" value=""/>';
$html .= '<label for="from">'.MSG_tto.'</label> : <input id="dt2000" type="text" name="to" class="date" value=""/>';

$m = 1;
for ( $j = 0 ; $j < (int)$options['nbch'] ; $j++ )
	{
	$name = 'ch['.$j.']';
	$html .= '<label for="'.$name.'"><input name="'.$name.'" type="checkbox" ';
	$html .= '/>'.$options['abr'][$j].'</label>';
	$m = $m << 1;
	}
$html .= '<input class="button-primary bdbut" type="submit" name="bd_create" id="b_create" value="'.MSG_t_create.'" />';
$html .= '</form></div>';
}
$html .= '</div>';
?>
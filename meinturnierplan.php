<?php
/**
 * Plugin Name: Meinturnierplan.de Widget Viewer
 * Plugin URI: http://meinturnierplan.de/help.php?setlang=en#widget-wordpress
 * Author: Meinturnierplan.de Team
 * Author URI: http://meinturnierplan.de
 * Description: Plugin to show matches and ranks from meinturnierplan.de tournaments
 * Version: 1.1
 */

namespace mtp;

add_action( 'wp_enqueue_scripts', '\mtp\enqueue_scripts' );
add_shortcode( 'mtp-table', '\mtp\mtptable_shortcode' );
add_shortcode( 'mtp-matches', '\mtp\mtpmatches_shortcoce' );

define('MTP_ROOT', 'https://www.meinturnierplan.de');

/**
 * Initializes this plugin
 */
function enqueue_scripts() {
	wp_enqueue_style( 'mtp-widget-base', plugins_url('style.min.css', __FILE__) );
}

/**
 * Returns the table widget for wordpress. [mtp-table]
 * Parameters:
 * * id: (required) The tournament id
 * * group: (optional) The group number to display (1-n). Use 90 for final, 91 for WG, 92 for LG.
 * * sn: (optional) suppress game number
 * * sw: (optional) suppress wins, draws and looses
 * * sl: (optional) suppress logos
 * * nav: (optional) show navigation bar for groups
 * * sbr: (optional) suppress meinturnierplan.de link
 * * lang: (optional) The language to use. Defaults to de
 * @param multitype:string $atts
 * @return string
 */
function mtptable_shortcode($atts){
	ob_start();
	
	// Set default settings if no settings are given
	if (!isset($atts['lang'])) $atts['lang'] = 'de';
	foreach($atts as $key => $value) {
		if (is_numeric($key)) {
			$atts[$value] = "";
		}
	}
	
	// Start widget container
	echo '<div class="mtpwidgetspace">';
	
	if (!isset($atts['id'])) {
		echo '<b>Meinturnierplan.de</b><br>Missing argument "id".';
	} else {
		echo '<iframe class="mtpwidget" 
	src="'.MTP_ROOT.'/displayTable.php?'.
	'id='.$atts['id'].
	'&setlang='.$atts['lang'];
	
		if (isset($atts['group'])) echo '&gr='.$atts['group'];
		
		if (isset($atts['sn'])) echo '&sn';
		if (isset($atts['sw'])) echo '&sw';
		if (isset($atts['sl'])) echo '&sl';
		if (isset($atts['nav'])) echo '&nav';
		if (isset($atts['sbr'])) echo '&sbr';
		
		if (isset($atts['s-size'])) echo '&s[size]='.urlencode($atts['s-size']);
		if (isset($atts['s-sizeheader'])) echo '&s[sizeheader]='.urlencode($atts['s-sizeheader']);
		if (isset($atts['s-color'])) echo '&s[color]='.urlencode($atts['s-color']);
		if (isset($atts['s-maincolor'])) echo '&s[maincolor]='.urlencode($atts['s-maincolor']);
		if (isset($atts['s-padding'])) echo '&s[padding]='.urlencode($atts['s-padding']);
		if (isset($atts['s-innerpadding'])) echo '&s[innerpadding]='.urlencode($atts['s-innerpadding']);
		if (isset($atts['s-bgcolor'])) echo '&s[bgcolor]='.urlencode($atts['s-bgcolor']);
		if (isset($atts['s-logosize'])) echo '&s[logosize]='.urlencode($atts['s-logosize']);
		if (isset($atts['s-bcolor'])) echo '&s[bcolor]='.urlencode($atts['s-bcolor']);
		if (isset($atts['s-bsizeh'])) echo '&s[bsizeh]='.urlencode($atts['s-bsizeh']);
		if (isset($atts['s-bsizev'])) echo '&s[bsizev]='.urlencode($atts['s-bsizev']);
		if (isset($atts['s-bsizeoh'])) echo '&s[bsizeoh]='.urlencode($atts['s-bsizeoh']);
		if (isset($atts['s-bsizeov'])) echo '&s[bsizeov]='.urlencode($atts['s-bsizeov']);
		if (isset($atts['s-bbcolor'])) echo '&s[bbcolor]='.urlencode($atts['s-bbcolor']);
		if (isset($atts['s-bbsize'])) echo '&s[bbsize]='.urlencode($atts['s-bbsize']);
		if (isset($atts['s-bgeven'])) echo '&s[bgeven]='.urlencode($atts['s-bgeven']);
		if (isset($atts['s-bgodd'])) echo '&s[bgodd]='.urlencode($atts['s-bgodd']);
		if (isset($atts['s-bgover'])) echo '&s[bgover]='.urlencode($atts['s-bgover']);
		if (isset($atts['s-bghead'])) echo '&s[bghead]='.urlencode($atts['s-bghead']);
		
		echo '&s[wrap]=false';
		echo '" allowtransparency="true" frameborder="0" width="'.$atts['width'].'" height="'.$atts['height'].'" >
	<b>Meinturnierplan.de</b>
	<p>Ihr Browser kann das Turnierwidget leider nicht darstellen. <a href="'.MTP_ROOT.'/showit.php?id='.$atts['id'].'">Hier geht es zum Turnier.</a></p>		
</iframe>';
	}
	// End widget container
	echo '</div>';
	// Return result
	return ob_get_clean();
}

/**
 * Returns the matches widget for wordpress. [mtp-matches]
 * Parameters:
 * * id: (required) The tournament id
 * * team: (optional) The number of the team to show
 * * group: (optional) The group number to show (1-n). Use 90 for final, 91 for WG, 92 for LG.
 * * gamenumbers: (optional) The game numbers to show (format n-m, n and m are game numbers)
 * * si: (optional) suppress game number
 * * st: (optional) suppress time
 * * sg: (optional) suppress group
 * * se: (optional) suppress extra time
 * * sp: (optional) suppress penalty shootout
 * * sh: (optional) suppress extra header row
 * * sbr: (optional) suppress meinturnierplan.de link
 * * lang: (optional) The language to use. Defaults to de
 * @param multitype:string $atts
 * @return string
 */
function mtpmatches_shortcoce($atts){
	ob_start();
	
	// Set default settings if no settings are given
	if (!isset($atts['lang'])) $atts['lang'] = 'de';
	foreach($atts as $key => $value) {
		if (is_numeric($key)) {
			$atts[$value] = "";
		}
	}
	
	// Start widget container
	echo '<div class="mtpwidgetspace">';
	
	if (!isset($atts['id'])) {
		echo '<b>Meinturnierplan.de</b><br>Missing argument "id".';
	} else {
		echo '<iframe class="mtpwidget" 
	src="'.MTP_ROOT.'/displayMatches.php?'.
	'id='.$atts['id'].
	'&setlang='.$atts['lang'];
		if (isset($atts['group'])) echo '&gr='.$atts['group'];
		if (isset($atts['team'])) echo '&tm='.$atts['team'];
		if (isset($atts['gamenumbers'])) echo '&mn='.$atts['gamenumbers'];
	
		if (isset($atts['si'])) echo '&si';
		if (isset($atts['st'])) echo '&st';
		if (isset($atts['sg'])) echo '&sg';
		if (isset($atts['se'])) echo '&se';
		if (isset($atts['sp'])) echo '&sp';
		if (isset($atts['sh'])) echo '&sh';
		if (isset($atts['sbr'])) echo '&sbr';
		
		if (isset($atts['s-size'])) echo '&s[size]='.urlencode($atts['s-size']);
		if (isset($atts['s-sizeheader'])) echo '&s[sizeheader]='.urlencode($atts['s-sizeheader']);
		if (isset($atts['s-color'])) echo '&s[color]='.urlencode($atts['s-color']);
		if (isset($atts['s-maincolor'])) echo '&s[maincolor]='.urlencode($atts['s-maincolor']);
		if (isset($atts['s-padding'])) echo '&s[padding]='.urlencode($atts['s-padding']);
		if (isset($atts['s-innerpadding'])) echo '&s[innerpadding]='.urlencode($atts['s-innerpadding']);
		if (isset($atts['s-bgcolor'])) echo '&s[bgcolor]='.urlencode($atts['s-bgcolor']);
		if (isset($atts['s-bcolor'])) echo '&s[bcolor]='.urlencode($atts['s-bcolor']);
		if (isset($atts['s-bsizeh'])) echo '&s[bsizeh]='.urlencode($atts['s-bsizeh']);
		if (isset($atts['s-bsizev'])) echo '&s[bsizev]='.urlencode($atts['s-bsizev']);
		if (isset($atts['s-bsizeoh'])) echo '&s[bsizeoh]='.urlencode($atts['s-bsizeoh']);
		if (isset($atts['s-bsizeov'])) echo '&s[bsizeov]='.urlencode($atts['s-bsizeov']);
		if (isset($atts['s-bbcolor'])) echo '&s[bbcolor]='.urlencode($atts['s-bbcolor']);
		if (isset($atts['s-bbsize'])) echo '&s[bbsize]='.urlencode($atts['s-bbsize']);
		if (isset($atts['s-bgeven'])) echo '&s[bgeven]='.urlencode($atts['s-bgeven']);
		if (isset($atts['s-bgodd'])) echo '&s[bgodd]='.urlencode($atts['s-bgodd']);
		if (isset($atts['s-bgover'])) echo '&s[bgover]='.urlencode($atts['s-bgover']);
		if (isset($atts['s-bghead'])) echo '&s[bghead]='.urlencode($atts['s-bghead']);
		if (isset($atts['s-ehrsize'])) echo '&s[ehrsize]='.urlencode($atts['s-ehrsize']);
		if (isset($atts['s-ehrtop'])) echo '&s[ehrtop]='.urlencode($atts['s-ehrtop']);
		if (isset($atts['s-ehrbottom'])) echo '&s[ehrbottom]='.urlencode($atts['s-ehrbottom']);
		
		echo '&s[wrap]=false';
		echo '" allowtransparency="true" frameborder="0" width="'.$atts['width'].'" height="'.$atts['height'].'" >
	<b>Meinturnierplan.de</b>
	<p>Ihr Browser kann das Turnierwidget leider nicht darstellen. <a href="'.MTP_ROOT.'/showit.php?id='.$atts['id'].'">Hier geht es zum Turnier.</a></p>		
</iframe>';
	}
	// End widget container
	echo '</div>';
	// Return result
	return ob_get_clean();
}
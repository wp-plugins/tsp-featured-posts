<?php
function php_browser_info(){
	$agent = $_SERVER['HTTP_USER_AGENT'];
	
	$x = dirname(__FILE__); 
	$browscap = $x . '/php_browser_detection_browscap.ini';
	if(!is_file(realpath($browscap)))
		return array('error'=>'No browscap ini file founded.');
	$agent=$agent?$agent:$_SERVER['HTTP_USER_AGENT'];
	$yu=array();
	$q_s=array("#\.#","#\*#","#\?#");
	$q_r=array("\.",".*",".?");
	
	if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
        $brows = parse_ini_file(realpath($browscap), true, INI_SCANNER_RAW);
	}else{
		$brows = parse_ini_file(realpath($browscap),true);
	}

	foreach($brows as $k=>$t){
	  if(fnmatch($k,$agent)){
	  $yu['browser_name_pattern']=$k;
	  $pat=preg_replace($q_s,$q_r,$k);
	  $yu['browser_name_regex']=strtolower("^$pat$");
	    foreach($brows as $g=>$r){
	      if($t['Parent']==$g){
	        foreach($brows as $a=>$b){
	          if($r['Parent']==$a){
	            $yu=array_merge($yu,$b,$r,$t);
	            foreach($yu as $d=>$z){
	              $l=strtolower($d);
	              $hu[$l]=$z;
	            }
	          }
	        }
	      }
	    }
	    break;
	  }
	}
	return $hu;
}

// GET BROWSER INFO **********************************************************

function get_browser_name() {
	
	$browserInfo = php_browser_info();
	
	if (is_firefox() ):
		return 'Firefox';
	elseif (is_safari()) :
		return 'Safari';
	elseif (is_opera()) :
		return 'Opera';		
	elseif (is_chrome()) :
		return 'Chrome';	
	elseif (is_IE()) :
		return 'The Root of all Evil';
	elseif (is_ipad()) :
		return 'iPad';
	elseif (is_ipod()) :
		return 'iPod';
	elseif (is_iphone()) :
		return 'iPhone';
	else :
		return 'Unknown Browser: ' . $browserInfo['browser'] . ' - Version: ' .get_browser_version();
	endif;
}

function get_browser_version() {
	$browserInfo = php_browser_info();
	return $browserInfo['version'];
}

// BROWSERS **********************************************************

function is_firefox ($version=''){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='Firefox') {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}	
}

function is_safari ($version=''){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='Safari') {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}
}

function is_chrome ($version=''){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='Chrome') {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}
}

function is_opera ($version=''){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='Opera') {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}	
}

function is_IE ($version=''){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE') {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}
}

// MOBILE / IPHONE / IPAD **********************************************************

function is_mobile (){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['ismobiledevice']) && $browserInfo['ismobiledevice']==1)
		return true;
	return false;	
}

function is_iphone ($version=''){
	$browserInfo = php_browser_info();
	if( ( isset($browserInfo['browser']) && $browserInfo['browser']=='iPhone' ) || strpos( $_SERVER['HTTP_USER_AGENT'] , 'iPhone') ) {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}
}

function is_ipad ($version=''){
	$browserInfo = php_browser_info();
	if ( preg_match("/iPad/", $browserInfo['browser_name_pattern'], $matches) || strpos( $_SERVER['HTTP_USER_AGENT'] , 'iPad') ) {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}	
}

function is_ipod (){
	$browserInfo = php_browser_info();
	if (preg_match("/iPod/", $browserInfo['browser_name_pattern'], $matches)) {
		if ($version == '') :
			return true;
		elseif ($browserInfo['majorver'] == $version ) :
			return true;
		else :
			return false;
		endif;
	} else {
		return false;	
	}	
}

// TEST FOR FEATURES ****************************************************

function browser_supports_javascript() {
	$browserInfo = php_browser_info();
	if(isset($browserInfo['javascript']) && $browserInfo['javascript']=='1')
		return true;
	return false;		
}

function browser_supports_cookies() {
	$browserInfo = php_browser_info();
	if(isset($browserInfo['cookies']) && $browserInfo['cookies']=='1')
		return true;
	return false;		
}

function browser_supports_css() {
	$browserInfo = php_browser_info();
	if(isset($browserInfo['supportscss']) && $browserInfo['supportscss']=='1')
		return true;
	return false;		
}

// IE VERSIONS **********************************************************

function is_IE6 (){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && $browserInfo['majorver'] == '6')
		return true;
	return false;	
}

function is_IE7 (){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && $browserInfo['majorver'] == '7')
		return true;
	return false;	
}

function is_IE8 (){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && $browserInfo['majorver'] == '8')
		return true;
	return false;	
}

function is_lt_IE6 (){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && (int)$browserInfo['majorver'] < 6)
		return true;
	return false;	
}

function is_lt_IE7 (){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && (int)$browserInfo['majorver'] < 7)
		return true;
	return false;	
}

function is_lt_IE8 (){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && (int)$browserInfo['majorver'] < 8)
		return true;
	return false;	
}


function is_lt_IE9 (){
	$browserInfo = php_browser_info();
	if(isset($browserInfo['browser']) && $browserInfo['browser']=='IE' && (int)$browserInfo['majorver'] < 9)
		return true;
	return false;	
}
?>
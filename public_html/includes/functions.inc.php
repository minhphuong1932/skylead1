<?php
/*************************************************************************
User Functions
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 07/11/2010
Coder: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
function LinkPager($url, $pages = 1, $page = 1, $bound = 5,$img_path='/images/'){
		$pager = array();
		$start = $page - $bound;
		if($start < 1) $start = 1;
		$end = $page + $bound;
		if($end > $pages) $end = $pages;
		$pager[] = array('name' => '<img src="'.$img_path.'ico_first.gif" alt="first" >','url' => sprintf($url,1), 'current' => 0);
		if($page == 1) $pager[] = array('name' => '<img src="'.$img_path.'ico_prev.gif" alt="previous">','url' => sprintf($url,$page), 'current' => 0);
		else  $pager[] = array('name' => '<img src="'.$img_path.'ico_prev.gif" alt="previous">','url' => sprintf($url,$page-1), 'current' => 0);
		for($i=$start; $i<=$end; $i++) {
			$current = 0;
			if($i==$page) $current = 1;
			$pager[] = array('name' => $i,'url' => sprintf($url,$i), 'current' => $current);
		}
		if($page == $end) $pager[] = array('name' => '<img src="'.$img_path.'ico_next.gif" alt="next" >','url' => sprintf($url,$page), 'current' => 0);
		else $pager[] = array('name' => '<img src="'.$img_path.'ico_next.gif" alt="next" >','url' => sprintf($url,$page+1), 'current' => 0);
		$pager[] = array('name' => '<img src="'.$img_path.'ico_last.gif" alt="last" >','url' => sprintf($url,$pages), 'current' => 0);
		return $pager;
	}
/// Link Page Kissparfum
function LinkPage($url, $pages = 1, $page = 1, $bound = 5,$img_path='/images/'){
		$pager = array();
		$start = $page - $bound;
		if($start < 1) $start = 1;
		$end = $page + $bound;
		if($end > $pages) $end = $pages;
		// if($page == 1) $pager[] = array('name' => '«','url' => sprintf($url,$page), 'current' => 0);
		// else  $pager[] = array('name' => '«','url' => sprintf($url,$page-1), 'current' => 0);
		for($i=$start; $i<=$end; $i++) {
			$current = 0;
			if($i==$page) $current = 1;
			$pager[] = array('name' => $i,'url' => sprintf($url,$i), 'current' => $current);
		}
		// $pager[] = array('name' => '...','url' => sprintf($url,'#'), 'current' => 0);
		// if($page == $end) $pager[] = array('name' => '»','url' => sprintf($url,$page), 'current' => 0);
		// else $pager[] = array('name' => '»','url' => sprintf($url,$page+1), 'current' => 0);
		return $pager;
	}
	
function TimeDateName($month='',$year='')
{
	if(!$month || !$year) return 0;
	$name=date("D", strtotime("".$year."-".$month."-1"));
	if(isset($name)){
		return $name;
	}else{
		return 0;
	  // Sun - Sat
	}
}
function TimeDateNameFromDate($day='',$month='',$year='')
{
	if(!$day || !$month || !$year) return 0;
	$name=date("D", strtotime("".$year."-".$month."-".$day));
	if(isset($name)){
		return $name;
	}else{
		return 0;
	  // Sun - Sat
	}
}
	
//Function to remove HTML tags, Javascript,...
function Filter($sstring){
$search = array ("'<'",  // Strip out javascript
				 "'>'",
				 "'\"'",
				 "'\''",
                 "'[\/\!]*?[^<>]*?>'si",  // Strip out html tags
                 "'([\r\n])[\s]+'",  // Strip out white space
                 "'&(quot|#34);'i",  // Replace html entities
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i",
                 "'&(nbsp|#160);'i",
                 "'&(iexcl|#161);'i",
                 "'&(cent|#162);'i",
                 "'&(pound|#163);'i",
                 "'&(copy|#169);'i",
                 "'&#(\d+);'e");  // evaluate as php
$replace = array ("",
				  "",
				  "",
				  "",
				  "",
				  "",
                  "",
                  "",
                  "",
                  "",
                  "",
                  "",
                  "",
                  "",
                  "",
                  "");
$text = preg_replace ($search, $replace, $sstring);
$data = explode("\\",$text);
$cleaned = implode("",$data);
return $cleaned;
}
function checkError($validate){
	foreach($validate as $check){
		if($check != NULL)
			return 1;
	}
	return 0;
}
function read_local_file($filename, $mode = "r") {
# Read content of a file and return a string
	$file = fopen($filename, $mode);
	if (!$file) { return ""; }
	$content = fread ($file, filesize($filename));
	fclose($file);
	return $content;
}

function write_local_file($filename, $content, $mode = "w") {
# Write a string to a file
	$file = fopen($filename, $mode);
	if (!$file) { return 0; }
	fwrite($file,$content);
	fclose($file);
	return 1;
}

function createComboFromSql($sql,$db,$value=''){		
	$result = mysqli_query($sql);		
	$str = '';
	while($row = mysqli_fetch_array($result)){
		$str .= "<option value=\"".$row['id']."\"".($row['id']==$value?" selected":"").">".$row['name']."</option>
";
	}				
	mysqli_free_result($result);
	return $str;
}

function optionSizeColor($value='', $where='(1=1)'){
	global $db;
	$sql = "SELECT concat( size, \" / \", color ) AS `id`,concat( size, \" / \", color ) AS `name` FROM `n_product_size_color` WHERE $where";
	return createComboFromSql($sql,$db,$value);
}

function optionProvinces($value='', $lang='vn', $where='(1=1)'){
	global $db;
	$sql = "SELECT id,vn_name AS `name` FROM `n_provinces` WHERE $where ORDER BY position";
	return createComboFromSql($sql,$db,$value);
}

function getProvinceName($id=0){
	global $db;
	$sql = "SELECT vn_name AS `name` FROM `n_provinces` WHERE id='$id'";
	$result = $db->query($sql);
	if(mysqli_num_rows($result)) {
		$row = mysqli_fetch_row($result);
		mysqli_free_result($result);
		return $row[0];
	}
	return "";
}

function sendSMS($phone, $message = '') {
	$user = "derasoft";
	$password = "rdt6ca";
	$api_id = "3160455";
	$from = "84918178278";
	$baseurl ="http://api.clickatell.com";
	$text = urlencode("$message");
	$to = "$phone";
	// auth call
	$url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";
	// do auth call
	$ret = file($url);
	// split our response. return string is on first line of the data returned
	$sess = split(":",$ret[0]);
	if ($sess[0] == "OK") {
		$sess_id = trim($sess[1]); // remove any whitespace
		$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text&from=$from";
		// do sendmsg call
		$ret = file($url);
#		echo $ret[0].'---';
		$send = split(":",$ret[0]);
		if ($send[0] == "ID") return $send[1]; #echo "success message ID: ". $send[1];
		else return 0; #echo "send message failed";
	} else {
#		echo 'failed';
		return 0; #echo "Authentication failure: ". $ret[0];
		exit();
	}
}

function cleanText($string) {
	#By Mai Minh for Vietnamese
	$string = utf8_encode($string);
	$string = str_replace(array("Ã","Ã€","áº¢","Ãƒ","áº ","Ã‚","áº¤","áº¦","áº¨","áºª","áº¬","Ä‚","áº®","áº°","áº²","áº´","áº¶","Ã¡","Ã ","áº£","Ã£","áº¡","Ã¢","áº¥","áº§","áº©","áº«","áº­","Äƒ","áº¯","áº±","áº³","áºµ","áº·"),"a",$string);
	$string = str_replace(array("Ä","Ä‘",),"d",$string);
	$string = str_replace(array("Ã‰","Ãˆ","áºº","áº¼","áº¸","ÃŠ","áº¾","á»€","á»‚","á»„","á»†","Ã©","Ã¨","áº»","áº½","áº¹","Ãª","áº¿","á»","á»ƒ","á»…","á»‡"),"e",$string);
	$string = str_replace(array("Ã","ÃŒ","á»ˆ","Ä¨","á»Š","Ã­","Ã¬","á»‰","Ä©","á»‹"),"i",$string);
	$string = str_replace(array("Ã“","Ã’","á»Ž","Ã•","á»Œ","Ã”","á»","á»’","á»”","á»–","á»˜","Æ ","á»š","á»œ","á»ž","á» ","á»¢","Ã³","Ã²","á»","Ãµ","á»","Ã´","á»‘","á»“","á»•","á»—","á»™","Æ¡","á»›","á»","á»Ÿ","á»¡","á»£"),"o",$string);
	$string = str_replace(array("Ãš","Ã™","á»¦","Å¨","á»¤","Æ¯","á»¨","á»ª","á»¬","á»®","á»°","Ãº","Ã¹","á»§","Å©","á»¥","Æ°","á»©","á»«","á»­","á»¯","á»±"),"u",$string);
	$string = str_replace(array("Ã","á»²","á»¶","á»¸","á»´","Ã½","á»³","á»·","á»¹","á»µ"),"y",$string);
	// replace some characters to similar ones
	$search  = array('ä', 'ö', 'ü','é','è','à','ç', 'à', 'è', 'ì',
					 'ò', 'ù', 'á', 'é', 'í', 'ó', 'ú', 'ë', 'ï' );
	$replace = array( 'a','o','u','e','e','a','c', 'a', 'e', 'i',
					  'o', 'u', 'a', 'e', 'i', 'o', 'u', 'e', 'i' );
	$string = str_replace($search, $replace, $string);
	return $string;
}

function userLog($store_id = 0, $uid = 0, $username = '', $type = 0, $page = "") {
	global $db,$sessId;
	$ip = $_SERVER['REMOTE_ADDR'];
	$time = date("Y-m-d H:i:s");
#echo $sessId;

	$sql = "SELECT * FROM ".DB_PREFIX."estore_online_users WHERE `store_id` = '$store_id' AND `sid`='$sessId'";
	$result = $db->query($sql);
	if(mysqli_num_rows($result)) { #Dang dang nhap
		$db->query("UPDATE ".DB_PREFIX."estore_online_users SET username='$username',sid='$sessId',uid='$uid',usertype='$type',ip='$ip',last_updated='$time',last_page='$page' WHERE sid='$sessId'");
	} else {	
		$db->query("INSERT INTO ".DB_PREFIX."estore_online_users (id,store_id,sid,uid,username,usertype,ip,last_updated,last_page) VALUES (NULL,'$store_id','$sessId','$uid','$username','$type','$ip','$time','$page')");
	}
	return 1;
}

function clearUserLog($store_id = 0, $uid = 0, $type = 0, $ip = '') {
	global $db;
	$sql = "DELETE FROM ".DB_PREFIX."estore_online_users WHERE store_id = '$store_id' AND uid='$uid' AND usertype='$type' AND ip='$ip'";
	$result = $db->query($sql);
	return 1;
}

function isUserOnline($store_id = 0, $uid = 0, $type = 0) {
	global $db;
	$time = date("Y-m-d H:i:s",time()-3600*ONLINE_TIME);
	$sql = "SELECT * FROM ".DB_PREFIX."estore_online_users WHERE store_id = '$store_id' AND uid='$uid' AND usertype='$type'";
	$result = $db->query($sql);
	if(mysqli_num_rows($result)) { #Dang dang nhap
		$row = mysqli_fetch_array($result);
		if($row['last_updated'] > $time) return 1;
	}
	return 0;
}

function debug($text = "") {
	write_local_file("./tmp/debug.txt",date("Y-m-d H:i:s")." ".$text."\n","a");
}

function increaseHit($store_id = 0) {
	global $db;
	$sql = "SELECT id FROM ".DB_PREFIX."estore_statistics WHERE id = '$store_id'";
	$result = $db->query($sql);
	if(mysqli_num_rows($result)) { #Da ton tai statistic cho Estore
		$sql = "UPDATE ".DB_PREFIX."estore_statistics SET hits=hits+1,him=him+1,hid=hid+1 WHERE id='$store_id'";
		$db->query($sql);
	} else {
		$db->query("INSERT INTO ".DB_PREFIX."estore_statistics (id,hits) VALUES ('$store_id','1')");
	}
	return 1;
}

function generateOrderCode($length=6) {
	$str = '';
	for ($i = 0; $i < $length; $i++) {
		$a = rand(1,4);
		switch($a) {
			case 1:
				// this numbers refer to numbers of the ascii table (upper-caps)
				$str .= chr(mt_rand(65, 90));
				break;
			case 2:
				// number
				$str .= mt_rand(1,9);
				break;
			case 3:
				// this numbers refer to numbers of the ascii table (upper-caps)
				$str .= chr(mt_rand(65, 90));
				break;
			case 4:
				// this numbers refer to numbers of the ascii table (upper-caps)
				$str .= chr(mt_rand(65, 90));
				break;
		}
	}
	$find = array('I','O');
	$replace = array(chr(mt_rand(74, 90)),chr(mt_rand(65, 72)));
	$str = str_replace($find,$replace,$str);
	return $str;
}
// function stripUnicode($str){
//   if(!$str) return false;
//    $unicode = array(
//      'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
//      'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
//      'd'=>'đ',
//      'D'=>'Đ',
//      'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
//    	  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
//    	  'i'=>'í|ì|ỉ|ĩ|ị',	  
//    	  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
//      'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
//    	  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
//      'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
//    	  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
//      'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
//      'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
//    );
//    foreach($unicode as $khongdau=>$codau) {
//      	$arr=explode("|",$codau);
//    	  $str = str_replace($arr,$khongdau,$str);
//    }
// return $str;
// }// Doi tu co dau => khong dau
// function changeTitle($str)
// {
// 	$str = stripUnicode($str);
// 	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
// 	$str = trim($str);
// 	$str=preg_replace('/[^a-zA-Z0-9\ ]/','',$str); 
// 	$str = str_replace("  "," ",$str);
// 	$str = str_replace(" ","-",$str);
// 	return $str;
// }

/*function listRDay($value = '0', $lang = DEFAULT_ADMIN_LANGUAGE){
	global $messages;
	$str = '';
	for($i=0; $i<28; $i++){
	$str .= '<option value="'.$messages['rday'][$i].'"'.($value==$messages['rday'][$i]?' selected="selected" ':'').'>'.$messages['rday'][$i].'</option>';
	}
	return $str;
}*/
function changeTitle($str)
{
 $str = stripUnicode($str);
 $str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
 $str = trim($str);
 $str=preg_replace('/[^a-zA-Z0-9\ ]/','',$str); 
 $str = str_replace("  "," ",$str);
 $str = str_replace(" ","-",$str);
 return $str;
}
function getCurrentPage() {
    $pageURL = 'http';
    //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
function getCurrentUrlNoLang($url,$fromletter) {
	$result = "/";
	if($url){
		// $pageURL=strstr($url, ":443/", false);
		// $result=substr($pageURL,5);
		$pageURL=strstr($url, $fromletter, false);
		$result=substr($pageURL,16);
	}
	 return $result;
 }
function getCurrentURlLg($url,$fromletter) {
   if($url){
   	$pageURL=strstr($url, "/".$fromletter."/", false);
   	$result=substr($pageURL,4);
   }
    return $result;
}
function getCurrentURlLg1($url,$fromletter) {
   if($url){
   	$pageURL=strstr($url, "/".$fromletter."/", false);
   	$result=substr($pageURL,4);
   	if (strpos($result, '&') !== false) {
	   	$variable = substr($result, 0, strpos($result, "&"));
	}else{
		$variable = $result;
	}
	return $variable;
   }
    
}
function isJpeg($str) {
	$ext = strtolower(substr($str,-3));
	if(preg_match("/jpg/",$ext)) return 1;
	return 0;
}
function isBmp($str) {
	$ext = strtolower(substr($str,-3));
	if(preg_match("/bmp/",$ext)) return 1;
	return 0;
}
function resize($image_path,$thumb_path,$image_name,$thumb_name,$dimension,$square=0,$quality=90) 
{ 
	$type = strtolower(substr($image_name,-3));
	$dst_type = strtolower(substr($thumb_name,-3));
	
	if($type == 'svg') {	# Support .SVG images
		copy("$image_path/$image_name","$thumb_path/$thumb_name");
	} else {
		switch ($type) {
			case 'jpg':
				$src = imagecreatefromjpeg("$image_path/$image_name");
				break;
			case 'gif':
				$src = imagecreatefromgif("$image_path/$image_name"); 	
				break;
			case 'png':
				$src = imagecreatefrompng("$image_path/$image_name");
				break;
			case 'bmp':
				$src = imagecreatefrombmp("$image_path/$image_name"); 	
				break;
		}
		$ow=imagesx($src);
		$oh=imagesy($src);
		$src_x = 0;
		$src_y = 0;
		if($ow>$oh) {
			if($ow>$dimension) {
				$nw = $dimension;
				$nh = (int)$oh*$nw/$ow;
			} else {
				$nw = $ow;
				$nh = (int)$oh*$nw/$ow;
			}
		} else {
			if($oh>$dimension) {
				$nh = $dimension;
				$nw = (int)$ow*$nh/$oh;
			} else {
				$nh = $oh;
				$nw = (int)$ow*$nh/$oh;
			}
		}
		if($square) {
			$length = min($ow,$oh);
			$src_x = ceil( $ow / 2 ) - ceil( $length / 2 );
			$src_y = ceil( $oh / 2 ) - ceil( $length / 2 );
			$nlength = max($nw,$nh);
			$nw = $nlength;
			$nh = $nlength;
			$ow = $length;
			$oh = $length;
		}
		$dst = imagecreatetruecolor($nw,$nh);
		
		# Transperent
		imagealphablending($dst, false);
		imagesavealpha($dst, true);
		
		# resize
		imagecopyresampled($dst,$src,0,0,$src_x,$src_y,$nw,$nh,$ow,$oh); 
		switch ($dst_type) {
			case 'gif': imagegif($dst, "$thumb_path/$thumb_name");
				break;
			case 'png': imagepng($dst, "$thumb_path/$thumb_name");
				break;
			case 'jpg': imagejpeg($dst, "$thumb_path/$thumb_name",$quality);
				break;
		}
		
		# Destroy image objects
		imagedestroy($src);
		imagedestroy($dst);	
	}
    return true; 
} 
function isGif($str) {
	$ext = strtolower(substr($str,-3));
	if(preg_match("/gif/",$ext)) return 1;
	return 0;
}
function isPng($str) {
	$ext = strtolower(substr($str,-3));
	if(preg_match("/png/",$ext)) return 1;
	return 0;
}
function isSvg($str) {
	$ext = strtolower(substr($str,-3));
	if(preg_match("/svg/",$ext)) return 1;
	return 0;
}
function isImage($str) {
	$ext = strtolower(substr($str,-3));
	if(preg_match("/jpg|png|bmp|gif|svg/",$ext)) return 1;
	return 0;
}

function isVideo($str) {
	$ext = strtolower(substr($str,-3));
	if(preg_match("/wmv|mpg|mp4|mov|avi|flv/",$ext)) return 1;
	return 0;
}
function isFlash($str) {
	$ext = strtolower(substr($str,-3));
	if(preg_match("/swf/",$ext)) return 1;
	return 0;
}
function isMusic($str) {
	$ext = strtolower(substr($str,-3));
	if(preg_match("/wma|wav|mp3|asf|/",$ext)) return 1;
	return 0;
}
function stripUnicode($str){
  if(!$str) return false;
   $unicode = array(
     'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     'd'=>'đ',
     'D'=>'Đ',
     'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
      'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
      'i'=>'í|ì|ỉ|ĩ|ị',   
      'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
      'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
      'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
     'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
   );
   foreach($unicode as $khongdau=>$codau) {
      $arr=explode("|",$codau);
      $str = str_replace($arr,$khongdau,$str);
   }
return $str;
}// Doi tu co dau => khong dau
?>
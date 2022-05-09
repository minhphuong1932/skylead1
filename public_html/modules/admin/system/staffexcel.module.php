<?php
/*************************************************************************
Article listing module
----------------------------------------------------------------
Derasoft CMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Last updated: 05/05/2012
Coder: Mai Minh
**************************************************************************/
checkPermission(array(3,4));
// $userInfo->checkPermission('article','view');
include_once(ROOT_PATH.'PHPExcel.php');
include_once(ROOT_PATH.'PHPExcel/IOFactory.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/users.class.php');
include_once(ROOT_PATH.'classes/data/validate.class.php');
$validate = new Validate();
$users = new Users(1);
$Estores=new EStores();
$templateFile = 'systemstaff.tpl.html';
$topNav = array('Cấu hình' => '/'.ADMIN_SCRIPT.'?op=system',
				'Quản lý nhân viên' => '/'.ADMIN_SCRIPT.'?op=system&act=staff',
				'Import nhân viên' => '');
//var_dump('aaaaa');
$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=tab';
$listTabs = array('Import' => $tabLink.'&mod=list');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',1);

$link2 = mysql_connect('localhost', 'portalap_user', 'SD8DbpJGC5');//nhớ 
mysql_select_db('portalap_db') or die("Cannot connect database!");
 mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
 mysql_close();

# Get parameters
	if($_POST){
		
		$file_type=$_FILES['linkfile']['type'];
		if($file_type=="application/vnd.ms-excel" || $file_type=="application/x-ms-excel" || $file_type=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
		{	
				$filename=$_FILES["linkfile"]["name"];
				move_uploaded_file($_FILES["linkfile"]["tmp_name"],$filename);
					
		//include the following 2 files
		$arrVNID =array();
		$objPHPExcel = PHPExcel_IOFactory::load($filename);
		//$listItems = $users->getObjects(1,"1>0",array("id" => "ASC"),100000);
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$worksheetTitle = $worksheet->getTitle();
		$highestRow = $worksheet->getHighestRow(); // e.g. 10
		//var_dump($highestRow);
		$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
		
		$nrColumns = ord($highestColumn) - 64;
		
		for ($row = 1; $row <= $highestRow; $row++) {
				$cell = $worksheet->getCellByColumnAndRow(0, $row);
				$username = $cell->getValue();	

				$cell = $worksheet->getCellByColumnAndRow(1, $row);
				$fullname = $cell->getValue();	

				$cell = $worksheet->getCellByColumnAndRow(3, $row);
				$email = $cell->getValue();	

				$cell = $worksheet->getCellByColumnAndRow(4, $row);
				$address = $cell->getValue();	

				$cell = $worksheet->getCellByColumnAndRow(5, $row);
				$tel = $cell->getValue();

				$cell = $worksheet->getCellByColumnAndRow(6, $row);
				$position = $cell->getValue();
								
				$store_id=1;
				$pass =	md5('87bvt!');
				$status=1;
				$created=date("Y-m-d H:i:s");
				$properties1 = serialize($properties);
				if($position == "" ){
					$position=1;
				}
								
				 // if($ID>0){
					// $sqlUpdate = "update table_product set masp='".$masp."', ten='".$ten."', gia='".$gia."' , id_cat='".$id_cat."'  where id='".$ID."'";
					// if(!mysql_query($sqlUpdate)){ echo "Update lỗi sản phẩm : ".$ID.'<br/>';}
				 // } else {
					$sql = "SELECT `id`,`username` FROM `dc_users`  WHERE `username`='$username'";
					 $sqlinsert = "INSERT INTO  dc_users (store_id,username,password,email,fullname,address,tel,type,date_created,status,properties) VALUES ('$store_id','$username','$pass','$email','$fullname','$address','$tel','$position','$created','$status','$properties1')";
					//$result = $link2->query($sql);
					$flag=0;
					$news_result = mysql_query($sql,$link2);
					while ($news_row = mysql_fetch_array($news_result)) {
						 $flag=$news_row['id']+1;
						  //var_dump($flag);
					}
					//var_dump($flag);
					$txVNID=$validate->validVNID($username);
					$txEMAIL=$validate->validEmail($email);
					$txTEL=$validate->validTel($tel);
					 if($txVNID['error']==1){
					 		$vnidvalue=$txVNID['value'];
							//$arrVNID=explode(' ',$vnidvalue);
							array_push($arrVNID, $vnidvalue);
							//$arrVNID1=implode(' ',$arrVNID);
							//var_dump($arrVNID);
							
					 	}
					if($txEMAIL['error']==1){
						$emailderror=$txVNID['value'];
						//$arrEMAIL=explode(',',$emailderror);
						array_push($arrEMAIL, $emailderror);
						//var_dump($arrEMAIL);
						
					}
					if($txTEL['error']==1){
						$telderror=$txVNID['value'];
						array_push($arrTEL, $telderror);
						//$arrTEL=explode(',',$telderror);
						//var_dump($arrTEL);

					}
					if($flag==0 && $username!='' && $txTEL['error']!=1 && $txVNID['error']!=1 && $txEMAIL['error']!=1)
					{
						//var_dump("okay");
					
						mysql_query($sqlinsert,$link2);
					}
					
					//mysql_query($sql,$link2);

				 // }
					
			}	
		}
		//transfer("Nhập File Thành Công", "index.php?com=excel&act=import");
		
		//unlink($filename) or DIE("couldn't delete $dir$file<br />");
		$template->assign('arrVNID',$arrVNID);
		$template->assign('arrEMAIL',$arrEMAIL);
		$template->assign('arrTEL',$arrTEL);
		$template->assign('importsuccess',"Thành công");
		}
		else{ //transfer("Không hổ trợ kiểu file này", "index.php?com=excel&act=import");
		$template->assign('importfail',"Lỗi import");
		}
	}
	
?>
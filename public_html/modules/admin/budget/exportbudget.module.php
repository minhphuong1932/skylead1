<?php
/*************************************************************************
capital listing module
----------------------------------------------------------------
Derasoft CMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Last updated: 28/05/2012
Coder: Mai Minh
**************************************************************************/
$userInfo->checkPermission('budgetcategory','view');
$templateFile = 'budgetcapital.tpl.html';
include_once(ROOT_PATH.'classes/dao/budgetcapitals.class.php');
include_once(ROOT_PATH.'classes/excel/excel.php');
include_once(ROOT_PATH.'excel_xml/excel_xml.php');
$budgetCapital = new BudgetCapitals($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['budget'] => '/'.ADMIN_SCRIPT.'?op=capital',
				$amessages['profile'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=budget&act=capital';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',1);

# Get parameters
$items_per_page = $request->element('ipp')?$request->element('ipp'):DEFAULT_ADMIN_ROWS_PER_PAGE;
if($items_per_page) $template->assign('ipp',$items_per_page);
$page = $request->element('pg')?$request->element('pg'):1;
if($page) $template->assign('pg',$page);
$sort_key = $request->element('sk')?$request->element('sk'):'id';
if($sort_key) $template->assign('sk',$sort_key);
$sort_direction = $request->element('sd')?$request->element('sd'):'DESC';
if($sort_direction) $template->assign('sd',$sort_direction);
$do = $request->element('doo')?$request->element('doo'):'';
if($do) $template->assign('do',$do);
$kw = $request->element('kw')?$request->element('kw'):'';
if($kw) $template->assign('kw',$kw);
$pId = $request->element('pId')?$request->element('pId'):0;
if($pId) {
	$gfId = $capitals->getParentIdFromId($pId);
	$template->assign('pId',$pId);
	$template->assign('gfId',$gfId);
	$topNav[$amessages['list_item']] = '/'.ADMIN_SCRIPT.'?op=budget&act=capital&mod=list';
	$topNav[$capitals->getNameFromId($pId)] = '';
}

# Build WHERE condition
$condition = "1>0";
if($kw) $condition = "(`id`='$kw' OR `warning` LIKE '%$kw%' OR `name` LIKE '%$kw%')";
$pages_condition = "`store_id` = '$storeId' AND ($condition)";
$sort = array($sort_key => $sort_direction);

# Page navigation
$rowsPages = $budgetCapital->getNumItems('id', $pages_condition,$items_per_page);
$template->assign('rowsPages',$rowsPages);
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$start_num = ($page-1)*$items_per_page+1;
$template->assign('startNum',$start_num);
$url = '/'.ADMIN_SCRIPT."?op=budget&act=capital&mod=list&doo=$do&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pId=$pId&pg=%d";
$pager = Url::genPager($url,$rowsPages['pages'],$page);
$template->assign('pager',$pager);

# Get objects
$listItems = $budgetCapital->getObjects($page,$condition,$sort,$items_per_page);
if($listItems) $template->assign('listItems',$listItems);

# Export excel from budget capital
$date = date("d-m-Y");
if($listItems){
	$lines = array();
	$i = 0;
	foreach($listItems as $item){
		$i++;
		$lines[] = array("STT" => $i,
						 "Tên" => $item->getName(),
						 "Người quản lý" => $item->getNameManager(),
						 "Số dư" => number_format($item->getBalance())." ".$item->getCurrencyName()
						);
	}
}
$export_file = "xlsfile://tmp/export-capital-".$date.".xls";
			$fp = fopen($export_file, "wb");
			if (!is_resource($fp))
			{
				die("Cannot open $export_file");
			}			
			fwrite($fp, serialize($lines));
			fclose($fp);
			
			header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
			header ("Cache-Control: no-cache, must-revalidate");
			header ("Pragma: no-cache");
			header ("Content-type: application/x-msexcel");
			header("Content-Transfer-Encoding: UTF8 ");
			header ("Content-Disposition: attachment; filename=\"" . basename($export_file) . "\"" );
			header ("Content-Description: PHP/INTERBASE Generated Data" );
			readfile($export_file);
			exit;
			
/*$excel = new excel_xml();
$header_style = array(
    'bold'       => 1,
    'size'       => '12',
    'color'      => '#FFFFFF',
    'bgcolor'    => '#4F81BD'
);
 
$excel->add_style('header', $header_style);
$excel->add_row(array(
    'Username',
    'First name',
    'Last name'
), 'header');
$excel->add_row(array(
    'Xuyen|2'
));
 
$excel->add_row(array(
    '*Marin*',
    'Crnkovic'
));

$excel->add_row('Some number:;12');
$excel->create_worksheet('User');
$xml = $excel->generate();
$excel->download('Download.xls');*/

?>
<?php
/*************************************************************************
Adding product category module
----------------------------------------------------------------
BiDo Project
Company: Derasoft Co., Ltd
Coder: Mai Minh
Email: info@derasoft.com
Last updated: 29/08/2011
**************************************************************************/
//checkPermission();
$userInfo->checkPermission('budgetexpenditure','view');
$templateFile = 'budgetexpenditureview.tpl.html';
include_once(ROOT_PATH."classes/data/textfilter.class.php");
include_once(ROOT_PATH.'classes/dao/expenditures.class.php');
$expenditures = new Expenditures($storeId);
include_once(ROOT_PATH.'classes/dao/budgetcapitals.class.php');
$budgetcapitals = new BudgetCapitals($storeId);
$template->assign('budgetcapitals',$budgetcapitals);
$id = $request->element('Id');
if($id){
	$expenditureInfo = $expenditures->getObject($id,'id');
	if($expenditureInfo) $template->assign('item',$expenditureInfo);
	# Check user manage
	
	if($userInfo->isSiteStaff()){
		//if($expenditureInfo->getUserId() != $userId)	header("location: /index.php?op=accessdenied");
		//if($expenditureInfo->getDateCreated() < date("Y-m-d")) header("location: /index.php?op=accessdenied");
	}
	$datenow = date("Y-m-d");
$template->assign('datenow',$datenow);
}

?>
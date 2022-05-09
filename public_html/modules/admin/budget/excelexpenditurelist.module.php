<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
/*************************************************************************
Admin reseller Product listing module
----------------------------------------------------------------
DeraPortal Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 20/02/2013
Coder: Xuyen Tran
**************************************************************************/
$templateFile = '';
include_once(ROOT_PATH.'classes/dao/expenditures.class.php');
include_once(ROOT_PATH.'classes/dao/products.class.php');
include_once(ROOT_PATH.'classes/dao/productcategories.class.php');
include_once(ROOT_PATH.'classes/dao/budgetcapitals.class.php');
$budgetCapitals = new BudgetCapitals($storeId);
$products = new Products($storeId);
$expenditures = new Expenditures($storeId);
$productCategories = new ProductCategories($storeId);

// filename for download 
$filename = "Bao-cao-thu-chi" . date('Ymd') . ".xls";
header("Cache-Control: no-cache, must-revalidate"); 
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-type:application/xls");
$curLoanAmount_Balance = 'Xuyên';
$currPayment = 'Paypal';
$lNoOfYearsPay = 'No';
$dbRatePay = 'dbRatePay';
$mscreenW = "800px";

$datenow = date("Y-m-d");

# Get parameters
$items_per_page = $request->element('ipp')?$request->element('ipp'):DEFAULT_ADMIN_ROWS_PER_PAGE;
$page = $request->element('pg')?$request->element('pg'):1;
$sort_key = $request->element('sk')?$request->element('sk'):'created';
$sort_direction = $request->element('sd')?$request->element('sd'):'ASC';
$do = $request->element('doo')?$request->element('doo'):'';
$kw = $request->element('kw')?$request->element('kw'):'';
$uid = $request->element('uid')?$request->element('uid'):'';
$type = $request->element('type')?$request->element('type'):'';
$capitalId = $request->element('capitalId')?$request->element('capitalId'):'';
$statusBill = $request->element('statusBill')?$request->element('statusBill'):'';

$status = $request->element('status')?$request->element('status'):'';
if($request->element('capitalId')){
	$cpId = $request->element('capitalId');
	$capitalInfo =$budgetCapitals->getObject($cpId);
}

$start = $request->element('start');
$end = $request->element('end');
if($start && $start != 'Từ') $dateStart = date("Y-m-d",strtotime($start));
else $dateStart = '';
if($end && $end != 'Đến') $dateEnd = date("Y-m-d",strtotime($end));
else $dateEnd = '';
$datediff = floor(abs(strtotime($dateStart) - strtotime($dateEnd))/(60*60*24));
if($datediff>=180){
	$error_code = 14;
	$template->assign('error_code',$error_code);
}

# Build WHERE condition
$condition = $uid>0?"`user_id` = '$uid'":"1>0";
if($type) $condition .= " and `type` = '$type'";
if($capitalId) $condition .= " and `capital_id` = '$capitalId'";
//if($userInfo->isSiteStaff())	$condition .= " and `user_id` = '$userId'";
if($userInfo->isSiteStaff()){
	$listAllUser = $budgetCapitals->getAllCapption("`user_id` = '$userId'");
	if($listAllUser)	$condition .= " and `capital_id` in ($listAllUser)";
	else $condition .= " and `user_id` = '$userId'";

}
if($do && $statusBill!=-1) $condition .= " AND `status_bill` = '$statusBill'";
if($do && $status!=-1) $condition .= " AND `status` = '$status'";
if($do && ($dateStart || $dateEnd) && $datediff<=180) $condition .= " AND `created` BETWEEN '".$dateStart." 00:00:00' and '".$dateEnd." 23:59:59'";

//if($userInfo->isSiteStaff())	$condition .= " and `user_id` = '$userId'";
if($kw) $condition .= " and (`id`='$kw' OR `name` LIKE '%$kw%' OR `price` LIKE '%$kw%' OR `note` LIKE '%$kw%')";
$sort = array($sort_key => $sort_direction);

# Get objects
$listItems = $expenditures->getObjects($page,$condition,$sort,'');
$capitalName = $budgetCapitals->getNameFromId($capitalId);
?>
<table align="center" style=" font-family:'Times New Roman', Times, serif; width:<?php echo $mscreenW;?>" cellpadding="4" cellspacing="0" border="1">
    <tr><td colspan="8" align="left" style="text-transform:uppercase; font-size:20px; padding-left:700px; font-weight:bold; text-align:center">BÁO CÁO THU CHI - <?php echo date("m-Y"); ?></td></tr>
     <tr>
     	<td colspan="4" align="left">Công ty TNHH Phần Mềm Kỷ Nguyên Số</td>
        <td align="left">Loại Quỹ:</td>
        <td colspan="3" align="left"><?php echo $capitalName;?></td>
     </tr>
     <tr>
     	<td colspan="4" align="left">87/1A Bành Văn Trân, P.7, Q. Tân Bình, TP.HCM</td>
        <td align="left">Từ ngày:</td>
        <td align="left"><?php echo date('d/m/Y',strtotime($start));?></td>
        <td align="left">Đến ngày:</td>
        <td align="left"><?php echo date('d/m/Y',strtotime($end));?></td>
     </tr>
     <tr><td colspan="8"></td></tr>
     
<?php
if($listItems){
	$i=1;
	$totalThu = 0;
	$totalChi = 0;
	$total = 0;
	foreach($listItems as $item){
	if($i == 1){
	?>
    <tr>
     	<td colspan="8"><b>Số dư đầu kỳ:</b> <span style="text-align:left"><?php echo number_format($item->getPbalance());?></span></td>
     </tr>
     <tr><td colspan="8"></td></tr>
     <tr>
     	<td width="8%"><b>STT</b></td>
        <td width="10%"><b>Mã số</b></td>
        <td width="15%"><b>Ngày lập phiếu</b></td>
        <td width="30%"><b>Diễn giải nội dung</b></td>
        <td width="10%"><b>Phiếu thu</b></td>
        <td width="10%"><b>Phiếu chi</b></td>
        <td width="10%"><b>Số dư</b></td>
        <td></td>
     </tr>
    <?php	
	}
	if($item->getType() == 1){
		$totalThu = $totalThu+$item->getPrice();
	?>
     <tr>
     	<td><?php echo $i;?></td>
        <td><?php echo $item->getId();?></td>
        <td><?php echo date('d/m/Y',strtotime($item->getDateCreated()));?></td>
        <td><?php echo $item->getNote();?></td>
        <td style="color:#00F; text-align:right"><?php echo number_format($item->getPrice());?></td>
        <td style="color:#F00;"></td>
        <td style="text-align:right"><?php echo number_format($item->getBalance());?></td>
        <td></td>
     </tr>
     <?php
	}else{
		$totalChi = $totalChi+$item->getPrice();
	 ?>
      <tr>
     	<td><?php echo $i;?></td>
        <td><?php echo $item->getId();?></td>
        <td><?php echo date('d/m/Y',strtotime($item->getDateCreated()));?></td>
        <td><?php echo $item->getNote();?></td>
        <td style="color:#00F; text-align:right"></td>
        <td style="color:#F00; text-align:right"><?php echo number_format($item->getPrice());?></td>
        <td style="text-align:right"><?php echo number_format($item->getBalance());?></td>
        <td></td>
     </tr>
    <?php
	 }
	 if($i == count($listItems))	$total = $item->getBalance();
	$i++;	
	}
}
?>
<tr><td colspan="8"></td></tr>
<tr>
	<td colspan="3"></td>
    <td><b>Cộng phát sinh trong kỳ:</b></td>
    <td style="color:#00F; font-weight:bold; text-align:right"><?php echo number_format($totalThu);?></td>
    <td style="color:#F00; font-weight:bold; text-align:right"><?php echo number_format($totalChi);?></td>
    <td></td>
    <td></td>
</tr>
<tr>
	<td colspan="3"></td>
    <td><b>Số dư cuối kỳ:</b></td>
    <td colspan="2"></td>
    <td style="color:#333; font-weight:bold; text-align:right"><?php echo number_format($total);?></td>
    <td></td>
</tr>
<tr><td colspan="7" style="border:none"></td></tr>
<tr><td colspan="7" style="border:none"></td></tr>
<tr>
	<td style="border:none" colspan="3"></td>
	<td style="border:none"><b>Thủ quỹ</b></td>
    <td style="border:none">&nbsp;</td>
    <td style="border:none"><b>Thủ trưởng</b></td>
    <td style="border:none" colspan="2"></td>    
</tr>
<tr>
	<td style="border:none" colspan="3"></td>
	<td style="border:none"><i>(Ký,họ tên)</i></td>
    <td style="border:none">&nbsp;</td>
    <td style="border:none"><i>(Ký,họ tên)</i></td>
    <td style="border:none" colspan="2"></td>    
</tr>
<tr><td colspan="7" style="border:none"></td></tr>
<tr><td colspan="7" style="border:none"></td></tr>
<tr><td colspan="7" style="border:none"></td></tr>
</table>
<?php
?>
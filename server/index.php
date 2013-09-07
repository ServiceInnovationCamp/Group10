	<?php
//header('content-type:text/html;charset=utf-8');
error_reporting(0);
$sq=$_REQUEST['q'];
$sqa=explode(" ",$sq);
$sqf=$sqa[0];
 //echo $sqf;
$data=file_get_contents('http://www.comilla.gov.bd/api/search?keyword='.$sqf,'r');
//echo rawurldecode($data);
// var_dump($data);
function sanitize($thing){
	$otp=strip_tags($thing);
	//$otp=html_entity_decode($otp,ENT_IGNORE);
	$otp=trim($otp,"&nbsp;");
	$otp=preg_replace("/\s+/i"," ",$otp);
	// $otp=preg_replace("/(&nbsp;+)/i","&nbsp;",$otp);
	$otp=str_replace("০", "0", $otp);
	$otp=str_replace("১", "1", $otp);
	$otp=str_replace("২", "2", $otp);
	$otp=str_replace("৩", "3", $otp);
	$otp=str_replace("৪", "4", $otp);
	$otp=str_replace("৫", "5", $otp);
	$otp=str_replace("৬", "6", $otp);
	$otp=str_replace("৭", "7", $otp);
	$otp=str_replace("৮", "8", $otp);
	$otp=str_replace("৯", "9", $otp);
	$ress=preg_replace('/(\d{2,6})-?(\d{5,11})/i',"<a href='tel:$1$2'>$1-$2</a> ",$otp);
	return $ress;
}
$alld=json_decode($data);
//var_dump($alld);
foreach($alld as $dt){?>
	
<table class="tdata full">
			<tr>
				<td>
					<h1><?php echo sanitize($dt->title)?></h1>
					<h2>
						<?php echo sanitize($dt->body)?>
					</h2>
					<p>
						<a href="<?php echo strip_tags($dt->url)?>"><?php echo strip_tags($dt->url)?></a>
					</p>
				</td>
			</tr>
		</table>
<?php
}
if(sizeof($alld)<1){
	echo "<h1 class='nodata'>:( </h1>";
	echo "<h2 class='nodataf'>দু:খিত, আপনাকে সাহায্য করতে পারলাম না </h2>";
}
?>
<div class="swiprvrc"></div>
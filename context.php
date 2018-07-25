<?php
include('connDB.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<style>
	#content{
		width: auto;
		height:50px;
		background-color: #4CD0C6;
		text-align: center;
		color:#FFFFFF;
		font-weight:bold;
		font-size: 30px;
		line-height:50px;
		border-radius:10px;
	}
	.table_style{
		width: 100%;
		border-radius:10px;
		border: #4CD0C6 solid 2px;
		margin: 15px 14px 0 0;
		border-collapse: separate;
		border-spacing: 0;
		text-align: center;
		
	}
	.tetle{
		background: aquamarine;
		text-align:center;
		font-size: 20px;
	}
	tr,td{
		border: 1px solid #4CD0C6;
	}
	tr:first-child td:first-child{
  		border-top-left-radius: 10px;
	}
	tr:last-child td:first-child{
  		border-bottom-left-radius: 10px;
	}
	tr:first-child td:last-child{
  		border-top-right-radius: 10px;
	}
	tr:last-child td:last-child{
  		border-bottom-right-radius: 10px;
	}
</style>
</head>

<body style="font-family: Microsoft JhengHei;">
	<?
		$qid=$_GET["qid"];
			$sql_question="SELECT question FROM `lime_questions` WHERE `language`='zh-Hant-TW'and qid= $qid  ";
			$result_question = mysql_query($sql_question);
			$rs = mysql_fetch_assoc($result_question);
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u',$rs['question'] , $matches);
			$prs['question'] = join('', $matches[0]);
			echo '<div name="content" id="content">';
			echo $prs["question"];
			echo "</div>";
		?>
	<table class="table_style">
	<tbody>
		<td></td>
		<td class="tetle">項目</td>
		<td class="tetle">樣本數</td>
		<?
			$r=1;
			if(isset($r_ans[$qid] )){
				foreach($r_ans[$qid] as $i=> $vlaue){
				$Arr[] =$r+$i;
				echo '<td class="tetle">'.$vlaue."</td>";
				}
			}else echo "沒有資料";
		?>

	
	<?
		$q_code=$_GET["title"];
		$sql="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE `782171X44X2743D101` GROUP BY `$q_code`";
			$rquery= mysql_query($sql);
			$sum=0;
			while($rs = mysql_fetch_assoc($rquery)){
				$sum+=$rs["total"];
				$k_d[$rs[$q_code]]=$rs["total"];
			}
	?>
	<tr>
		<td></td>
		<td class="tetle">合計</td>
		<td><?=$sum;?></td>
		<?
			$rquery= mysql_query($sql);
			foreach($Arr as $rr){
				if(!isset($k_d[$rr])) $k_d[$rr]=0;
				echo "<td>".$k_d[$rr]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td rowspan='2' class="tetle">性別</td>
		<td>男</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2743D101=1 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}	
		?>
	</tr>		
	<tr>	
		<td>女</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2743D101=2 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}	
		?>
	</tr>		
	<tr>	
		<td rowspan='6' class="tetle">年齡</td>
		<td>18-24歲</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2744=1 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}	
		?>
	</tr>	
	<tr>	
		<td>25-34 歲</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2744=2 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}	
		?>
	</tr>	
	<tr>	
		<td>35-44 歲</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2744=3 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}	
		?>	
	</tr>	
	<tr>	
		<td>45-54 歲</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2744=4 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}	
		?>			
	</tr>		
	<tr>	
		<td>55-64 歲</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2744=5 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}	
		?>		
	</tr>		
	<tr>	
		<td>65歲以上</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2744=6 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}	
		?>		
	</tr>		
	<tr>	
		<td rowspan='5' class="tetle">教育程度</td>
		<td>國中及以下</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2747D501=1 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	<tr>	
		<td>高中職</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2747D501=2 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	<tr>	
		<td>專科</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2747D501=3 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>		
	</tr>	
	<tr>	
		<td>大學</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2747D501=4 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>		
	</tr>		
	<tr>	
		<td>研究所及以上</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2747D501=5 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>		
	</tr>	
	<tr>	
		<td rowspan='10' class="tetle">職業</td>
		<td>學生</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=1 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	<tr>	
		<td>軍警</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=2 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	<tr>	
		<td>公教人員</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=3 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	<tr>	
		<td>勞工</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=4 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>		
	<tr>	
		<td>服務業</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=5 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	<tr>	
		<td>農林漁牧</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=6 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	<tr>	
		<td>自由業</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=7 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	<tr>	
		<td>家管</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=8 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	<tr>	
		<td>退休人員</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=9 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>		
	<tr>	
		<td>待業中</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=10 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>		
	<tr>	
		<td rowspan='5' class="tetle">居住地</td>
		<td>亞洲</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2748=1 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	<tr>	
		<td>美洲</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2748=2 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	<tr>	
		<td>歐洲</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2748=3 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	<tr>	
		<td>大洋洲</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2748=4 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>		
	<tr>	
		<td>非洲</td>
		<?
		$k=0;
		$tls = array();
		foreach($Arr as $ar){		
			$sql1="SELECT $q_code , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2748=5 and $q_code=$ar ORDER BY `lime_survey_782171`.`$q_code` ASC";
			$rquery1= mysql_query($sql1);
			$rs1 = mysql_fetch_assoc($rquery1);
			$tls[]=$rs1["total"];
			$k+=$rs1["total"];
		}
		echo "<td>".$k."</td>";
		foreach($tls as $tl){
			echo "<td>".$tl."</td>";
		}
		?>
	</tr>	
	</tbody>
	</table>
</body>
</html>
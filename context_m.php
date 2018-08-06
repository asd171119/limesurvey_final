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
		$q_code=array();
		$qid=$_GET["qid"];
				$sql_question="SELECT question FROM `lime_questions` WHERE `language`='zh-Hant-TW'and qid= $qid  ";
				$result_question = mysql_query($sql_question);
				$rs = mysql_fetch_assoc($result_question);
				echo '<div name="content" id="content">';
				echo $rs["question"];
				echo "</div>";
		?>
	<table class="table_style">	
	<tbody>
		<td></td>
		<td class="tetle">項目</td>
		<td class="tetle">樣本數</td>
		<?
				$sql_answer="SELECT `qid`,`question` FROM `lime_questions` WHERE `parent_qid`='$qid' AND`language`='zh-Hant-TW'";
 				$result_answer = mysql_query($sql_answer);
				$count_answer=mysql_num_rows($result_answer); 
	
				for($i=0;$i<$count_answer;$i++){
					$array_answer[$i]=mysql_fetch_array($result_answer);
					echo '<td  class="tetle">'.$array_answer[$i]['question']."</td>";
				}
		?>
	
	<?	
		$code=$_GET["title"];
		switch($code){
			case '782171X41X2688SQ010': 
				array_push($q_code,'782171X41X2688SQ001','782171X41X2688SQ002','782171X41X2688SQ003','782171X41X2688SQ004','782171X41X2688SQ005','782171X41X2688SQ006','782171X41X2688SQ007','782171X41X2688SQ008','782171X41X2688SQ009','782171X41X2688SQ010');
				break;
			case '782171X41X268917':
				array_push($q_code,'782171X41X26891','782171X41X26892','782171X41X26893','782171X41X26894','782171X41X26895','782171X41X26896','782171X41X26897','782171X41X26898','782171X41X26899','782171X41X268910','782171X41X268911','782171X41X268912','782171X41X268913','782171X41X268914','782171X41X268915','782171X41X268916','782171X41X268917');
				break;
			case '782171X41X269639':
				array_push($q_code,'782171X41X26961','782171X41X26962','782171X41X26963','782171X41X26964','782171X41X26965','782171X41X26966','782171X41X26967','782171X41X26968','782171X41X26969','782171X41X269610','782171X41X269611','782171X41X269612','782171X41X269613','782171X41X269614','782171X41X269615','782171X41X269616','782171X41X269617','782171X41X269618','782171X41X269619','782171X41X269620','782171X41X269621','782171X41X269622','782171X41X269623','782171X41X269624','782171X41X269625','782171X41X269626','782171X41X269627','782171X41X269628','782171X41X269629','782171X41X269630','782171X41X269631','782171X41X269632','782171X41X269633','782171X41X269634','782171X41X269635','782171X41X269636','782171X41X269637','782171X41X269638','782171X41X269639');
				break;
			case '782171X41X26956':
				array_push($q_code,'782171X41X26951','782171X41X26952','782171X41X26953','782171X41X26954','782171X41X26955','782171X41X26956');
				break;
			case '782171X41X27598':
				array_push($q_code,'782171X41X27591','782171X41X27592','782171X41X27593','782171X41X27594','782171X41X27595','782171X41X27596','782171X41X27597','782171X41X27598');
				break;
		}
		
		$count=count($q_code);
			$sql="SELECT $code , COUNT( * ) as total FROM `lime_survey_782171` WHERE `782171X44X2743D101` GROUP BY `$code` ";
			$rquery= mysql_query($sql);
			$sum=0;
			while($rs = mysql_fetch_assoc($rquery)){
				$sum+=$rs["total"];
				$k_d[$rs[$code]]=$rs["total"];
			}
	?>
	<tr>
		<td ></td>
		<td class="tetle">合計</td>
		<td><? echo $sum;?></td>
		<?  
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE `782171X44X2743D101` GROUP BY `$q_code[$i]` ";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array[$ii]=mysql_fetch_array($rquery1);
					if($count1=='1'){
						echo "<td>0</td>";
					}else{
						if($array[$ii][0]=='Y'){
							$ans=$array[$ii][1]/$sum*100;
						echo "<td>".round($ans,2)."  %</td>";
						}
					}
					
				}
			}
		?>
	</tr>	
	<tr>	
		<td rowspan='2' class="tetle">性別</td>
		<td>男</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2743D101=1 and `$q_code[$i]`='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>		
	<tr>	
		<td>女</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2743D101=2 and `$q_code[$i]`='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>		
	<tr>	
		<td rowspan='6' class="tetle">年齡</td>
		<td>18-24歲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2744=1 and `$q_code[$i]`='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>25-34 歲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2744=2 and `$q_code[$i]`='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>35-44 歲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2744=3 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>	
	</tr>	
	<tr>	
		<td>45-54 歲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2744=4 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>			
	</tr>		
	<tr>	
		<td>55-64 歲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2744=5 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>		
	</tr>		
	<tr>	
		<td>65歲以上</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2744=6 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>		
	</tr>		
	<tr>	
		<td rowspan='5' class="tetle">教育程度</td>
		<td>國中及以下</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2745SQ301=1 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>高中職</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2745SQ301=2 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>專科</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2745SQ301=3 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>		
	</tr>	
	<tr>	
		<td>大學</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2745SQ301=4 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>		
	</tr>		
	<tr>	
		<td>研究所及以上</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2745SQ301=5 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>		
	</tr>	
	<tr>	
		<td rowspan='10' class="tetle">職業</td>
		<td>學生</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=1 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>軍警</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=2 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>公教人員</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=3 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>勞工</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=4 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>		
	<tr>	
		<td>服務業</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=5 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>農林漁牧</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=6 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>自由業</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=7 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>家管</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=8 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>退休人員</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=9 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>		
	<tr>	
		<td>待業中</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2746=10 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>		
	<tr>	
		<td rowspan='5' class="tetle">居住地</td>
		<td>亞洲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2748=1 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>美洲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2748=2 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>歐洲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2748=3 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>大洋洲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2748=4 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>		
	<tr>	
		<td>非洲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_782171` WHERE 782171X44X2748=5 and $q_code[$i]='Y' ORDER BY `lime_survey_782171`.`$q_code[$i]` ASC";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array_y[$ii]=mysql_fetch_array($rquery1);
					array_push($y,$array_y[$ii][1]);	
					$k+=$array_y[$ii][1];
				}
			}
			echo "<td>".$k."</td>";
			for($ii=0;$ii<$count;$ii++){
				$ans=$y[$ii]/$k*100;
				echo "<td>".round($ans,2)."  %</td>";
			}
		?>
	</tr>	
	</tbody>
	</table>
</body>
</html>
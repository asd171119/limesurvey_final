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
			case '12X9X720SQ010': 
				array_push($q_code,'12X9X720SQ001','12X9X720SQ002','12X9X720SQ003','12X9X720SQ004','12X9X720SQ005','12X9X720SQ006','12X9X720SQ007','12X9X720SQ008','12X9X720SQ009','12X9X720SQ010');
				break;
			case '12X9X72117':
				array_push($q_code,'12X9X7211','12X9X7212','12X9X7213','12X9X7214','12X9X7215','12X9X7216','12X9X7217','12X9X7218','12X9X7219','12X9X72110','12X9X72111','12X9X72112','12X9X72113','12X9X72114','12X9X72115','12X9X72116','12X9X72117');
				break;
			case '12X9X72839':
				array_push($q_code,'12X9X7281','12X9X7282','12X9X7283','12X9X7284','12X9X7285','12X9X7286','12X9X7287','12X9X7288','12X9X7289','12X9X72810','12X9X72811','12X9X72812','12X9X72813','12X9X72814','12X9X72815','12X9X72816','12X9X72817','12X9X72818','12X9X72819','12X9X72820','12X9X72821','12X9X72822','12X9X72823','12X9X72824','12X9X72825','12X9X72826','12X9X72827','12X9X72828','12X9X72829','12X9X72830','12X9X72831','12X9X72832','12X9X72833','12X9X72834','12X9X72835','12X9X72836','12X9X72837','12X9X72838','12X9X72839');
				break;
			case '12X9X7276':
				array_push($q_code,'12X9X7271','12X9X7272','12X9X7273','12X9X7274','12X9X7275','12X9X7276');
				break;
			case '12X9X7918':
				array_push($q_code,'12X9X7911','12X9X7912','12X9X7913','12X9X7914','12X9X7915','12X9X7916','12X9X7917','12X9X7918');
				break;
		}
		
		$count=count($q_code);
			$sql="SELECT $code , COUNT( * ) as total FROM `lime_survey_12` WHERE `12X12X775D101` GROUP BY `$code` ";
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
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE `12X12X775D101` GROUP BY `$q_code[$i]` ";
				$rquery1= mysql_query($sql1);
				$count1=mysql_num_rows($rquery1);
				
				for($ii=0;$ii<$count1;$ii++){
					$array[$ii]=mysql_fetch_array($rquery1);
					if($count1=='1'){
						echo "<td>0</td>";
					}else{
						if($array[$ii][0]=='Y'){
						echo "<td>".$array[$ii][1]."</td>";
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
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X775D101=1 and `$q_code[$i]`='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>		
	<tr>	
		<td>女</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X775D101=2 and `$q_code[$i]`='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
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
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X776=1 and `$q_code[$i]`='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>25-34 歲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X776=2 and `$q_code[$i]`='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>35-44 歲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X776=3 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>	
	</tr>	
	<tr>	
		<td>45-54 歲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X776=4 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>			
	</tr>		
	<tr>	
		<td>55-64 歲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X776=5 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>		
	</tr>		
	<tr>	
		<td>65歲以上</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X776=6 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
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
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X777SQ301=1 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>高中職</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X777SQ301=2 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>專科</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X777SQ301=3 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>		
	</tr>	
	<tr>	
		<td>大學</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X777SQ301=4 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>		
	</tr>		
	<tr>	
		<td>研究所及以上</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X777SQ301=5 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
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
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X778=1 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>軍警</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X778=2 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>公教人員</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X778=3 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>勞工</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X778=4 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>		
	<tr>	
		<td>服務業</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X778=5 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>農林漁牧</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X778=6 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>自由業</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X778=7 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>家管</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X778=8 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>退休人員</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X778=9 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>		
	<tr>	
		<td>待業中</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X778=10 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
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
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X779D501=1 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>美洲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X779D501=2 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>歐洲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X779D501=3 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	<tr>	
		<td>大洋洲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X779D501=4 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>		
	<tr>	
		<td>非洲</td>
		<?
			$k=0;
			$y=array();
			for($i=0;$i<$count;$i++){
				$sql1="SELECT $q_code[$i] , COUNT( * ) as total FROM `lime_survey_12` WHERE 12X12X779D501=5 and $q_code[$i]='Y' ORDER BY `lime_survey_12`.`$q_code[$i]` ASC";
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
				echo "<td>".$y[$ii]."</td>";
			}
		?>
	</tr>	
	</tbody>
	</table>
</body>
</html>
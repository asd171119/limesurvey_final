<?php
include('connect.php');

//lime_survey_12
		$all="SELECT * FROM `lime_survey_12`";
 		$result_all = mysql_query($all);
		$count_all=mysql_num_rows($result_all);
		while($rs = mysql_fetch_assoc($result_all)){
				//取key
				$array_key=array();
				$ABC=array();
				$D=array();
 				foreach ($rs as $key=>$value){
					if (preg_match("/other/i", $key)==false) {
						array_push($array_key,$key);
					}
				}//print_r($array_key);
				$count_key=count($array_key);
				//刪除前8個
				for($i=0;$i<8;$i++){
					unset($array_key[$i]);
				}
		}//print_r($array_key);
		//key分類ABC
		$all_Atitle=array();
		$all_Btitle=array();
		$all_Ctitle=array();
		$Aqid=array();
		$Bqid=array();
		$Cqid=array();
		for($i=8;$i<$count_key;$i++){
			$abc=explode("X",$array_key[$i]);
			switch($abc[1]){
				case '9':
					$cut=explode("X",$array_key[$i]);
					$Qid= mb_substr($cut[2],0,3,"utf-8"); 
					array_push($all_Atitle,$array_key[$i]);
					array_push($Aqid,$Qid);
					$count_Aqid=count($Aqid);
					break;
				case '10':
					$cut=explode("X",$array_key[$i]);
					$Qid= mb_substr($cut[2],0,3,"utf-8"); 
					$all_Btitle[$Qid][]=$array_key[$i];
					//array_push($all_Btitle,$array_key[$i]);
					$Bqid[]=$Qid;
					$count_Bqid=count($Bqid);
					break;
				case '11':
					$cut=explode("X",$array_key[$i]);
					$Qid= mb_substr($cut[2],0,3,"utf-8"); 
					array_push($all_Ctitle,$array_key[$i]);
					array_push($Cqid,$Qid);
					$count_Cqid=count($Cqid);
					break;
			}
		}

	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<style type="text/css">
a,a:link,a:visited{color:#000000;text-decoration: none}
a:hover{color:#F4AB25;background-color: #FFECD9;text-decoration: none;}
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
		float: left;
		border-radius:10px;
		border: #4CD0C6 solid 2px;
		margin: 15px 14px 0 0;
	}
	.title{
		text-align: center;
		font-size: 24px;
		border-bottom:dashed #4CD0C6 2px;
	}
</style>
</head>

<body style="font-family: Microsoft JhengHei;">
<div name="content" id="content">問卷分析</div>
<form action="context.php" method="POST">

	<table width="430" class="table_style">
  <tbody>
    <tr>
      <td class="title">A部分</td>
    </tr>
    
     <?php 
	  //question
		for($ii=0;$ii<$count_Aqid;$ii++){
			$j=$ii+1;
			if($Aqid[$ii]!=$Aqid[$j]){
				$asql_question="SELECT `question` FROM `lime_questions` WHERE `language`='zh-Hant-TW' AND `qid`='$Aqid[$ii]' ";
				$aresult_question = mysql_query($asql_question);
				$acount_question=mysql_num_rows($aresult_question); 
			
				for($i=0;$i<$acount_question;$i++){
					$aarray_question[$i]=mysql_fetch_array($aresult_question);
					if($Aqid[$ii]=='720'||$Aqid[$ii]=='721'||$Aqid[$ii]=='727'||$Aqid[$ii]=='728'||$Aqid[$ii]=='791'){
						$a='context_m.php?qid='.$Aqid[$ii].'&title='.$all_Atitle[$ii].'>';
					}else{
						$a='context.php?qid='.$Aqid[$ii].'&title='.$all_Atitle[$ii].'>';
					}
					echo '<tr><td><a href='.$a.$aarray_question[$i]['question'].'</a></td></tr>';
				}
			}
			
		}
	  
	  ?>
    
  </tbody>
</table>
<table width="430" class="table_style">
  <tbody>
    <tr>
      <td class="title">B部分</td>
    </tr>
    
     <?php 
	  //question
	  $BB=array();
	  $P_BB=array();
	  $P_ans=array();
	  
	  $BB = array_unique($Bqid);
	   foreach($BB as $bqa){
		//$bsql_question="SELECT `question` FROM `lime_questions` WHERE `language`='zh-Hant-TW' AND `qid`='$bqid' ";
		$bsql_ans="SELECT `question`,`question_order` FROM  `lime_questions` WHERE  `parent_qid` ='$bqa' AND  `language` =  'zh-Hant-TW' ";
		  $bresult_question = mysql_query($bsql_ans);
			while($ba=mysql_fetch_assoc($bresult_question)){
			  $bi[$bqa][]=$ba["question"];
			}  
		}
	  foreach($Bqid as $bqid){
		$bsql_question="SELECT `question` FROM `lime_questions` WHERE `language`='zh-Hant-TW' AND `qid`='$bqid' ";
		  $bresult_question = mysql_query($bsql_question);
			while($b=mysql_fetch_assoc($bresult_question)){
			  $bqi[$bqid][]=$b["question"];
			}  
	  }
	  
	 foreach( $bqi as $i=>$b){
		
		 foreach( $bi[$i] as $aa=>$bv){
			 echo "<tr><td><a href=context.php?qid=".$i."&title=".$all_Btitle[$i][$aa].">".$bqi[$i][$aa].$bv."</td></tr>";
		 }
		
	 }
	  ?>
    
  </tbody>
</table>
<table width="430" class="table_style">
  <tbody>
    <tr>
      <td class="title">C部分</td>
    </tr>
    
     <?php 
	  //question
		for($ii=0;$ii<$count_Cqid;$ii++){
			$j=$ii+1;
			if($Cqid[$ii]!=$Cqid[$j]){
				$csql_question="SELECT `question` FROM `lime_questions` WHERE `language`='zh-Hant-TW' AND `qid`='$Cqid[$ii]' ";
 				$cresult_question = mysql_query($csql_question);
				$ccount_question=mysql_num_rows($cresult_question); 
			
				for($i=0;$i<$ccount_question;$i++){
					$carray_question[$i]=mysql_fetch_array($cresult_question); 
					preg_match_all('/[\x{4e00}-\x{9fff}]+/u',$carray_question[$i]['question'] , $matches);
					$carray_question[$i]['question'] = join('', $matches[0]);
					//echo $carray_question[$i]['question'];
					echo '<tr><td><a href=context.php?qid='.$Cqid[$ii].'&title='.$all_Ctitle[$ii].'>'.$carray_question[$i]['question'].'</a></td></tr>';
				}
			}
		}
	  
	  ?>
    
  </tbody>
</table>

<form>

</body>
</html>
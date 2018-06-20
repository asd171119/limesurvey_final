<!----Rhoda 2017/12/21 修改---->
<?php
include('connect.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>公有資料</title>
</head>

<body>
	 <?php 
		//answer
		$sql_answer="SELECT `qid`,`answer` FROM `lime_answers` WHERE `language`='zh-Hant-TW'";
 		$result_answer = mysql_query($sql_answer);
		$count_answer=mysql_num_rows($result_answer); 
	
     	while($as = mysql_fetch_assoc($result_answer)){
					
				$r_ans[$as['qid']][]=$as['answer'];//ans 的qid
		}

		//question
		$sql_question="SELECT `qid`,`type` FROM `lime_questions` WHERE `language`='zh-Hant-TW'";
 		$result_question = mysql_query($sql_question);
		$count_question=mysql_num_rows($result_question); 
		$ABC_M=array();
		$ABC_F=array();
     	for($i=0;$i<$count_question;$i++){ 
 			$array_question[$i]=mysql_fetch_array($result_question);
			if($array_question[$i]['type']=='M'){
				array_push($ABC_M,$array_question[$i]['qid']);
			}else{
				array_push($ABC_F,$array_question[$i]['qid']);
			}
 	 	};
		$count_M=count($ABC_M);
		$count_F=count($ABC_F);
		
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
		}
		//key分類ABC
		$q_m=array();
		$q_f=array();
		for($i=8;$i<$count_key;$i++){
			$abc=explode("X",$array_key[$i]);
			if($abc[1]!='12'){
				$second=explode("X",$array_key[$i]);
				$firstQid= mb_substr($second[2],0,3,"utf-8"); 
			
				for($ii=0;$ii<$count_M;$ii++){
					if($firstQid==$ABC_M[$ii]){
						array_push($q_m,$array_key[$i]);
					}
				}
				for($ii=0;$ii<$count_F;$ii++){
					if($firstQid==$ABC_F[$ii]){
						array_push($q_f,$array_key[$i]);
					}
				}
			}else{
				$text='12X12X';
				$ex=explode("X",$array_key[$i]);
				$d_Line[]= $text.$ex[2];
			}
			
		}
					//print_r(array_unique($tt));	
	 ?>


</body>
</html>
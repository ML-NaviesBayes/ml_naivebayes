<?php 

function Classifier($input)
{
	
    include('handle.php'); 


    $input_reg=reg($input); // cat ki tu dat biet
    $input_stopword=cut_stopword($input_reg); // cat stopword
    $input_strtolower=mb_strtolower($input_stopword); // chuyen ve chu thuong  
    $input_trim=trim($input_strtolower); // cat khoang trang dau cuoi
    $input_cutwords=(explode(" ",$input_trim));
    //print_r ($input_cutwords);
    
    //get value classifier
    //get_classifier();
     $search1 = 'classifier 1';
     $search2 = 'classifier 2';
     $search3 = 'classifier 3';
     $search4 = 'classifier 4';
     $search5 = 'classifier 5';

	
	 $lines = file('./dataset/classifier.txt');
	 //get value classifier_1
	$classifier_1='';
	foreach($lines as $line)
	  {
	  if(strpos($line, $search1) !== false) {
	      $liner=explode(': ',$line);
	      $classifier_1.= $liner[1];
	    }

	  }
	 //get value classifier_2
	  $classifier_2='';
	  foreach($lines as $line)
	  {
	  if(strpos($line, $search2) !== false) {
	      $liner=explode(': ',$line);
	      $classifier_2.= $liner[1];
	    }

	  }
	 //get value classifier_3
	  $classifier_3='';
	  foreach($lines as $line)
	  {
	  if(strpos($line, $search3) !== false) {
	      $liner=explode(': ',$line);
	      $classifier_3.= $liner[1];
	    }

	  }
	  //get value classifier_4
	  $classifier_4='';
	  foreach($lines as $line)
	  {
	  if(strpos($line, $search4) !== false) {
	      $liner=explode(': ',$line);
	      $classifier_4.= $liner[1];
	    }

	  }
	  //get value classifier_5
	  $classifier_5='';
	  foreach($lines as $line)
	  {
	  if(strpos($line, $search5) !== false) {
	      $liner=explode(': ',$line);
	      $classifier_5.= $liner[1];
	    }

	  }
	//tính tần suất của input.
	$read_keyword = file_get_contents("./dataset/keyword.txt"); //read the file
	$keywords = explode("\n", $read_keyword);	
    $temp_total_keywords=array();
    foreach($keywords as $keyword){
        $total_keyword=0; 
        foreach($input_cutwords as $input_cutword){
            if($keyword==$input_cutword){
                $total_keyword+=1;
            }
        }
        array_push($temp_total_keywords,$total_keyword);  
    }    
    //end tần suất của input.

    //get lamda
    
    $read_lamda1 = file_get_contents("./dataset/lamda1.txt"); //read the file
	$lamda1 = explode("\n", $read_lamda1);
	//read lamda2
    $read_lamda2 = file_get_contents("./dataset/lamda2.txt"); //read the file
	$lamda2 = explode("\n", $read_lamda2);
	//read lamda3
    $read_lamda3 = file_get_contents("./dataset/lamda3.txt"); //read the file
	$lamda3 = explode("\n", $read_lamda3);
	//read lamda4
    $read_lamda4 = file_get_contents("./dataset/lamda4.txt"); //read the file
	$lamda4 = explode("\n", $read_lamda4);
	//read lamda5
    $read_lamda5 = file_get_contents("./dataset/lamda5.txt"); //read the file
	$lamda5 = explode("\n", $read_lamda5);
	//get lamda
    //kq rate 1
    $tong1=1;
    for($i=0;$i<count($keywords) ;$i++){
        if($temp_total_keywords[$i]!=0){
            $tong1*=pow($lamda1[$i],$temp_total_keywords[$i]);   
        }
    }
    $result_1= $tong1*$classifier_1;
    //kq rate 1
    $tong2=1;
    for($i=1;$i<count($keywords) ;$i++){
        if($temp_total_keywords[$i]!=0){
            $tong2*=pow($lamda2[$i],$temp_total_keywords[$i]);   
        }
    }
    $result_2= $tong2*$classifier_2;
    //kq rate 1
    $tong3=1;
    for($i=1;$i<count($keywords) ;$i++){
        if($temp_total_keywords[$i]!=0){
            $tong3*=pow($lamda3[$i],$temp_total_keywords[$i]);   
        }
    }
    $result_3= $tong3*$classifier_3;
    //kq rate 1
    $tong4=1;
    for($i=1;$i<count($keywords) ;$i++){
        if($temp_total_keywords[$i]!=0){
            $tong4*=pow($lamda4[$i],$temp_total_keywords[$i]);   
        }
    }
    $result_4= $tong4*$classifier_4;
    //kq rate 1
    $tong5=1;
    for($i=1;$i<count($keywords) ;$i++){
        if($temp_total_keywords[$i]!=0){
            $tong5*=pow($lamda5[$i],$temp_total_keywords[$i]);   
        }
    }
    $result_5= $tong5*$classifier_5;

    echo "classifier_1: ".($result_1*pow(10,1))."\n";

    echo "classifier_2: ".($result_2*pow(10,1))."\n";

    echo "classifier_3: ".($result_3*pow(10,1))."\n";

    echo "classifier_4: ".($result_4*pow(10,1))."\n";

    echo "classifier_5: ".($result_5*pow(10,1))."\n";
 
    
    
    
}
?>


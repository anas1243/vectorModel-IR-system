<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	


	$error=$test=''; $hellyeah= array();
	
if(isset($_POST["generate"])) {

//generating the 1st file 	
$myfile1 = fopen("rand1.txt", "w") or die("Unable to open file!");
$txt = randstr( rand(4, 10) );
fwrite($myfile1, $txt);
fclose($myfile1);

//generating the 2nd file 	
$myfile2 = fopen("rand2.txt", "w") or die("Unable to open file!");
$txt = randstr( rand(4, 10) );
fwrite($myfile2, $txt);
fclose($myfile2);

//generating the 3rd file 	
$myfile3 = fopen("rand3.txt", "w") or die("Unable to open file!");
$txt = randstr( rand(4, 10) );
fwrite($myfile3, $txt);
fclose($myfile3);

//$test=randstr(5);

}else{
	//if search button is clicked 
$searchbox = test_input($_POST['x']);


if (empty($searchbox)) {
//if the search box is empty print error !
    $error = "please enter a keyword and prob. to search!";
  }
  else{
//check if the query is well formated or not 

  if(!preg_match("/([A-Ea-e] ?){1,}$/",$searchbox)){
//if not !
  $error = "wrong format for searching \n
	try this: <'letter':'prob';>  
  ";
  
  }
  else{
//if the query is well formated 
  	

	
	
  		//if the query is well formated 
  	echo $searchbox."\n";
  	$searchbox=preg_replace('/\s+/',"", $searchbox);
  	$query = stringToArray($searchbox);
  	
	//////////var_dump($query);
	$i=0;
	
  		
  		$Q = array('A'=>0,'B'=>0,'C'=>0,'D'=>0,'E'=>0);
  		$FQA = $FQB = $FQC = $FQD = $FQE  = 0;
	//calculate the weight of the query
	for($i=0;$i<sizeof($query);$i++) {
	switch($query[$i]) {

			case A : case a: $Q[A]++;$FQA =1; break;
			case B : case b: $Q[B]++;$FQB =1; break;
			case C : case c: $Q[C]++;$FQC =1; break;
			case D : case d: $Q[D]++;$FQD =1; break;
			case E : case e: $Q[E]++;$FQE =1; break;
				}
	
}
//it returns the  highest value
$Qmax =  max($Q);
//////////echo $Qmax ;
foreach($Q as $key => $value ){
$Q[$key]=$Q[$key]/$Qmax;
}
 ////print_r($Q);
 //echo $FQA.'  '.$FQB.'  '.$FQC.'  '.$FQD.'  '.$FQE; echo '<br><br>';
  		
  		//to know number of txt files in the IR directory to loop through them 
  		//and to make a associative array FILENAME => 0 at the beginning
  		 $counter = 0; $result=array();
  		 //it loops through all txt files in the directory
  		if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle)))
    {
        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt')
        {
        		$result = array_merge($result,array($file => 0) );
            $counter++;
        }
    }
    closedir($handle);
}


  		
  			///////print_r($result);
	//calculate the score of each file 	
	  		
	  		
  		 $i = 0; 
  		$A = array_pad($A,$counter,0);$B = array_pad($B,$counter,0);$C = array_pad($C,$counter,0);$D = array_pad($D,$counter,0);
  		$E = array_pad($E,$counter,0);$maxDocs = array_pad($maxDocs,$counter,0);
  		
		$WA = array_pad($WA,$counter+1,0);$WB = array_pad($WB,$counter+1,0);$WC = array_pad($WC,$counter+1,0);$WD = array_pad($WD,$counter+1,0);
  		$WE = array_pad($WE,$counter+1,0);
  		
  		$FA = array_pad($FA,$counter,0);$FB = array_pad($FB,$counter,0);$FC = array_pad($FC,$counter,0);$FD = array_pad($FD,$counter,0);$FE = array_pad($FE,$counter,0);
  		//now we need to loop through every txt file in the dir. the calculate
  		//prob. of each occurrence and the score of each file
  		if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle)))
    {
        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt')
        {
           
            
            $myfile = fopen("$file", "r") or die("Unable to open file!");

		$A[$i]=0 ; $B[$i]=0 ; $C[$i]=0 ;$D[$i]=0 ;$E[$i]=0 ; $maxDocs[$i]=0;
		$FA[$i]=0 ; $FB[$i]=0 ; $FC[$i]=0 ;$FD[$i]=0 ;$FE[$i]=0 ;
		
		while(!feof($myfile)) {
			
	
switch(fgetc($myfile)) {

			case A : case a: $A[$i]++;$FA[$i]=1; break;
			case B : case b: $B[$i]++;$FB[$i]=1; break;
			case C : case c: $C[$i]++;$FC[$i]=1; break;
			case D : case d: $D[$i]++;$FD[$i]=1; break;
			case E : case e: $E[$i]++;$FE[$i]=1; break;
				}
			}
			//echo $file;
			
			//echo $FA[$i].'  '.$FB[$i].'  '.$FC[$i].'  '.$FD[$i].'  '.$FE[$i]; echo '<br><br>';

fclose($myfile);
				$maxDocs[$i] = max($A[$i],$B[$i],$C[$i],$D[$i],$E[$i]);
				//echo $maxDocs[$i];
				
				//tf
				$A[$i] /=$maxDocs[$i]; $B[$i] /=$maxDocs[$i]; $C[$i] /=$maxDocs[$i]; $D[$i] /=$maxDocs[$i]; $E[$i] /=$maxDocs[$i];
				
			//echo $file;
			//echo $A[$i].'  '.$B[$i].'  '.$C[$i].'  '.$D[$i].'  '.$E[$i]; echo '<br><br>';
            $i++;
        }
    }
    closedir($handle);
}	

	$dfA = $dfB = $dfC = $dfD = $dfE =$idfA =$idfB =$idfC =$idfD =$idfE =0;
	 
	 for($i = 0;$i<$counter;$i++) {
	$dfA += $FA[$i] ;$dfB += $FB[$i] ;$dfC += $FC[$i] ;$dfD += $FD[$i] ;$dfE += $FE[$i] ;
}
	$dfA +=$FQA;$dfB +=$FQB;$dfC +=$FQC;$dfD +=$FQD;$dfE +=$FQE;

//////echo $dfA.'  '.$dfB.'  '.$dfC.'  '.$dfD.'  '.$dfE;

$idfA =log((($counter+1)/$dfA), 2);$idfB =log((($counter+1)/$dfB), 2);$idfC =log((($counter+1)/$dfC), 2);$idfD =log((($counter+1)/$dfD), 2);
$idfE =log((($counter+1)/$dfE), 2);

/////echo $idfA.'  '.$idfB.'  '.$idfC.'  '.$idfD.'  '.$idfE;

for($i = 0;$i<$counter;$i++) {
	$WA[$i] =$A[$i]*$idfA  ;$WB[$i] =$B[$i]*$idfB  ;$WC[$i] =$C[$i]*$idfC  ;$WD[$i] =$D[$i]*$idfD  ;$WE[$i] =$E[$i]*$idfE  ;
}
	 
		$WA[$counter]=$Q[A]*$idfA ;$WB[$counter]=$Q[B]*$idfB ;$WC[$counter]=$Q[C]*$idfC ;$WD[$counter]=$Q[D]*$idfD ;
		$WE[$counter]=$Q[E]*$idfE ;
	
	 //print_r($WA); echo '<br> ';print_r($WB); echo '<br> ';print_r($WC); echo '<br> ';print_r($WD); echo '<br> ';
	// print_r($WE); echo '<br> ';
	
	$i = 0;$cos1q = array($counter);
		if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle)))
    {
        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt')
        {
        	
		$cos1q[$i]=($WA[$i]*$WA[$counter]+$WB[$i]*$WB[$counter]+$WC[$i]*$WC[$counter]+$WD[$i]*$WD[$counter]+$WE[$i]*$WE[$counter])/sqrt((pow($WA[$i],2)+pow($WB[$i],2)+pow($WC[$i],2)+pow($WD[$i],2)+pow($WE[$i],2))*(pow($WA[$counter],2)+pow($WB[$counter],2)+pow($WC[$counter],2)+pow($WD[$counter],2)+pow($WE[$counter],2)));
		$result[$file] = $cos1q[$i] ; 
            $i++;
        }
    }
    closedir($handle);
}
		
		arsort($result);
  		print_r($result);
  		$thelist = '';
  		foreach($result as $key => $value) {
 		
 		$thelist .= '<li><a href="'.$key.'">'.$key.'</a></li>';   
	
}	$hellyeah = $thelist;
	//echo($hellyeah);
  
		}
		}
	
	}	
  
}




function test_input($data) {
  $data = trim($data);
 //$data = stripslashes($data);
  //$data = htmlspecialchars($data);
  return $data;
} 

//function to generate a random string 
function randstr($length = 10) {
    $characters = 'ABCDE';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



function stringToArray($s)
{
    $r = array();
    for($i=0; $i<strlen($s); $i++) 
         $r[$i] = $s[$i];
    return $r;
}














?>
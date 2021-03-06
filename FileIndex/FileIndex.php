<?php 

//Retrieving values from form
if(!isset($_POST['fileName']))die('Error: No Filename');

$fileName = isset($_POST['fileName']) ?$_POST['fileName'] : 'test.php';
//Open file
$myfile = fopen($fileName, "r") or die("Unable to open file!");
//Read the contents of file
$fileData =  fread($myfile,filesize("test.php"));
//Close File
fclose($myfile);

//Split the file data
$blobText = preg_split('/[^a-zA-Z0-9]/i', $fileData);

//call function to display top 10 words
echo uniqueWordsWithCount($blobText);

function uniqueWordsWithCount($blobText) {

	//initialize word array
    $wordArray = array();
	
   //loop through the blobText
    for ($i = 0; $i < count($blobText); $i++) {
       	if(count($wordArray) > 0){
			if(array_key_exists($blobText[$i],$wordArray)){
				$wordArray[$blobText[$i]] =  $wordArray[$blobText[$i]] + 1;
			}else{
				$wordArray[$blobText[$i]] = 1;
			}			
	   }else{
			$wordArray[$blobText[$i]] = 1;
	   }
	   
  }
  //Sorting word array based on highest count of word
	array_multisort($wordArray, SORT_DESC, $wordArray);
	
	//Displaying Top 10 Records 
	$i=0;
	foreach($wordArray as $key => $val){
		if($key != '' && $i<10){
			echo "Word   <b>". $key."</b> Count <b>". $val."</b><br>";
			$i++;
		}
    }  
}
?>

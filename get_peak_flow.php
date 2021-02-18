<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$site = $_GET['site'];


$string = @file_get_contents("https://streamstatsags.cr.usgs.gov/gagepages/html/".$site.".htm");

if(!$string) {
  header('HTTP/1.1 500 Internal Server Error');
  exit;
}  

$dom = new domDocument;

@$dom->loadHTML($string);
$dom->preserveWhiteSpace = false;
$tables = $dom->getElementsByTagName('table');



$rows = $tables->item(2)->getElementsByTagName('tr');

$tableData = array();

foreach ($rows as $row) {
	$cols = $row->getElementsByTagName('td');
  	if($cols[4]->nodeValue == 'Y'){
      $tableData[$cols[0]->nodeValue] = $cols[1]->nodeValue;
    }  
}


function extractData($tableData){

    $json = array();

    foreach($tableData as $key => $flow){

      	if($key == "Weighted_20_percent_AEP_flood"){
            $json['wtd5'] = $flow;
        }
      	if($key == "Weighted_10_percent_AEP_flood"){
            $json['wtd10'] = $flow;
        }
      	if($key == "Weighted_4_percent_AEP_flood"){
            $json['wtd25'] = $flow;
        }
      	if($key == "Weighted_2_percent_AEP_flood"){
            $json['wtd50'] = $flow;
        }
      	if($key == "Weighted_1_percent_AEP_flood"){
            $json['wtd100'] = $flow;
        }
      	if($key == "Weighted_0_5_percent_AEP_flood"){
            $json['wtd200'] = $flow;
        }
      	if($key == "Weighted_0_2_percent_AEP_flood"){
            $json['wtd500'] = $flow;
        }
      	if($key == "50_percent_AEP_flood"){
            $json['sta2'] = $flow;
        }
      	if($key == "20_percent_AEP_flood"){
            $json['sta5'] = $flow;
        }
      	if($key == "10_percent_AEP_flood"){
            $json['sta10'] = $flow;
        }
      	if($key == "4_percent_AEP_flood"){
            $json['sta25'] = $flow;
        }
      	if($key == "2_percent_AEP_flood"){
            $json['sta50'] = $flow;
        }
      	if($key == "1_percent_AEP_flood"){
            $json['sta100'] = $flow;
        }
      	if($key == "0_5_percent_AEP_flood"){
            $json['sta200'] = $flow;
        }
      	if($key == "0_2_percent_AEP_flood"){
            $json['sta500'] = $flow;
        }
      	if($key == "Urban_50_percent_AEP_flood"){
            $json['sta2'] = $flow;
        }
      	if($key == "Urban_20_percent_AEP_flood"){
            $json['sta5'] = $flow;
        }
      	if($key == "Urban_10_percent_AEP_flood"){
            $json['sta10'] = $flow;
        }
      	if($key == "Urban_4_percent_AEP_flood"){
            $json['sta25'] = $flow;
        }
      	if($key == "Urban_2_percent_AEP_flood"){
            $json['sta50'] = $flow;
        }
      	if($key == "Urban_1_percent_AEP_flood"){
            $json['sta100'] = $flow;
        }
      	if($key == "Urban_0_5_percent_AEP_flood"){
            $json['sta200'] = $flow;
        }
      	if($key == "Urban_0_2_percent_AEP_flood"){
            $json['sta500'] = $flow;
        }
     
    }
  	return $json;

}    

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
echo json_encode(extractData($tableData));


?>
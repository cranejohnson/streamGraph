<?php
//Simple script to get ahps data and avoid cross site request
$site = $_GET['site'];

$string = file_get_contents("https://streamstatsags.cr.usgs.gov/gagepages/html/".$site.".htm");

$json = array();

if(preg_match("/Weighted_5_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['wtd5'] = $output_array[1];
}
if(preg_match("/Weighted_10_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['wtd10'] = $output_array[1];
}
if(preg_match("/Weighted_25_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['wtd25'] = $output_array[1];
}
if(preg_match("/Weighted_50_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['wtd50'] = $output_array[1];
}
if(preg_match("/Weighted_100_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['wtd100'] = $output_array[1];
}
if(preg_match("/Weighted_200_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['wtd200'] = $output_array[1];
}
if(preg_match("/Weighted_500_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['wtd500'] = $output_array[1];
}

if(preg_match("/W5_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['sta5'] = $output_array[1];
}
if(preg_match("/10_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['sta10'] = $output_array[1];
}
if(preg_match("/W25_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['sta25'] = $output_array[1];
}
if(preg_match("/50_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['sta50'] = $output_array[1];
}
if(preg_match("/100_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['sta100'] = $output_array[1];
}
if(preg_match("/200_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['sta200'] = $output_array[1];
}
if(preg_match("/500_Year_Peak_Flood<\/td>\s*<td>(.*)<\/td>/U", $string, $output_array)){
    $json['sta500'] = $output_array[1];
}

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
echo json_encode($json);


?>
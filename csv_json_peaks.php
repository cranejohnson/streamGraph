<?php
ini_set("auto_detect_line_endings", true);
$result = array();

$file = fopen("USGS_PEAK_STATS_2016.csv","r");

while(! feof($file)){
    $data = explode(',',trim(fgets($file)));

    if(substr($data[0], 0, 1) == '#') continue;


    $result[$data[0]][2016]['2yr']['sta'] = $data[1];
    $result[$data[0]][2016]['2yr']['reg'] = $data[2];
    $result[$data[0]][2016]['2yr']['wtd'] = $data[3];
    $result[$data[0]][2016]['5yr']['sta'] = $data[4];
    $result[$data[0]][2016]['5yr']['reg'] = $data[5];
    $result[$data[0]][2016]['5yr']['wtd'] = $data[6];
    $result[$data[0]][2016]['10yr']['sta'] = $data[7];
    $result[$data[0]][2016]['10yr']['reg'] = $data[8];
    $result[$data[0]][2016]['10yr']['wtd'] = $data[9];
    $result[$data[0]][2016]['25yr']['sta'] = $data[10];
    $result[$data[0]][2016]['25yr']['reg'] = $data[11];
    $result[$data[0]][2016]['25yr']['wtd'] = $data[12];
    $result[$data[0]][2016]['50yr']['sta'] = $data[13];
    $result[$data[0]][2016]['50yr']['reg'] = $data[14];
    $result[$data[0]][2016]['50yr']['wtd'] = $data[15];
    $result[$data[0]][2016]['100yr']['sta'] = $data[16];
    $result[$data[0]][2016]['100yr']['reg'] = $data[17];
    $result[$data[0]][2016]['100yr']['wtd'] = $data[18];
    $result[$data[0]][2016]['200yr']['sta'] = $data[19];
    $result[$data[0]][2016]['200yr']['reg'] = $data[20];
    $result[$data[0]][2016]['200yr']['wtd'] = $data[21];
    $result[$data[0]][2016]['500yr']['sta'] = $data[22];
    $result[$data[0]][2016]['500yr']['reg'] = $data[23];
    $result[$data[0]][2016]['500yr']['wtd'] = $data[24];
    $result[$data[0]][2016]['station_skew_AEP']=$data[25];
    $result[$data[0]][2016]['skew_B']=$data[26];
    $result[$data[0]][2016]['mse_B']=$data[27];
}


fclose($file);

$file = fopen("USGS_PEAK_STATS_2003.csv","r");

while(! feof($file)){
    $data = explode(',',trim(fgets($file)));

    if(substr($data[0], 0, 1) == '#') continue;

    $result[$data[0]][2003]['footnotes'] = $data[1];
    $result[$data[0]][2003]['area'] = $data[5];
    $result[$data[0]][2003]['elevation'] = $data[6];
    $result[$data[0]][2003]['lakes'] = $data[7];
    $result[$data[0]][2003]['forest'] = $data[8];
    $result[$data[0]][2003]['annualPrecip'] = $data[9];
    $result[$data[0]][2003]['janTemp'] = $data[10];
    if($data[11]) $result[$data[0]][2003]['peaks'] = $data[11];
    if($data[12]) $result[$data[0]][2003]['skew'] = $data[12];

    $result[$data[0]][2003]['2yr'][$data[13]] = $data[14];
    $result[$data[0]][2003]['5yr'][$data[13]] = $data[15];
    $result[$data[0]][2003]['10yr'][$data[13]] = $data[16];
    $result[$data[0]][2003]['25yr'][$data[13]] = $data[17];
    $result[$data[0]][2003]['50yr'][$data[13]] = $data[18];
    $result[$data[0]][2003]['100yr'][$data[13]] = $data[19];
    $result[$data[0]][2003]['200yr'][$data[13]] = $data[20];
    $result[$data[0]][2003]['500yr'][$data[13]] = $data[21];

}

fclose($file);
print_r($result);
$json = json_encode($result,JSON_PRETTY_PRINT|JSON_NUMERIC_CHECK);
echo json_last_error_msg();
file_put_contents('Flood_Stats.json', $json);
echo $json;
?>
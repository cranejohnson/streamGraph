<?
#Simple script to use HADS lookup table and update JSON crosswalk table


$string = file_get_contents("crossWalk.json");
$json = json_decode($string, true);


$url = "http://www.nws.noaa.gov/oh/hads/USGS/ALL_USGS-HADS_SITES.txt";

$HADS = file_get_contents($url);

if(!$HADS) exit();

//Remove the first four lines of the file that are header information and place
// remaining lines into an array.
$siteInfo = array_slice(explode("\n", $HADS), 4);

$i = 0;

foreach($siteInfo as $site){
    $parts = explode("|",$site);
    if (count($parts) < 6) {
        echo "not enough parts<br>";
        continue;
    }
    if($parts[0] == 'SUPT2'){
        echo $parts[0]."-".$parts[1]."<br";
    }
    if(!isset($json[strtolower($parts[0])])){
        echo "New site: {$parts[0]}:{$parts[1]}<br>";
        $i++;
    }
    $json[strtolower($parts[0])] = trim($parts[1]);

}

echo "$i new sites added to file<br>";
file_put_contents("crossWalk.json",json_encode($json,JSON_PRETTY_PRINT));


?>



<?php
error_reporting(E_ERROR);

$file = json_decode(file_get_contents('file.json'), true);

$keys = range(1,12);
$m = array_combine($keys, $file);

for ($i = 0; $i < 35; ++$i){
$Events[$i] = array($m[1][$i]);
$Clock[] = array($m[8][$i]);
$Net[] = array($m[10][$i]); 

if (!(empty($Events[$i][0]))) {

    $parsedE[] = array($Events[$i][0]);

}
if (!(empty($Clock[$i][0]))) {

    $parsedC[] = array($Clock[$i][0]);

}
if (!(empty($Net[$i][0]))) {

    $parsedN[] = array($Net[$i][0]);

}


}

$findme    = '/';
foreach ($parsedN as $key => $sl){
    foreach ($sl as $k => $z){
    $pos1 = stripos($z, $findme);
    if ($pos1 !== false) {
    $p[] = explode(" ", $z);
    $where[] = $key;

    }

}
}


$bah = array_combine($where, $p);
$Wkeys = array_keys($where);

$end = count($parsedC);
for ($z = 0; $z < $end; ++$z){
$today = date('Y-m-d');
$convertTimes[$z] = date("Y-m-d G:i", strtotime($parsedC[$z][0]));

$parse[] = array('Event'=>$parsedE[$z][0], 'Time'=>date('Y-m-d G:i', strtotime($convertTimes[$z] . "+4 hours")), 'Slot'=>$parsedN[$z][0]);
    if (in_array($z, $where)){

    $parsedW[$z][0] = "[A]: " . $parsedE[$z][0];
    $parsedW[$z][1] = "[B]: " . $parsedE[$z][0];
    $fetchFirst = array_key_first($bah[$z]);
    $fetchSecond = array_key_last($bah[$z]) - 1;

    $parsedNC[] = array($parsedW[$z][0], $bah[$z][$fetchFirst], $parsedW[$z][1], $bah[$z][$fetchSecond], date('h:i:', strtotime($parsedC[$z][0] . "+4 hours")));

    unset($parsedE[$z]);
    unset($parsedN[$z]);
    unset($parsedC[$z]);
    unset($parse[$z]);

    }
    unset($parse[0]);



//$uh[] = '2022-10-29 ' . date('H:i', strtotime(strtoupper($parsedC[$z][0])));
//echo date("h:i", strtotime($uh[$z]))."\n";

}
/*
$setKeys = array_combine($where, $parsedNC);

$events = array_replace_recursive($parse, $setKeys);
*/
$parsedIT = array('all'=>array_values($parse), 'HD'=>$parsedNC);
print_r($parse);
//print_r($parsedC);

file_put_contents('/home/bb/xlsx/parsedXlsx.json', json_encode($parsedIT, true));

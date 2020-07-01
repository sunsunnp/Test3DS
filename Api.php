<?php
class Api 
{
    function getAPI(){
        $api_url = "https://s3-ap-southeast-1.amazonaws.com/ysetter/media/video-search.json";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        $result=json_decode($output);
        $n=0;
        for($i=0;$i<count($result->items);$i++){
            $checkvideoId = isset($result->items[$i]->id->videoId);
            if($checkvideoId == 1){
                $res[$n]=$result->items[$i]->id->videoId;
                $n++;
            }
        }
        return $res;
    }   
}
$obj = new Api;
$obj2 = $obj->getApi();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        for ($x = 0; $x < count($obj2); $x++) { 
            $txt = '<iframe width="420" height="315" src= \'https://www.youtube.com/embed/'.$obj2[$x].'\'></iframe>';               
            echo $txt;
        }
    ?>
</body>
</html>
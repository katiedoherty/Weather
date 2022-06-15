<?php

$ch=curl_init("https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/London,UK/2022-06-12/2022-06-12?key=JAXXMMFML3KES8H2JY9B73TGG");

//returns a string not json data

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

curl_close($ch);

//turns into an array with two elements, each element is a php object, their values and properties correspond to the attributes of the repositories
$data = json_decode($response, true);//true means with get objects with associated arrays

/*foreach($data as $repository){
    echo $repository['days']['temp'];
}*/
echo $data['days'][0]['temp'];
//var_dump($data);
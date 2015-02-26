<?php

include __dir__ . "/../RedBullApi.php";


//$api = new RedBullApi();

//var_dump($api->getEventNewsFeed("1242814038525"));

$rsp = file_get_contents("http://api.redbull.com/v2/stories/event/1331590801827/locales/ja_jp/sortby/startdate/sortorder/desc/pagination/1-10");

$data = json_decode($rsp, true);

foreach($data["stories"] as $story) 
{

    echo $story["title"] . PHP_EOL;

}
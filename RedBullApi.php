<?php

class RedBullApi 
{

    protected $baseUrl = "http://mobileapi.redbull.com/cs/Satellite";
    
    public function getEventNewsFeed($eventId, $locale = "en_INT", $start = 1, $stop = 3)
    {

        $params = array(
            "locale" => $locale,
            "eventid" => $eventId,
            "start" => $start,
            "stop" => $stop
        );

        $this->validateParameter($params, array("locale", "eventid", "start", "stop"));

        return $this->request("RedBull/AssetInterface/EventNewsList", $params);


    }

    protected function validateParameter($parameters, $requiredParameters)
    {

        $missingParameters = array();

        foreach($requiredParameters as $requiredParameter) 
        {

            if(!isset($parameters[$requiredParameter])) $missingParameters[] = $requiredParameter;

        }

        if($missingParameters) throw new Exception("RedBull API requires these parameters: " . implode(",", $missingParameters));

    }

    public function request($action, $parameters) 
    {


        $url = $this->baseUrl . "?pagename=" . $action . ($parameters ? "&" : "") . http_build_query($parameters);

        $this->log("Calling " . $url);
        $ch = curl_init($url);
        curl_setopt_array($ch, array(CURLOPT_RETURNTRANSFER => true));
        $rsp = curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($httpCode == 200) 
        {

            return $rsp;

        }
        else 
        {

            throw new Exception("Red Bull API returned invalid HTTP CODE " . $httpCode . " with response " . $rsp);

        }




    }

    protected function log($msg, $level = "info") 
    {

        echo $msg . PHP_EOL;

    }

}


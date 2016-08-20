<?php

    function brojKorisnikaJezika($jezik){
        return totalCount("https://api.github.com/search/users?q=language:".$jezik."&per_page=1");
    }

    function brojKorisnikaJezikaIzZemlje($jezik,$zemlja){
        return totalCount("https://api.github.com/search/users?q=language:".$jezik."+location:".$zemlja."&per_page=1");
    }

    function brojRepozitorijumaJezika($jezik){
        return totalCount('https://api.github.com/search/repositories?q=language:'.$jezik."&per_page=1");
    }

    function brojRepozitorijumaJezikaSaZvezdicama($jezik,$zvezdice){
        return totalCount('https://api.github.com/search/repositories?q=language:'.$jezik.'+stars:'.$zvezdice.'&per_page=1');
    }

    function brojBagovaJezika($jezik,$status){
        if($status){
            return totalCount("https://api.github.com/search/issues?q=language:".$jezik."+label:bug+state:".$status."&per_page=1");
        }else{
            return totalCount("https://api.github.com/search/issues?q=language:".$jezik."+label:bug&per_page=1");
        }
    }

    function najstarijiBagJezika($jezik){
        $url = "https://api.github.com/search/issues?q=language:".$jezik."+label:bug&sort=created&order=asc&per_page=1";
        $jsonOdgovor = getJSON($url);
        $datum =  date("d.m.Y", strtotime($jsonOdgovor->items[0]->created_at));
        $naslov =  $jsonOdgovor->items[0]->title;
        $sadrzaj = $jsonOdgovor->items[0]->body;
        return array('datum'=>$datum,'naslov'=>$naslov,'sadrzaj'=>$sadrzaj);

    }

    function najnovijiBagJezika($jezik){
    $url = "https://api.github.com/search/issues?q=language:".$jezik."+label:bug&sort=created&order=desc&per_page=1";
    $jsonOdgovor = getJSON($url);
    $datum =  date("d.m.Y", strtotime($jsonOdgovor->items[0]->created_at));
    $naslov =  $jsonOdgovor->items[0]->title;
    $sadrzaj = $jsonOdgovor->items[0]->body;
    return array('datum'=>$datum,'naslov'=>$naslov,'sadrzaj'=>$sadrzaj);

    }

    function totalCount($url){
        $jsonOdgovor = getJSON($url);
        $totalCount = nullify($jsonOdgovor,"total_count");
        return $totalCount==null ? 0 : $totalCount;
    }

    function getJSON($url){
        $token = "efd51fae2a9e420e4e3e26c1070c0a8fcfa3ee2a";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERPWD, "Slave93" . ":" . "Slavko.kom123");
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization', 'OAuth '.$token));
        curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $curl_odgovor = curl_exec($curl);
        $parsiran_json = json_decode ($curl_odgovor);
        return $parsiran_json;
    }

    function nullify($object, $key){
        if(!isset($object) || $object==null){
            return null;
        }
        if(property_exists($object, $key))
            return empty($object->$key) ? NULL : $object->$key;
        else
            return NULL;
    }



?>
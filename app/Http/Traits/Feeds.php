<?php

namespace App\Http\Traits;

Trait Feeds {

    protected $feeds = [];

    protected function getData()
    {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->get(env('FEED_SOURCE_URL'));
        } 
        catch(\Exception $e)
        {
            return json_encode(['error' => $e]);
        }
        return $response->getBody();
    }

    protected function getFeeds()
    {
        $data = json_decode($this->getData(), true);
        
        if(isset($data['error'])) return [];

        if(isset($data['feed']) && isset($data['feed']['entry']))
        {
            foreach($data['feed']['entry'] as $entry)
            {
                $this->proccessFeed($entry['content']['$t']);
            }
        }

        return $this->feeds;
    }

    private function proccessFeed($feed)
    {
        $data = explode(',', $feed);
        preg_match('/message: (.*?), sentiment/i', $feed, $msg);
        $this->feeds[str_replace('sentiment: ', '', trim($data[count($data) - 1]))][] = $msg[1] ?? '';
    }

    protected function getLocations($city)
    {
        $key = env('OPENCAGEDATA_KEY');
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->get("https://api.opencagedata.com/geocode/v1/json?q=$city&key=$key");
        }
        catch(\Exception $e)
        {
            return json_encode(['error' => $e]);
        }
        return $response->getBody();
    }
}
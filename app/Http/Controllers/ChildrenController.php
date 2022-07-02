<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChildrenController extends Controller
{
    private $uri = 'http://167.172.85.4:8080/api/';
    // private $uri = 'http://127.0.0.1:8000/api/';
    public function getData($endpoint)
    {
        $headers = [
            'Authorization' => 'Bearer ' . Session::get('user_token'),
            'Accept' => 'application/json',
        ];
        $client = new Client(['base_uri' => $this->uri]);
        $response = $client->get($endpoint,['headers' => $headers]);
        $result = json_decode($response->getBody()->getContents());
        return $result;

    }

    public function getChildrens($type,$id)
    {
        $data = $this->getData('children/all/'.$type.'/'.$id);
        return $data;
    }

    public function getStatusStunting($type,$id)
    {
        $data = $this->getData('status-stunting/all/'.$type.'/'.$id);
        return $data;
    }


}

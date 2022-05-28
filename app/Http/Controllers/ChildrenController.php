<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChildrenController extends Controller
{
    public function getData($endpoint)
    {
        $headers = [
            'Authorization' => 'Bearer ' . Session::get('user_token'),
            'Accept' => 'application/json',
        ];
        $client = new Client(['base_uri' => 'http://localhost:8080/api/']);
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

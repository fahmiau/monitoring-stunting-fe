<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function getData($endpoint)
    {
        $headers = [
            'Authorization' => 'Bearer ' . Session::get('user_token'),
            'Accept' => 'application/json',
        ];
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $response = $client->get($endpoint,['headers' => $headers]);
        $result = json_decode($response->getBody()->getContents());
        return $result;

    }

    public function viewReport()
    {
        $response = Http::get('http://localhost:8000/api/provinsi/all');
        $provinsis = json_decode($response,true);
        $data = $this->getData('children/all');
        return view('report.report')->with('provinsis',$provinsis)->with('data',$data);
    }

    public function viewChildrenDetail($id)
    {
        $data = $this->getData('data-children/by-child-id/'.$id);
        // dd($data->data[0]);
        return view('report.detailAnak')->with('data',$data->data[0]);
    }
}

<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
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

    public function viewReport()
    {
        $user_daerah = Session::get('user_daerah');
        $provinsi = $this->getData('provinsi/all');
        if (isset($user_daerah->provinsi_id)) {
            $kota_kabupaten = $this->getData('kota-kabupaten/by-provinsi/'.$user_daerah->provinsi_id);
            $kecamatan = $this->getData('kecamatan/by-kota-kabupaten/'.$user_daerah->kota_kabupaten_id);
            $kelurahan = $this->getData('kelurahan/by-kecamatan/'.$user_daerah->kecamatan_id);
            $data = $this->getData('children/all/kelurahan/'.$user_daerah->kelurahan_id);
        } else {
            $data = $this->getData('mother/has-children');
            $kota_kabupaten = null;
            $kecamatan = null;
            $kelurahan = null;
        }
        // dd($data);
        // foreach ($data as $mother) {
        //     foreach ($mother->childrens as $key => $children) {
        //         if (!$children->status_children) {
        //             dd($key.$children->nama);
        //         }
        //     }
        // }
        // dd($data[0]->childrens[0]->status_children->status_stunting);
        return view('report.report')
            ->with('provinsis',$provinsi)
            ->with('kota_kabupatens',$kota_kabupaten)
            ->with('kecamatans',$kecamatan)
            ->with('kelurahans',$kelurahan)
            ->with('data',$data)
            ->with('data_daerah',$user_daerah);
    }

    public function viewChildrenDetail($id)
    {
        $data = $this->getData('data-children/by-child-id/'.$id);
        // dd($data);
        return view('report.detailAnak')->with('children',$data->data);
    }
}

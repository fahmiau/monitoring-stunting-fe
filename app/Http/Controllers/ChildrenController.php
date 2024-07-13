<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChildrenController extends Controller
{
    // private $uri = 'http://167.172.85.4:8080/api/';
    // private $uri = 'http://127.0.0.1:8000/api/';
    private $uri;
    function __construct()
    {
        $this->uri = config('app.api_url');   
    }
    public function headers()
    {
        return [
            'Authorization' => 'Bearer ' . Session::get('user_token'),
            'Accept' => 'application/json'];
    }

    public function getData($endpoint)
    {
        $headers = [
            'Authorization' => 'Bearer ' . Session::get('user_token'),
            'Accept' => 'application/json',
        ];
        $client = new Client(['base_uri' => $this->uri]);
        try {
            $response = $client->get($endpoint,['headers' => $headers]);
            $result = json_decode($response->getBody()->getContents());
            return $result;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->getResponse()->getStatusCode() == 401) {
                return redirect()->route('login');
            }
            throw $e;
        }
        

    }

    public function postData($data,$endpoint)
    {
        $headers = $this->headers();
        $client = new Client(['base_uri' => $this->uri]);
        $response = $client->post($endpoint,['form_params' => $data, 'headers' => $headers]);
        return json_decode($response->getBody()->getContents());
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

    public function addChildren($mother_id)
    {
        $mother = $this->getData('mother/mother-id/'.$mother_id);
        $provinsi = $this->getData('provinsi/all');
        $kota_kabupaten = $this->getData('kota-kabupaten/by-provinsi/'.$mother->provinsi_id);
        $kecamatan = $this->getData('kecamatan/by-kota-kabupaten/'.$mother->kota_kabupaten_id);
        $kelurahan = $this->getData('kelurahan/by-kecamatan/'.$mother->kecamatan_id);
        return view('account.addChildren')
            ->with('provinsis',$provinsi)
            ->with('kota_kabupatens',$kota_kabupaten)
            ->with('kecamatans',$kecamatan)
            ->with('kelurahans',$kelurahan)
            ->with('mother',$mother);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'no_akta' => 'required|size:21',
            'anak_ke' => 'required|numeric|min:1',
            'nik' => 'required|size:16',
            'alamat' => 'required|max:255',
            'tempat_lahir' => 'required|max:15',
            'tanggal_lahir' => 'required|date',
        ]);
        $data = $this->postData($request->input(),'children/add');

        return redirect('/account/mother/'.$request->mother_id)->with('notification',[
            'type'=>'success',
            'message'=>'Data Anak Berhasil Ditambahkan'
        ]);
    }

    public function update(Request $request)
    {
        $data = $this->postData($request->input(),'children/update');

        return redirect('/children/detail/'.$request->id)->with('notification',[
            'type'=>'success',
            'message'=>'Data Anak Berhasil Diubah'
        ]);
    }

    public function addDataChildren(Request $request)
    {
        // return $request->input();
        $data = $this->postData($request->input(),'data-children/add');
        return $data;
    }

    public function updateDataChildren(Request $request)
    {
        $data = $this->postData($request->input(),'data-children/update');

        return $data;
    }

    public function deleteDataChildren($id)
    {
        $headers = $this->headers();
        $client = new Client(['base_uri' => $this->uri]);
        $response = $client->delete('data-children/delete/'.$id,['headers' => $headers]);
        $res =  json_decode($response->getBody()->getContents());
        if ($res->message == 'Data Berhasil Dihapus') {
            return 'success';
        } else{
            return 'failed';
        }
    }

    function destroy($id)
    {
        $headers = $this->headers();
        $client = new Client(['base_uri' => $this->uri]);
        $response = $client->delete('children/delete/'.$id,['headers' => $headers]);
        $res =  json_decode($response->getBody()->getContents());
        if ($res->message == 'Data Anak Berhasil Dihapus') {
            return 'success';
        } else{
            return 'failed';
        }
    }

    public function updateStatusStunting(Request $request)
    {
        $data = $this->postData($request->input(),'status-stunting/update');

        return $data;
    }
}

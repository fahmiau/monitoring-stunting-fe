<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $uri = 'http://167.172.85.4:8080/api/';
    // private $uri = 'http://127.0.0.1:8000/api/';
    public function headers()
    {
        return [
            'Authorization' => 'Bearer ' . Session::get('user_token'),
            'Accept' => 'application/json'];
    }

    public function getData($endpoint)
    {
        $headers = $this->headers();
        $client = new Client(['base_uri' => $this->uri]);
        $response = $client->get($endpoint,['headers' => $headers]);
        try {
            $result = json_decode($response->getBody()->getContents());
            // dd($result);
        } catch (\Exception $res) {
            // $result = $res;
            if ($res->message == 'Unauthenticated') {
                Session::flush();
                return view('login');
            }
        }
        return $result;
    }

    public function postData($data,$endpoint)
    {
        $headers = $this->headers();
        $client = new Client(['base_uri' => $this->uri]);
        $response = $client->post($endpoint,['form_params' => $data, 'headers' => $headers]);
        return json_decode($response->getBody()->getContents());
    }

    public function loginView()
    {
        if (Session::get('user_token')) {
            return redirect()->route('dashbord');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $headers = [
            'Accept' => 'application/json',
        ];
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $client = new Client(['base_uri' => $this->uri]);
        try {
            $response = $client->post('login',['form_params' => $data, 'headers' => $headers]);
            $result = json_decode($response->getBody()->getContents());
            // dd($result);
        } catch (\Exception $res) {
            // dd($res);
            if (strpos($res->getMessage(),'Email atau Password Tidak Sesuai') !== false) {
                return back()->withInput()->withErrors(['email' => 'Email atau Password Salah !!!']);
            }
        }
        $daerah = $this->getData('kelurahan/user/'.$result->user->id);
        Session::put('user_daerah',$daerah);
        Session::put('user_token',$result->token);
        Session::put('user_data',$result->user);
        Session::put('user_role',$result->role->category);

        return redirect()->route('dashboard');
    }

    public function dashboardView()
    {
        if (!Session::get('user_token')) {
            return redirect()->route('login');
        }
        $dashboard = $this->getData('dashboard');
        // dd($dashboard);
        return view('dashboard.dashboard')->with('data',$dashboard);
    }

    public function logout()
    {
        Session::flush();

        return redirect()->route('dashboard');
    }

    public function viewAccounts()
    {
        $data = $this->getData('mother/all');
        // dd($data);
        return view('account.listAccount')->with('mothers',$data);
    }

    public function addView()
    {
        return view('account.addNew');
    }

    public function addNew(Request $request)
    {
        try {
            $response = $this->postData($request->input(),'register');
            // dd($response);
        } catch (\Exception $res) {
            // dd($res);
        }
        return redirect()->route('viewAccount');
    }

    public function showAccount($mother_id)
    {
        $mother = $this->getData('mother/mother-id/'.$mother_id);
        $provinsi = $this->getData('provinsi/all');
        $kota_kabupaten = $this->getData('kota-kabupaten/by-provinsi/'.$mother->provinsi_id);
        $kecamatan = $this->getData('kecamatan/by-kota-kabupaten/'.$mother->kota_kabupaten_id);
        $kelurahan = $this->getData('kelurahan/by-kecamatan/'.$mother->kecamatan_id);
        return view('account.show')
            ->with('provinsis',$provinsi)
            ->with('kota_kabupatens',$kota_kabupaten)
            ->with('kecamatans',$kecamatan)
            ->with('kelurahans',$kelurahan)
            ->with('mother',$mother);
    }

    public function motherUpdate(Request $request)
    {
        try {
            $response = $this->postData($request->input(),'mother/update/'.$request->id);
            // dd($response);
        } catch (\Exception $res) {
            // dd($res);
        }
        // dd($response);
        return redirect('/account/mother/'.$request->id);
    }

    public function motherDelete($id)
    {
        $headers = $this->headers();
        $client = new Client(['base_uri' => $this->uri]);
        $response = $client->delete('mother/delete/'.$id,['headers' => $headers]);
        $res =  json_decode($response->getBody()->getContents());
        if ($res->message == 'Data Ibu Berhasil Dihapus') {
            return 'success';
        } else{
            return 'failed';
        }
    }
}

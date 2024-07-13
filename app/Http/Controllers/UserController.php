<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // private $uri = 'http://167.172.85.4:8080/api/';
    // private $uri = 'http://127.0.0.1:1000/api/';
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
        $headers = $this->headers();
        $client = new Client(['base_uri' => $this->uri]);
        try {
            $response = $client->get($endpoint,['headers' => $headers]);
            $result = json_decode($response->getBody()->getContents());
            // dd($result);
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
        Session::put('logged_in',1);
        Session::put('user_data',$result->user);
        Session::put('user_role',$result->role->category);
        Session::put('verified',$result->verified);

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
        $user_daerah = Session::get('user_daerah');
        $provinsi = $this->getData('provinsi/all');
        if (isset($user_daerah->provinsi_id)) {
            $kota_kabupaten = $this->getData('kota-kabupaten/by-provinsi/'.$user_daerah->provinsi_id);
            $kecamatan = $this->getData('kecamatan/by-kota-kabupaten/'.$user_daerah->kota_kabupaten_id);
            $kelurahan = $this->getData('kelurahan/by-kecamatan/'.$user_daerah->kecamatan_id);
            $data = $this->getData('mother/all/by-kelurahan/'.$user_daerah->kelurahan_id);
        } else {
            $data = $this->getData('mother/all');
            $kota_kabupaten = null;
            $kecamatan = null;
            $kelurahan = null;
        }
        return view('account.listAccount')
            ->with('mothers',$data)
            ->with('provinsis',$provinsi)
            ->with('kota_kabupatens',$kota_kabupaten)
            ->with('kecamatans',$kecamatan)
            ->with('kelurahans',$kelurahan)
            ->with('data',$data)
            ->with('data_daerah',$user_daerah);
    }

    public function addView()
    {
        $daerah = Session::get('user_daerah');
        $provinsi = $this->getData('provinsi/all');
        $kota_kabupaten = $this->getData('kota-kabupaten/by-provinsi/'.$daerah->provinsi_id);
        $kecamatan = $this->getData('kecamatan/by-kota-kabupaten/'.$daerah->kota_kabupaten_id);
        $kelurahan = $this->getData('kelurahan/by-kecamatan/'.$daerah->kecamatan_id);
        return view('account.addNew')
            ->with('data_daerah',$daerah)
            ->with('provinsis',$provinsi)
            ->with('kota_kabupatens',$kota_kabupaten)
            ->with('kecamatans',$kecamatan)
            ->with('kelurahans',$kelurahan);
    }

    public function addNew(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|size:16',
            'email' => 'required|email:dns',
            'password' => 'required|min:6|max:255|confirmed'
        ]);
        try {
            $response = $this->postData($request->input(),'register');
            // dd($response);
        } catch (\Exception $res) {
            // dd($res);
        }
        return redirect()->route('viewAccount')->with('notification',[
            'type'=>'success',
            'message'=>'Akun Berhasil Ditambahkan'
        ]);
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
        return redirect('/account/mother/'.$request->id)->with('notification',[
            'type'=>'success',
            'message'=>'Data Berhasil Diubah'
        ]);
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

    public function nakesAccounts()
    {
        $user_daerah = Session::get('user_daerah');
        $provinsi = $this->getData('provinsi/all');
        if (isset($user_daerah->provinsi_id)) {
            $kota_kabupaten = $this->getData('kota-kabupaten/by-provinsi/'.$user_daerah->provinsi_id);
            $kecamatan = $this->getData('kecamatan/by-kota-kabupaten/'.$user_daerah->kota_kabupaten_id);
            $kelurahan = $this->getData('kelurahan/by-kecamatan/'.$user_daerah->kecamatan_id);
            $data = $this->getData('nakes/all/by-kelurahan/'.$user_daerah->kelurahan_id);
        } else {
            $data = $this->getData('nakes/all');
            $kota_kabupaten = null;
            $kecamatan = null;
            $kelurahan = null;
        }
        return view('account.listNakes')
            ->with('nakes',$data)
            ->with('provinsis',$provinsi)
            ->with('kota_kabupatens',$kota_kabupaten)
            ->with('kecamatans',$kecamatan)
            ->with('kelurahans',$kelurahan)
            ->with('data',$data)
            ->with('data_daerah',$user_daerah);
    }

    public function kaderAccounts()
    {
        $user_daerah = Session::get('user_daerah');
        $provinsi = $this->getData('provinsi/all');
        if (isset($user_daerah->provinsi_id)) {
            $kota_kabupaten = $this->getData('kota-kabupaten/by-provinsi/'.$user_daerah->provinsi_id);
            $kecamatan = $this->getData('kecamatan/by-kota-kabupaten/'.$user_daerah->kota_kabupaten_id);
            $kelurahan = $this->getData('kelurahan/by-kecamatan/'.$user_daerah->kecamatan_id);
            $data = $this->getData('kader/all/by-kelurahan/'.$user_daerah->kelurahan_id);
        } else {
            $data = $this->getData('kader/all');
            $kota_kabupaten = null;
            $kecamatan = null;
            $kelurahan = null;
        }
        return view('account.listKader')
            ->with('kaders',$data)
            ->with('provinsis',$provinsi)
            ->with('kota_kabupatens',$kota_kabupaten)
            ->with('kecamatans',$kecamatan)
            ->with('kelurahans',$kelurahan)
            ->with('data',$data)
            ->with('data_daerah',$user_daerah);
    }

    public function getAccounts($type,$daerah,$daerah_id)
    {
        $data = $this->getData($type .'/all/by-'.$daerah.'/'.$daerah_id);
        return $data;
    }

    public function nakesDelete($id)
    {
        $headers = $this->headers();
        $client = new Client(['base_uri' => $this->uri]);
        $response = $client->delete('nakes/delete/'.$id,['headers' => $headers]);
        $res =  json_decode($response->getBody()->getContents());
        if ($res->message == 'Data Nakes Berhasil Dihapus') {
            return 'success';
        } else{
            return 'failed';
        }
    }

    public function kaderDelete($id)
    {
        $headers = $this->headers();
        $client = new Client(['base_uri' => $this->uri]);
        $response = $client->delete('kader/delete/'.$id,['headers' => $headers]);
        $res =  json_decode($response->getBody()->getContents());
        if ($res->message == 'Data Kader Berhasil Dihapus') {
            return 'success';
        } else{
            return 'failed';
        }
    }

    public function showNakes($nakes_id)
    {
        $nakes = $this->getData('nakes/nakes-id/'.$nakes_id);
        $provinsi = $this->getData('provinsi/all');
        $kota_kabupaten = $this->getData('kota-kabupaten/by-provinsi/'.$nakes->provinsi_id);
        $kecamatan = $this->getData('kecamatan/by-kota-kabupaten/'.$nakes->kota_kabupaten_id);
        $kelurahan = $this->getData('kelurahan/by-kecamatan/'.$nakes->kecamatan_id);
        return view('account.showNakes')
            ->with('provinsis',$provinsi)
            ->with('kota_kabupatens',$kota_kabupaten)
            ->with('kecamatans',$kecamatan)
            ->with('kelurahans',$kelurahan)
            ->with('nakes',$nakes);
    }

    public function showKader($kader_id)
    {
        $kader = $this->getData('kader/kader-id/'.$kader_id);
        $provinsi = $this->getData('provinsi/all');
        $kota_kabupaten = $this->getData('kota-kabupaten/by-provinsi/'.$kader->provinsi_id);
        $kecamatan = $this->getData('kecamatan/by-kota-kabupaten/'.$kader->kota_kabupaten_id);
        $kelurahan = $this->getData('kelurahan/by-kecamatan/'.$kader->kecamatan_id);
        return view('account.showKader')
            ->with('provinsis',$provinsi)
            ->with('kota_kabupatens',$kota_kabupaten)
            ->with('kecamatans',$kecamatan)
            ->with('kelurahans',$kelurahan)
            ->with('kader',$kader);
    }

    public function nakesUpdate(Request $request)
    {
        try {
            $response = $this->postData($request->input(),'nakes/update/'.$request->id);
            // dd($response);
        } catch (\Exception $res) {
            // dd($res);
        }
        return redirect('/account/nakes/'.$request->id)->with('notification',[
            'type'=>'success',
            'message'=>'Data Berhasil Diubah'
        ]);
    }

    public function kaderUpdate(Request $request)
    {
        try {
            $response = $this->postData($request->input(),'kader/update/'.$request->id);
            // dd($response);
        } catch (\Exception $res) {
            // dd($res);
        }
        // dd($response);
        return redirect('/account/nakes/'.$request->id)->with('notification',[
            'type'=>'success',
            'message'=>'Data Berhasil Diubah'
        ]);
    }
}

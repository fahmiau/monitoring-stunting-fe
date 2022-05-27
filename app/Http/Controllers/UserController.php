<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function headers()
    {
        return [
            'Authorization' => 'Bearer ' . Session::get('user_token'),
            'Accept' => 'application/json'];
    }

    public function getData($endpoint)
    {
        $headers = $this->headers();
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
        $response = $client->get($endpoint,['headers' => $headers]);
        $result = json_decode($response->getBody()->getContents());
        return $result;
    }

    public function postData($data,$endpoint)
    {
        $headers = $this->headers();
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
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
        $client = new Client(['base_uri' => 'http://localhost:8000/api/']);
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    private $url = 'http://167.172.85.4:8080/api/';
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
        $client = new Client(['base_uri' => $this->url]);
        $response = $client->get($endpoint,['headers' => $headers]);
        $result = json_decode($response->getBody()->getContents());
        return $result;
    }

    public function postData($data,$endpoint)
    {
        $headers = $this->headers();
        $client = new Client(['base_uri' => $this->url]);
        $response = $client->post($endpoint,['form_params' => $data, 'headers' => $headers]);
        return json_decode($response->getBody()->getContents());
    }

    public function index()
    {
        $articles = $this->getData('article/all');
        // dd($articles);
        return view('article.articleManager')->with('articles',$articles);
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $validated += [
            'published' => $request->published,
            'author' => $request->author
        ];
        // dd($validated);
        try {
            $data = $this->postData($validated,'article/store');
        } catch (\Exception $res) {
            dd($res->getMessage());
        }
        // dd($data->data->slug);
        return redirect()->route('articleEdit',['slug' => $data->data->slug]);
    }

    public function show($slug)
    {
        $data = $this->getData('article/admin/'.$slug);
        // dd($data);
        return view('article.edit')->with('article',$data);
    }

    public function uploadImage(Request $request)
    {
        $fileName=$request->file('file')->getClientOriginalName();
        $path=$request->file('file')->storeAs('article_images', $fileName, 'public');
        return response()->json(['location'=>"/storage/$path"]);
    }

    public function update($slug, Request $request)
    {
        // ddd($request->request);
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $validated += [
            'published' => $request->published,
            'author' => $request->author
        ];
        // dd($validated);
        try {
            $data = $this->postData($validated,'article/update/'.$slug);
        } catch (\Exception $res) {
            // dd($res->getMessage());
        }
        // dd($data);
        return redirect()->route('articleEdit',['slug' => $data->slug]);
    }

    public function articleShowPublished()
    {
        $articles = $this->getData('article/published');

        return view('article.index')->with('articles',$articles);
    }

    public function articleShow($slug)
    {
        $article = $this->getData('article/show/'.$slug);
        return view('article.show')->with('article',$article->data);
    }

    public function delete($slug)
    {
        $headers = $this->headers();
        $client = new Client(['base_uri' => $this->url]);
        $response = $client->delete('article/delete/'.$slug,['headers' => $headers]);
        $result =  $response->getBody()->getContents();
        return redirect('/article/list');
    }
}

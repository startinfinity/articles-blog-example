<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    private $token, $client, $apiUrl, $workspace, $boardId, $folderId;

    public function __construct()
    {
        $this->token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiZGJmOGMyMzllNDc0Nzg2Y2UyODgxMzRhZGZiZGY2MTE4YWFiNDRmOWY3Y2UwMzVjMWYzMjM1NGQ5ZjBiYTA4NmMyYmI1NTE1MDA0MTVhY2EiLCJpYXQiOjE2MTM2Njg1NTMsIm5iZiI6MTYxMzY2ODU1MywiZXhwIjoxNjQ1MjA0NTUzLCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.T5Yq6qmV4zIxdBE8W6wPbrun5pklx0wiFYZfqFDZUiPZ9SsP34j28n3b8bJsexP9a0iG6k8TOsD08NwCydO2r20R5bw_IXyEHPVG3EiDdMDV5QBrTXZda_6a3BdaDowya2sfx5wR-UpLMI79DflcORh9nWMQXiuW_96d9YiuXjBglpIfNp1QM_HEIJZ8Y_9PR8IlSmbWxDPefgKINGw-WAnbS8i5UBd2p5pwTx0zfvVh4JZDCyTndHOBxlaSrDQI77CkJ8_ZnrKOm31l755AXLTsXezavXBg_RZaOMJLmiQYMg9JPWxuVULEb0CzU6QQDlxSO1n_LydXp0gNk6FqwCkqUjV1yf6BITBWPGKk09wgh-Ep5wy80bhYyjRzDJXpSd3EhDs-GYchP66ciLiP-gAMdm7SZ4ko99uRmI6ldtiCSZ1zT0tW4Rgn9GvXCVf-us14IiPjgvaJWmnlyk4YcLp5TKxPeVaufh7Te9hCOMGyqkqSBcqdTGzX95mDkXBRMk-jymBXbvfGb9Mz-95KIJWyInpaIdeehb76pnIYDrssZXP1bmkIyP2e10UsuGoUu6qBFKQeogxpcOmcQ6T0sNqabn9BiJ7yEiEmPHYSADLmjNyP_Psv6gf5y9-gqo3JU5ekLRC_GrZ_rfzOzAAFy0mnmk9dLMQpUlnEUSNtP-M';
        $this->client = new \GuzzleHttp\Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token,
            ]
        ]);
        $this->apiUrl = 'https://app.startinfinity.com/api/v2';
        $this->workspace = 12197;
        $this->boardId = '3fBEDYYzoDN';
        $this->folderId = 'YUSyESH2MTc';

    }
    public function index(Request $request){

        $posts = $this->fetchArticles();

        return view('articles', compact('posts'));
    }

    public function singleArticle($slug){

        $post = collect($this->fetchArticles())->where('slug', $slug)->first();

        $post->comments = $this->getComments($post->id);
        if(!isset($post->likes)){
            $post->likes = 0;
        }
        $attributes = collect($this->getAttributes());
        // dd($post);

        return view('article',compact('post', 'attributes'));
    }

    public function postForm(){
        return view('article-form');
    }

    public function fetchArticles()
    {
        $response = $this->client->request('GET',
            $this->apiUrl."/workspaces/".$this->workspace."/boards/".$this->boardId."/items",
            [
                // 'headers' => $headers,
                'query' => [
                    // 'folder_id' => $folderId,
                    'expand' => ['values', 'values.attribute', 'created_by', 'folder'],
                ],
            ]
        );
        $item = json_decode($response->getBody());
        return $this->parseDataFromInfinity($item->data);
        // return ($item->data);
    }

    public function getComments($itemId){
        $response = $this->client->request('GET',
            $this->apiUrl."/workspaces/".$this->workspace."/boards/".$this->boardId."/items/".$itemId."/comments",
        );
        $item = json_decode($response->getBody());
        return $item->data;
    }

    public function getAttributes(){
        $response = $this->client->request('GET',
            $this->apiUrl."/workspaces/".$this->workspace."/boards/".$this->boardId."/attributes",
        );
        $item = json_decode($response->getBody());
        return $item->data;
    }

    public function parseDataFromInfinity($posts){
        foreach($posts as $post){
            foreach($post->values as $value){
                $attrName = $value->attribute->name;
                $post->$attrName = $value->data;
            }
        }
        return $posts;
    }

    public function postComment(Request $request){
        $this->client->request('POST',
            $this->apiUrl."/workspaces/".$this->workspace."/boards/".$this->boardId."/items/".$request->item_id.'/comments',
            [
                'query' => [
                    'text' => $request->text,
                ],
            ]
        );
        return redirect()->route('article', ['slug'=>$request->slug]);
    }

    public function updateAttribute($request, $values){
        $this->client->request('PUT',
            $this->apiUrl."/workspaces/".$this->workspace."/boards/".$this->boardId."/items/".$request->item_id,
            [
                'query' => [
                    'values' => $values
                ],
            ]
        );
    }

    public function postLike(Request $request){

        $post = collect($this->fetchArticles())->where('id', $request->item_id)->first();
        $likes = isset($post->likes)
            ? ($post->likes +1 )
            : 1;
        $this->updateAttribute($request, [[
            'attribute_id' => $request->attribute_id,
            'data' => $likes,
        ]]);

        return redirect()->route('article', ['slug'=>$request->slug]);
    }
}

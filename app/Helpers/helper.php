<?php

use App\Models\Website;
use GuzzleHttp\Client;

function post_generator($keyword, $type){
    $aiBaseUrl = 'https://api.openai.com/v1/';
    $aiApiKey = env('OPENAI_SECRET_KEY');
    $client = new Client([
        'base_uri' => $aiBaseUrl,
        'headers' => [
            'Authorization' => "Bearer $aiApiKey",
        ],
    ]);

    $response = $client->post('completions', [
        'json' => [
            'prompt' => 'give me a '.$type.' for this topic : '.$keyword,
            'model' => 'text-davinci-003',
            'max_tokens' => 200,
            'temperature' => 0.5
        ],
    ]);

    $result = json_decode((string) $response->getBody(), true);

    //return $result['choices'][0]['text'];
    //return make_paragraph(str_replace("\n", "", $result['choices'][0]['text']));
    return make_paragraph( $result['choices'][0]['text']);
}

function make_paragraph($text){
    return $text = '<!-- wp:paragraph -->'.$text.' <!-- /wp:paragraph -->';
}


function create_wp_post($keyword, $generatedText, $site_info){

    $baseUrl = 'https://'.$site_info->site_url.'/wp-json/wp/v2/';
    $username = $site_info->wordpress_username;
    $password = $site_info->wordpress_password;

    $client = new Client([
        'base_uri' => $baseUrl,
        'auth' => [$username, $password],
    ]);

    $response = $client->post('posts', [
        'json' => [
            'title' => $keyword,
            'content' => $generatedText,
            'status' => 'publish',
            'author'=>2,
            'categories' => 5,
        ],
    ]);

    return $response->getStatusCode();
}

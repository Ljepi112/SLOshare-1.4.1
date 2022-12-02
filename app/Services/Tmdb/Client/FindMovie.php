<?php

namespace App\Services\Tmdb\Client;

class FindMovie
{
    public \GuzzleHttp\Client $client;

    final public const API_BASE_URI = 'https://api.TheMovieDB.org/3';

    public $data;

    public function __construct($query, $year)
    {
        $this->client = new \GuzzleHttp\Client(
            [
                'base_uri'    => self::API_BASE_URI,
                'verify'      => false,
                'http_errors' => false,
                'headers'     => [
                    'Content-Type' => 'application/json',
                    'Accept'       => 'application/json',
                ],
                // 'query' => [
                //     'api_key' => config('api-keys.tmdb'),
                //     'query' => $query,
                // ],
            ]
        );

        $response = $this->client->request('get', 'https://api.themoviedb.org/3/search/movie?api_key='.\config('api-keys.tmdb').'&query='.$query.'&first_air_date_year='.$year);

        $this->data = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    public function getData()
    {
        return $this->data;
    }

    public function get_homepage()
    {
        return $this->data['homepage'];
    }
}

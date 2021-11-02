<?php

namespace App\Libraries\BienteShopApi;

use \GuzzleHttp\Client as GuzzleClient;

class BienteShopApi
{
    protected $apiUrl;
    protected $client;

    public function __construct()
    {
        $this->client = new GuzzleClient();
        $this->apiUrl = 'https://ecommerce.biente.shop/demo1/index.php?route=';
    }

    private function makeQuery($path = null, $method = 'GET', $data = null)
    {
        try {
            $res = $this->client->request($method, $this->apiUrl . $path, ['form_params' => $data]);
            if (!$res || $res->getStatusCode() !== 200) {
                return false;
            }

            return json_decode($res->getBody()->getContents());
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getProducts()
    {
        $res = $this->makeQuery('api/test/index');
        if (!$res) {
            return false;
        }

        return $res;
    }

    public function postProducts($data)
    {
        $res = $this->makeQuery('api/test/add', 'POST', $data);
        if (!$res) {
            return false;
        }

        return $res;
    }
}

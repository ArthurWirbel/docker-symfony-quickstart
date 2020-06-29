<?php 

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class PhoneCheck
{
    public function checkPhoneNumber($number, $country)
    {
        $client = HttpClient::create();
        
        $data = new \stdClass();
        $data->phoneNumber = $number;
        $data->countryCode = $country;

        $tab = array();

        $tab[0] = $data;

        $response = $client->request('POST', 'http://163.172.67.144:8042/api/v1/validate', [
            'auth_basic' => ['api', 'azpihviyazfb'],
            'json' => $tab
        ]);

        return $response->getContent();
    }
}
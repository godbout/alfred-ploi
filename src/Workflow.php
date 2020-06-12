<?php

namespace Godbout\Alfred\Ploi;

use Godbout\Alfred\Workflow\BaseWorkflow;
use GuzzleHttp\Client;

class Workflow extends BaseWorkflow
{
    public static function refreshOPcache()
    {
        $client = new Client([
            'base_uri' => 'https://ploi.io/api/',
            'headers' => [
                'Authorization' => 'Bearer ' . $_SERVER['API_KEY'],
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'User-Agent' => 'alfred-ploi'
            ]
        ]);

        try {
            $response = $client->post(
                'servers/' . $_SERVER['SERVER_ID'] . '/refresh-opcache'
            );

            if ($response->getStatusCode() !== 200) {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}

<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class FourPochApiService
{
    public function initiateWithdrawal()
    {
        // Initialize Guzzle client
        $client = new Client();

        // 4POCH API endpoint for withdrawal
        $withdrawalEndpoint = 'https://card.4poch.com/api/withdraw';

        // User credentials
        $email = 'user@example.com';
        $password = 'user_password';
        $amount = 1000; // Replace with the desired withdrawal amount

        // Headers for authentication
        $headers = [
            'X-Authorization' => 'SGf7JOQv7FBIJagc1wVYh288z5jdZp0XC6961gLMETsatFcELqIOC0FJcTNBrp5e',
            'X-Authorization-Secret' => 'AcPTX4Xai4CVNwcI0qCHx7CcOvdRnlrtzZGLj7f9Nmy2jbSj7e0da7D4anp6TiNd',
        ];

        // Request parameters
        $params = [
            'email' => $email,
            'password' => $password,
            'amount' => $amount,
        ];

        try {
            // Send POST request to initiate withdrawal
            $response = $client->post($withdrawalEndpoint, [
                'headers' => $headers,
                'form_params' => $params, // Change 'query' to 'form_params' for POST requests
            ]);

            // Decode and return the response
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Handle request exception
            if ($e->hasResponse()) {
                $errorResponse = json_decode($e->getResponse()->getBody(), true);
                return $errorResponse; // Return the error response
            } else {
                return ['error' => 'Request failed: ' . $e->getMessage()];
            }
        }
    }

    public function makeAutomaticDeposit()
    {
        // Initialize Guzzle client
        $client = new Client();

        // Your logic for making automatic deposits goes here
        // You can use Guzzle or any other method to communicate with the API

        try {
            // Example: Sending a GET request to the API
            $response = $client->get('https://card.4poch.com/api/make-automatic-deposit');
            
            // Process the response as needed
            $responseData = json_decode($response->getBody(), true);
            return $responseData;
        } catch (RequestException $e) {
            // Handle request exception
            if ($e->hasResponse()) {
                $errorResponse = json_decode($e->getResponse()->getBody(), true);
                return $errorResponse;
            } else {
                return ['error' => 'Request failed: ' . $e->getMessage()];
            }
        }
    }
}

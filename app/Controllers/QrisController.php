<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Config\Services;

class QrisController extends ResourceController
{
    use ResponseTrait;
    public function sendRequest()
    {
      $url = 'https://api.cronosengine.com/api/qris';
            $key = 'CE-FR15JPKY8XPGFDXY'; //ANTZEIN CRED
            $token = 'p47s4f3gve57Pn60XLSNjbCFLDKWqGRs';
                usleep(10);
                $codeSignature = hash_hmac('sha512', $key, $token);
                $data = json_encode([
                    'reference' => 'qrisstestCRONOS2-MPAY' . time(),
                    'amount' => 1000,
                    'expiryMinutes' => 30,
                    'viewName' => 'Antzyn',
                    'additionalInfo' => [
                        'callback' => 'https://kraken.free.beeceptor.com/notify',
                    ],
                ]);
                $codeSignature = hash_hmac('sha512', $key . $data, $token);
                $headers = [
                    "On-Key: $key",
                    "On-Token: $token",
                    "On-Signature: " . $codeSignature,
                    "Content-Type: application/json",
                ];

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

                $response = json_decode(curl_exec($ch));
                curl_close($ch);
                
                echo json_encode($response);

         
    }

    private function generateSignature($key, $body, $token)
    {
        return hash_hmac('sha512', $key . json_encode($body), $token);
    }
    public function generateQris()
    {
          
            // $url = 'https://api.cronosengine.com/api/qris';
            // $key = 'CE-FR15JPKY8XPGFDXY'; //ANTZEIN CRED
            // $token = 'p47s4f3gve57Pn60XLSNjbCFLDKWqGRs';
            //     usleep(10);
            //     $codeSignature = hash_hmac('sha512', $key, $token);
            //     $data = json_encode([
            //         'reference' => 'qrisstestCRONOS2-MPAY' . time(),
            //         'amount' => 1000,
            //         'expiryMinutes' => 30,
            //         'viewName' => 'Antzyn',
            //         'additionalInfo' => [
            //             'callback' => 'https://kraken.free.beeceptor.com/notify',
            //         ],
            //     ]);
            //     $codeSignature = hash_hmac('sha512', $key . $data, $token);
            //     $headers = [
            //         "On-Key: $key",
            //         "On-Token: $token",
            //         "On-Signature: " . $codeSignature,
            //         "Content-Type: application/json",
            //     ];

            //     $ch = curl_init($url);
            //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

            //     $response = json_decode(curl_exec($ch));
            //     curl_close($ch);
            //     echo json_encode($response);

    }

    // public function generateQris()
    // {
        
    //       $product = $_POST['product'];

    //         $response = array(
    //             'status' => 'success',
    //             'message' => 'Data berhasil dikirim!',
    //             'product' => "$product"
    //         );

    //     // Kirim response ke jQuery
    //     echo json_encode($response);
    // }
}

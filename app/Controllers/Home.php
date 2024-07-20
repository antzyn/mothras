<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('index');
    }
    public function generate()
    {
            $product = $_POST['product'];

            $response = array(
                'status' => 'success',
                'message' => 'Data berhasil dikirim!',
                'product' => "$product"
            );

        // Kirim response ke jQuery
        echo json_encode($response);
    }
}

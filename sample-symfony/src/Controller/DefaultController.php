<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    public function index()
    {
        $number = mt_rand(0, 100);
        // TODO: validate connection to database
        // TODO: populate elasticsearch index
        // TODO: load fixtures
        // TODO: launch tests

        return new Response(
            '<html><body>Random Number: '.$number.'</body></html>'
        );
    }
}
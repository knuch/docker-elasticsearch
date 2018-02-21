<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Elasticsearch\ClientBuilder;


class DefaultController
{
    public function index()
    {
        $number = mt_rand(0, 100);
        // TODO: validate connection to database
        $tables = $this->testDatabase();

        // TODO: Validate elasticsearch
        $client = ClientBuilder::create()
        ->setHosts(["elasticsearch"])
        ->build();
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id',
            'body' => ['testField' => 'abc']
        ];
        $response = $client->index($params);
        // TODO: load fixtures
        // TODO: launch tests
        // TODO: render nice frontend with container statuses

        return new Response(
            '<html><body>
             <h2>📟 Webserver up!</h2>
             <h2>🎶 Composer did its job!</h2>
            <h2>🐘 PHP up!</h2>
            <h2>💽 Mysql up!('.$tables["count"].' tables)</h2><h2>🔍 Elasticsearch up!</h2>
            </body></html>'
        );
    }

    private function testDatabase() {
        $dbname = 'test';
        $dbuser = 'root';
        $dbpass = 'root';
        $dbhost = 'mysql';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
        mysqli_select_db($connect, $dbname ) or die("Could not open the db '$dbname'");
        $test_query = "SHOW TABLES FROM $dbname";
        $result = mysqli_query($connect, $test_query);
        $tables_array = [];
        $tableCount = 0;
        while($tbl = mysqli_fetch_array($result)) {
            $tableCount++;
            array_push($tables_array, $tbl[0]);
        }
        return [
            'count' => $tableCount,
            'tables' => $tables_array
        ];
    }
}
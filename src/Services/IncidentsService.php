<?php
namespace Cgat\Services;

use Cgat\Core\Config;

class IncidentsService {
    private $config_incidents;

    public function __construct() {
        // get config data
        $this->config_incidents = Config::getConfig()->get('incidents'); // returns associative array
    }

    /**
     * Returns 'results'
     */
    public function getData() {

        $start = date_create("2015-01-01");
        $end = date_create();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->config_incidents['url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                "view":"detailed",
                "start":' . $start->getTimestamp() . ',
                "end":' . $end->getTimestamp() . '
            }',
            CURLOPT_HTTPHEADER => array(
                "api-key: " . $this->config_incidents['api-key'] . "",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // TODO return false
            echo "Error: " . $err;
        }
        
        $data = json_decode($response, true); // pass true as the argument in json_decode(), the data becomes an associative array instead of an object
        // JSON data structure:
        // 
        // "status":2,
        // "base":"incidents",
        // "results":[
        //      {
        //          "number":"CGA1001-10034",
        //          "incidentdate":1620296127,
        //          "project":"CGA Technology",
        //          "projectReference":"CGA1001",
        //          "type":"4 Day Accidents"
        //      }, ...]
   
        return $data['results'];
    }

}

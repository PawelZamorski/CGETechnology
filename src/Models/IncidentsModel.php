<?php

namespace Cgat\Models;

use Cgat\Domain\Incident;
use Cgat\Services\IncidentsService;

class IncidentsModel {

    public function getAll() {
        $incidents = array();
        $incidentsService = new IncidentsService();
        $data = $incidentsService->getData();

        foreach ($data as $value) {
            // format 'incidentdate' as date
            $incident = new Incident($value['number'], date('Y-m-d', $value['incidentdate']), $value['project'], $value['projectReference'], $value['type']);
            array_push($incidents, $incident);
        }

        // sort descending according to 'incidentdate'
        usort($incidents, array('Cgat\Domain\Incident', 'comparator'));
        return $incidents;
    }

    public function getMonthly() {
        $incidentsMonthly = array(
            "Jan" => array(),
            "Feb" => array(),
            "Mar" => array(),
            "Apr" => array(),
            "May" => array(),
            "Jun" => array(),
            "Jul" => array(),
            "Aug" => array(),
            "Sep" => array(),
            "Oct" => array(),
            "Nov" => array(),
            "Dec" => array()
        );

        $incidentsService = new IncidentsService();
        $data = $incidentsService->getData();

        foreach($data as $value) {
            $incident = new Incident($value['number'], date('Y-m-d', $value['incidentdate']), $value['project'], $value['projectReference'], $value['type']);

            switch (date('M', $value["incidentdate"])) {
                case "Jan":
                    array_push($incidentsMonthly["Jan"], $incident);
                    break;
                case "Feb":
                    array_push($incidentsMonthly["Feb"], $incident);
                    break;
                case "Mar":
                    array_push($incidentsMonthly["Mar"], $incident);
                    break;
                case "Apr":
                    array_push($incidentsMonthly["Apr"], $incident);
                    break;    
                case "May":
                    array_push($incidentsMonthly["May"], $incident);
                    break;    
                case "Jun":
                    array_push($incidentsMonthly["Jun"], $incident);
                    break;    
                case "Jul":
                    array_push($incidentsMonthly["Jul"], $incident);
                    break;
                case "Aug":
                    array_push($incidentsMonthly["Aug"], $incident);
                    break;    
                case "Sep":
                    array_push($incidentsMonthly["Sep"], $incident);
                    break;    
                case "Oct":
                    array_push($incidentsMonthly["Oct"], $incident);
                    break;    
                case "Nov":
                    array_push($incidentsMonthly["Nov"], $incident);
                    break;
                case "Dec":
                    array_push($incidentsMonthly["Dec"], $incident);
                    break;
                default:
                    echo "Parsing error: ";
            }

        }

        return $incidentsMonthly;
    }

}

<?php

namespace Cgat\Domain;

/* 
 * {
 * "number":"CGA1001-10034",
 * "incidentdate":1620296127,
 * "project":"CGA Technology",
 * "projectReference":"CGA1001",
 * "type":"4 Day Accidents"
*/
class Incident {
    private $number;
    private $incidentdate;
    private $project;
    private $projectReference;
    private $type;

    public function __construct($number, $incidentdate, $project, $projectReference, $type) {
        $this->number = $number;
        $this->incidentdate = $incidentdate;
        $this->project = $project;
        $this->projectReference = $projectReference;
        $this->type = $type;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getIncidentdate() {
        return $this->incidentdate;
    }

    public function getProject() {
        return $this->project;
    }

    public function getProjectReference() {
        return $this->projectReference;
    }

    public function getType() {
        return $this->type;
    }

    /* This is the static comparing function: sort descending on $incidentdate */
    public static function comparator($a, $b)
    {
        if ($a->getIncidentdate() == $b->getIncidentdate()) {
            return 0;
        }
        return ($a->getIncidentdate() < $b->getIncidentdate()) ? +1 : -1;
    }

}
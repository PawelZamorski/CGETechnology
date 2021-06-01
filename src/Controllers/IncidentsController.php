<?php

namespace Cgat\Controllers;

use Cgat\Models\MenuModel;
use Cgat\Exceptions\NotFoundException;
use Cgat\Models\IncidentsModel;

class IncidentsController extends AbstractController {

    public function getAll() {
        // instantiate array
        $properties = array();
        // get data
        $incidentsModel = new IncidentsModel();
        $incidents = $incidentsModel->getAll();
        // set up properties
        $properties = [
            'incidents' => $incidents,
            ];

        return $this->render('home.twig', $properties);
    }

    public function getMonthly() {
        // instantiate array
        $properties = array();
        // get data
        $incidentsModel = new IncidentsModel();
        $incidentsMonthly = $incidentsModel->getMonthly();
        // set up properties
        $properties = [
            'incidentsMonthly' => $incidentsMonthly,
            ];

        return $this->render('monthly.twig', $properties);
    }

    public function getAllToSort() {
        // instantiate array
        $properties = array();
        // get data
        $incidentsModel = new IncidentsModel();
        $incidents = $incidentsModel->getAll();
        // set up properties
        $properties = [
            'incidents' => $incidents
            ];

        return $this->render('sort-options.twig', $properties);
    }

}


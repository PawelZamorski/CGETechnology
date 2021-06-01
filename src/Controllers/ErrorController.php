<?php

namespace CGAT\Controllers;

use CGAT\Exceptions\NotFoundException;

class ErrorController extends AbstractController {
    public function notFound($lang) {
        // set up error message
        $errorMessage = 'We are sorry, but the page you are looking for does not exist.​';
        // instantiate array
        $properties = array();

        return $this->render('error.twig', $properties);
    }

}
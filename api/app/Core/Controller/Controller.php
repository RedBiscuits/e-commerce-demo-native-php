<?php

namespace App\Core\Controller;

use App\Core\Exceptions\ServerErrorException;

abstract class Controller
{
    /**
     * Render a view or show a server error page if the view file doesn't exist.
     *
     * @param string $view
     * @param array|null $data
     * @return void
     */
    protected function view(string $view, array $data = null)
    {
        if (file_exists(APP_ROOT . '/views/' . $view . '.view.php')) {
            require APP_ROOT . '/views/' . $view . '.view.php';
        } else {
            // If the view file doesn't exist, show a server error page
            $e = new ServerErrorException();
            $e->render();
        }
    }

    /**
     * Send a JSON response with the given data.
     *
     * @param array $data
     * @return void
     */
    protected function jsonResponse(array $data)
    {
        // Set the content type to JSON
        header('Content-Type: application/json');
        
        // Encode and output the data as JSON
        echo json_encode($data);
    }

    /**
     * Instantiate a model based on the given model name.
     *
     * @param string $modelName
     * @return object
     */
    protected function model(string $modelName)
    {
        // Create the fully qualified model class name
        $model = 'App\\Models\\' . $modelName;
        
        // Instantiate and return the model
        return new $model();
    }
}

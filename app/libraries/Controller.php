<?php
/*
     * Base Controller
     * Loads the models and views
     */

class Controller
{

    // Load Model
    public function model($model)
    {
        // Require model file
        require_once '../app/models/' . $model . '.php';

        // Instantiate model
        return new $model();
    }


    // Load View
    public function view($view, $data = [])
    {

        //$view = $view ?? '_'; // If the value passed is null set to a string with underscore (non-empty) to avoid deprecated error

        // Check for view file
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die('View does not exist');
        }
    }


    public function upload_image($image_name, $file, $path)
    {
        $info = new SplFileInfo($file[$image_name]['name']);
        $uniqueFilename = uniqid('', true) . '.' . $info->getExtension();
        $target_file = UPLOADROOT . $path . $uniqueFilename;
        // Move the uploaded file
        if (move_uploaded_file($file[$image_name]['tmp_name'], $target_file)) {
            //allow only 100 mega bytes
            if ($file[$image_name]["size"] > 1000000) {
                unlink($target_file); // Delete the uploaded file if it exceeds the file size limit
                return false;
            }
            // Check file type
            $FileType = strtolower($info->getExtension());
            if (!in_array($FileType, ["jpg", "jpeg", "png"])) {
                unlink($target_file); // Delete the uploaded file if it has an invalid file type
                return false;
            }
            return $path . $uniqueFilename; // All checks passed, return the unique filename
        } else {
            return false; // Error uploading file
        }
    }

    public function upload_pdf($pdf_name, $file, $path)
    {
        $info = new SplFileInfo($file[$pdf_name]['name']);
        $uniqueFilename = uniqid('', true) . '.' . $info->getExtension();
        $target_file = UPLOADROOT . $path . $uniqueFilename;
        // Move the uploaded file
        if (move_uploaded_file($file[$pdf_name]['tmp_name'], $target_file)) {
            //allow only 100 mega bytes
            if ($file[$pdf_name]["size"] > 1000000) {
                unlink($target_file); // Delete the uploaded file if it exceeds the file size limit
                return false;
            }
            // Check file type
            $FileType = strtolower($info->getExtension());
            if (!in_array($FileType, ["pdf"])) {
                unlink($target_file); // Delete the uploaded file if it has an invalid file type
                return false;
            }
            return $path . $uniqueFilename; // All checks passed, return the unique filename
        } else {
            return false; // Error uploading file
        }
    }
}

<?php
require_once 'controllers/baseController.php';
require_once 'models/seriesModel.php';
class SeriesController extends BaseController
{
    public SeriesModel $series;
    public array $seriesList;
    // Validation regex for form fields
    private array $regex = [
        'name' => '/^([A-Za-z0-9]+[\-\_ :]*)+$/',
        'short_name' => '/^[A-Za-z0-9\-\ ]{1,5}$/',
        'start_year' => '/^[0-9]{4}$/',
        'end_year' => '/^[0-9]{4}$/',
        'description' => '/^[^<>]*$/'
    ];
    /**
     * Controller method to create a new series
     * @return void
     */
    public function create(): void
    {
        if (count($_POST) > 0) {

            $series = new SeriesModel();

            if (!empty($_POST['name'])) {
                if (preg_match($this->regex['name'], $_POST['name'])) {
                    if (strlen($_POST['name']) >= 2 && strlen($_POST['name']) <= 255) {
                        try {
                            $series->name = trim($_POST['name']);
                            if ($series->checkIfExists('name', $_POST['name'])) {
                                $this->errors['name'] = SERIES_ERROR_NAME_EXISTS;
                            }
                        } catch (Exception $e) {
                            $this->errors['form'] = SERIES_ERROR_CREATION;
                        }

                    } else {
                        $errors['name'] = SERIES_ERROR_NAME_LENGTH;
                    }
                } else {
                    $this->errors['name'] = SERIES_ERROR_NAME_INVALID;
                }
            } else {
                $errors['name'] = SERIES_ERROR_NAME_EMPTY;
            }

            if (!empty($_POST['short_name'])) {
                if (preg_match($this->regex['short_name'], $_POST['short_name'])) {
                    if (strlen($_POST['short_name']) >= 2 && strlen($_POST['short_name']) <= 10) {
                        try {
                            $series->short_name = trim($_POST['short_name']);
                            if ($series->checkIfExists('short_name', $_POST['short_name'])) {
                                $this->errors['short_name'] = SERIES_ERROR_SHORT_NAME_EXISTS;
                            }
                        } catch (Exception $e) {
                            $this->errors['form'] = SERIES_ERROR_CREATION;
                        }
                    } else {
                        $this->errors['short_name'] = SERIES_ERROR_SHORT_NAME_LENGTH;
                    }
                } else {
                    $this->errors['short_name'] = SERIES_ERROR_SHORT_NAME_INVALID;
                }
            } else {
                $this->errors['short_name'] = SERIES_ERROR_SHORT_NAME_EMPTY;
            }

            if (!empty($_POST['start_year'])) {
                if (preg_match($this->regex['start_year'], $_POST['start_year'])) {
                    $series->start_year = (int) $_POST['start_year'];
                } else {
                    $this->errors['start_year'] = SERIES_ERROR_START_YEAR_INVALID;
                }
            } else {
                $this->errors['start_year'] = SERIES_ERROR_START_YEAR_EMPTY;
            }

            if (!empty($_POST['end_year'])) {
                if (preg_match($this->regex['end_year'], $_POST['end_year'])) {
                    $series->end_year = (int) $_POST['end_year'];
                } else {
                    $this->errors['end_year'] = SERIES_ERROR_END_YEAR_INVALID;
                }
            }

            if ($_FILES['img']['error'] === 0) {
                if (!isset($this->errors['short_name'])) {
                    $_SESSION['img'] = $_FILES['img'];

                    $authorizedExtensions = ['jpg' => 'image/jpg', 'jpeg' => 'image/jpeg', 'gif' => 'image/gif', 'png' => 'image/png'];
                    $extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                    $type = mime_content_type($_FILES['img']['tmp_name']);

                    if (!array_key_exists($extension, $authorizedExtensions) || $type != $authorizedExtensions[$extension]) {
                        $this->errors['img'] = SERIES_ERROR_IMG_TYPE;
                    } else {
                        $uploadDir = 'public/series_img/';
                        $fileName = uniqid(strtolower($series->short_name) . '_') . '.' . $extension;

                        while (file_exists('/assets/img/blog/posts/' . $fileName)) {
                            $fileName = uniqid() . '.' . $extension;
                        }
                        $uploadFile = $uploadDir . $fileName;
                        if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                            // Assuming you have a field in your series table to store the image path
                            $series->img = '/series_img/' . $fileName;
                            chmod($uploadFile, 0777); // Set proper permissions for the uploaded file
                        } else {
                            $this->errors['img'] = SERIES_ERROR_IMG;
                        }
                    }
                }

            } else if ($_FILES['img']['error'] === 1 || $_FILES['img']['error'] === 2) {
                $this->errors['img'] = SERIES_ERROR_IMG_SIZE;
            } else if ($_FILES['img']['error'] !== 4) { // 4 means no file was uploaded, which is not an error in this case
                $this->errors['img'] = SERIES_ERROR_IMG_EMPTY;
            } else {
                $this->errors['img'] = SERIES_ERROR_IMG;
            }

            if (!empty($_POST['description'])) {
                if (preg_match($this->regex['description'], $_POST['description'])) {
                    $series->description = trim($_POST['description']);
                } else {
                    $this->errors['description'] = SERIES_ERROR_DESCRIPTION_INVALID;
                }
            } else {
                $this->errors['description'] = SERIES_ERROR_DESCRIPTION_EMPTY;
            }

            if (count($this->errors) === 0) {
                try {
                    $series->create();
                    $this->formSuccess = 'La série <b><a href="/series/' . htmlspecialchars(strtolower($series->short_name)) . '">' . htmlspecialchars($series->name) . '</a></b> a été créée avec succès';
                } catch (Exception $e) {
                    unlink($uploadFile); // Remove the uploaded file if there was an error during series creation
                    $this->errors['form'] = SERIES_ERROR_CREATION;
                }
            } else {
                if (isset($uploadFile) && file_exists($uploadFile)) {
                    unlink($uploadFile); // Remove the uploaded file if there was an error during series creation
                }
            }
        }

        $this->display('series/create');
    }

    public function details($args = []): void
    {
        $this->series = new SeriesModel();
        if (!empty($args) && $args[0] !== '') {
            try {
                if (!$this->series->getByShortName($args[0])) {
                    $this->errors['page'] = SERIES_ERROR_NOT_FOUND;
                }
            } catch (Exception $e) {
                $this->errors['page'] = SERIES_ERROR_CANT_GET;
            }

            $this->display('series/details');
        } else {
            header('Location: /creer-serie');
            exit();
        }
    }

    /**
     * Controller method to update an existing series
     * @return void
     */
    public function update($args = []): void
    {
        if (!empty($args) && $args[0] !== '') {
            $series = new SeriesModel();
            try {
                if (!$this->series->getByShortName($args[0])) {
                    $this->errors['form'] = SERIES_ERROR_NOT_FOUND;
                }
            } catch (Exception $e) {
                $this->errors['form'] = SERIES_ERROR_CANT_GET;
            }

            $this->display('series/create');
        } else {
            header('Location: /creer-serie');
            exit();
        }
        // Similar validation and update logic as create()
        // You would need to fetch the existing series by ID, validate the input, and then update the series in the database
        // This is a placeholder for the update logic
    }

    public function list(): void
    {
        // This method would contain logic to fetch and display a list of all series
        // You would typically fetch all series from the database and pass them to a view for rendering
        $this->series = new SeriesModel();
        try {
            $this->seriesList = $this->series->getList();
        } catch (Exception $e) {
            $this->errors['form'] = SERIES_ERROR_CANT_GET;
        }
        $this->display('series/list');
    }
}
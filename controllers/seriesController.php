<?php
require_once 'controllers/baseController.php';
require_once 'models/seriesModel.php';
class SeriesController extends BaseController
{
    public function create(): void
    {
        $this->display('series/create');
        if (!empty($_POST)) {
            $series = new SeriesModel();
            $series->name = 'Stargate SG-1';
            $series->short_name = 'SG1';
            $series->start_year = 1997;
            $series->end_year = 2007;
            $series->description = 'test';
            $test = $series->create();
        }

    }
}
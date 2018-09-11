<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Laravel\LavachartsFacade;
use Khill\Lavacharts\Lavacharts;

class ChartsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function chart()
    {

        $finances = LavachartsFacade::DataTable();

        $finances->addStringColumn('grades')
            ->addNumberColumn('grades')
            ->setDateTimeFormat('Y')
            ->addRow(['pass', 50])
            ->addRow(['fail', 30])
            ->addRow(['good', 30])
            ->addRow(['very good', 10])
            ->addRow(['Excellent', 2]);

        $lava = LavachartsFacade::ColumnChart('Finances', $finances, [
            'title' => 'Grades  Performance',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14,

            ],
            'width'     => 500,
        ]);
        return view('home', ['lava' => $lava]);
    }

//    public function chart()
//    {
//        $chart = new SampleChart();
//        $chart->dataset('pie', 'line', [0, 65, 84, 45, 90]);
//        return view('home', ['chart' => $chart]);
//    }
}
<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function index()
    {
        $numtot = invoices::count();
        $total = invoices::sum('Total');
        $total = number_format($total, 2, '.', ',');

        //الفواتير غير المدفوعة
        $numunp = invoices::where('Value_Status', 2)->count();
        $unp = invoices::where('Value_Status', 2)->sum('Total');
        $unp = number_format($unp, 2, '.', ',');
        $nsba2 = round($numunp / $numtot, 2) * 100;


        // الفواتير المدفوعة
        $nump = invoices::where('Value_Status', 1)->count();
        $p = invoices::where('Value_Status', 1)->sum('Total');
        $p = number_format($p, 2, '.', ',');
        $nsba1 = round($nump / $numtot, 2) * 100;


        // الفواتير غير المدفوعة
        $numpp = invoices::where('Value_Status', 3)->count();
        $pp = invoices::where('Value_Status', 3)->sum('Total');
        $pp = number_format($pp, 2, '.', ',');
        $nsba3 = round($nump / $numtot, 2) * 100;






        // ExampleController.php
        
                $chartjs1 = app()->chartjs
                    ->name('barChartTest')
                    ->type('bar')
                    ->size(['width' => 350, 'height' => 200])
                   
                //  ->labels(['إجمالي الفواتير', 'الفواتير المدفوعة','الفواتير غير المدفوعة','الفواتير المدفوعة جزئيا'])
                 ->labels([ 'النسبة المئوية ل','الفواتير المدفوعة','الفواتير غير المدفوعة','الفواتير المدفوعة جزئيا'])
                    
                 ->datasets([
                        [
                            "label" => "",
                            'backgroundColor' => ['#FFFFFF'],
                            'data' => [0]
                        ],
                        [
                            "label" => "الفواتير المدفوعة",
                            'backgroundColor' => ['#45FFCA'],
                            'data' => [$nsba1]
                        ],
                        [
                            "label" => "الفواتير غير المدفوعة",
                            'backgroundColor' => ['#FF6969'],
                            'data' => [$nsba2]
                        ],
                        [
                            "label" => " الفواتير المدفوعة جزئيا",
                            'backgroundColor' => ['#FFBA86'],
                            'data' => [$nsba3]
                        ],
                    ])
                    ->options([]);
        



        $chartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 350, 'height' => 300])
            ->labels([ 'الفواتير المدفوعة','الفواتير غير المدفوعة','الفواتير المدفوعة جزئيا'])

            // ->labels(['Label x', 'Label y'])
            ->datasets([
                [
                    'backgroundColor' => ['#45FFCA', '#FF6969','#FFBA86'],
                    'hoverBackgroundColor' => ['#45FFCA', '#FF6969','#FFBA86'],
                    'data' => [$nsba1,$nsba2,$nsba3],
                
                ],
                
            ])
            ->options([]);











        return view('dashboard', compact(
            'numtot',
            'total',
            'numunp',
            'unp',
            'nsba2',
            'nump',
            'p',
            'nsba1',
            'numpp',
            'numpp',
            'pp',
            'nsba3',
            'chartjs',
            'chartjs1'
            
        ));
    }
}

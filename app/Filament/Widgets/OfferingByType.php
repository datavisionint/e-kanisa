<?php

namespace App\Filament\Widgets;

use App\Models\Offering;
use EightyNine\FilamentAdvancedWidget\AdvancedChartWidget;
use Illuminate\Support\Facades\DB;

class OfferingByType extends AdvancedChartWidget
{
    protected static ?string $heading = 'Offerings by type';                       // The heading of the chart
    protected static string $color = 'info';                            // The color of the chart
    protected static ?string $icon = 'heroicon-o-chart-pie';            // The icon to display on the chart
    protected static ?string $iconColor = 'info';                       // The color of the icon
    protected static ?string $iconBackgroundColor = 'info';


    protected function getData(): array
    {
        $data = Offering::query()
            ->groupBy("offering_type_id")
            ->join("offering_types", "offering_types.id", "=", "offerings.offering_type_id")
            ->select(
                DB::raw("sum(amount) as total"),
                DB::raw("max(offering_types.name) as type")
            )
            ->get();

        return [
            "labels" => $data->pluck("type"),
            "datasets" => [
                [
                    "label" => 'My First Dataset',
                    "data" => $data->pluck("total"),                    
                    "backgroundColor" => [
                        'rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 'rgb(255, 159, 64)', 'rgb(255, 223, 186)', 'rgb(39, 174, 96)', 'rgb(241, 196, 15)', 'rgb(230, 126, 34)', 'rgb(231, 76, 60)', 'rgb(142, 68, 173)', 'rgb(243, 156, 18)', 'rgb(211, 84, 0)', 'rgb(41, 128, 185)', 'rgb(127, 140, 141)', 'rgb(52, 152, 219)', 'rgb(26, 188, 156)', 'rgb(149, 165, 166)', 'rgb(46, 204, 113)', 'rgb(236, 240, 241)', 'rgb(52, 73, 94)', 'rgb(155, 89, 182)', 'rgb(108, 92, 231)', 'rgb(255, 87, 51)', 'rgb(199, 0, 57)', 'rgb(255, 195, 0)', 'rgb(133, 193, 233)', 'rgb(212, 172, 13)', 'rgb(244, 208, 63)'
                    ],
                ]
            ]
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}

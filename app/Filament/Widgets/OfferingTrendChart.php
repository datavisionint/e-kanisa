<?php

namespace App\Filament\Widgets;

use App\Models\Offering;
use EightyNine\FilamentAdvancedWidget\AdvancedChartWidget;
use Flowframe\Trend\Trend;

class OfferingTrendChart extends AdvancedChartWidget
{

    protected static ?string $heading = 'Monthly offerings trend';                       // The heading of the chart
    protected static string $color = 'info';                            // The color of the chart
    protected static ?string $icon = 'heroicon-o-chart-bar';            // The icon to display on the chart
    protected static ?string $iconColor = 'info';                       // The color of the icon
    protected static ?string $iconBackgroundColor = 'info'; 


    protected function getData(): array
    {

        $trend = Trend::model(Offering::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum("amount");

        return [ 
            'datasets' => [
                [
                    'label' => 'Total offerings',
                    'data' => $trend->pluck("aggregate"),
                ],
            ],
            'labels' => $trend->pluck("date"),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

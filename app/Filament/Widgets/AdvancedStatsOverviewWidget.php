<?php

namespace App\Filament\Widgets;

use App\Models\ChurchMember;
use App\Models\Envelope;
use App\Models\Member;
use App\Models\Offering;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget as BaseWidget;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Stat as AdvancedStatsOverviewWidgetStat;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class AdvancedStatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // dd(Envelope::query()->get());
        $numberOfMembers = Number::abbreviate(ChurchMember::query()->count());
        $totalPledges =  Number::abbreviate(Envelope::query()->sum("amount"));
        $totalOfferings =  Number::abbreviate(Offering::query()->sum("amount"));
        return [
            AdvancedStatsOverviewWidgetStat::make('Total Members', $numberOfMembers)->icon('heroicon-o-user-group')
                ->iconColor("success")
                ->iconBackgroundColor("success")
                ->description("Number of church members")
                ->descriptionColor("success")
                ->color("success"),
            AdvancedStatsOverviewWidgetStat::make('Total Pledges', $totalPledges)->icon('heroicon-o-user-group')
                ->iconColor("warning")
                ->iconBackgroundColor("warning")
                ->description("Total pledges this year")
                ->descriptionColor("warning")
                ->color("warning"),
            AdvancedStatsOverviewWidgetStat::make('Total Offerings', $totalOfferings)->icon('heroicon-o-user-group')
                ->iconColor("info")
                ->iconBackgroundColor("info")
                ->description("Total offerings this year")
                ->descriptionColor("info")
                ->color("info"),
        ];
    }
}

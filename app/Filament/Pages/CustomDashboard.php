<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class CustomDashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament-panels::pages.dashboard';

    public function getTitle(): string
    {
        return 'Dashboard';
    }

    public function getSubheading(): string
    {
        return 'Welcome to your music store management system';
    }

    protected function getHeaderActions(): array
    {
        return [
            // Add any custom header actions here
        ];
    }
}

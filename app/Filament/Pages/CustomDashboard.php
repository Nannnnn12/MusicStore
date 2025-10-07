<?php

namespace App\Filament\Pages;

use Filament\Pages\Actions\Action;
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
            Action::make('homepage')
                ->label('Go to Homepage')
                ->icon('heroicon-o-home')
                ->url(url('/'))
                ->color('info'),
        ];
    }

}

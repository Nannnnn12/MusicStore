<?php

namespace App\Filament\Pages;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Support\Facades\Auth;

class CustomLogin extends BaseLogin
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament-panels::pages.auth.login';

    public function getTitle(): string
    {
        return 'Sign In to Music Store Admin';
    }

    public function getHeading(): string
    {
        return 'Welcome to Music Store';
    }


    protected function getRegisterAction(): \Filament\Actions\Action
    {
        return \Filament\Actions\Action::make('register')
        ->label('Create Account')
        ->url(fn (): string => route('filament.admin.auth.register'))
        ->color('gray');
    }
    protected function getFormActions(): array
    {
        return [
            $this->getAuthenticateFormAction(),
            $this->getRegisterAction(),
        ];
    }

    protected function getAuthenticateFormAction(): \Filament\Actions\Action
    {
        return parent::getAuthenticateFormAction()
            ->label('Sign In')
            ->action(function () {
                $this->authenticate();
                $user = Auth::user();
                if ($user->role === 'admin') {
                    return redirect('/admin');
                } else {
                    return redirect('/');
                }
            });
    }

    protected function getEmailFormComponent(): \Filament\Forms\Components\Component
    {
        return parent::getEmailFormComponent()
            ->label('Email Address');
    }

    protected function getPasswordFormComponent(): \Filament\Forms\Components\Component
    {
        return parent::getPasswordFormComponent()
            ->label('Password');
    }
}

<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomRegister extends BaseRegister
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function getTitle(): string
    {
        return 'Create Account - Music Store Admin';
    }

    public function getHeading(): string
    {
        return 'Join Music Store Admin';
    }

    protected function getFormActions(): array
    {
        return [
            $this->getRegisterFormAction(),
        ];
    }

    public function getRegisterFormAction(): \Filament\Actions\Action
    {
        return parent::getRegisterFormAction()
            ->label('Create Account');
    }

    protected function getNameFormComponent(): TextInput
    {
        return parent::getNameFormComponent()
            ->label('Full Name')
            ->required()
            ->maxLength(255);
    }

    protected function getEmailFormComponent(): TextInput
    {
        return parent::getEmailFormComponent()
            ->label('Email Address')
            ->required()
            ->email()
            ->maxLength(255)
            ->unique(User::class, 'email');
    }

    protected function getPasswordFormComponent(): TextInput
    {
        return TextInput::make('password')
            ->label('Password')
            ->required()
            ->minLength(8)
            ->password()
            ->revealable()
            ->helperText('Password must be at least 8 characters long');
    }

    protected function getPasswordConfirmationFormComponent(): TextInput
    {
        return TextInput::make('password_confirmation')
            ->label('Confirm Password')
            ->required()
            ->minLength(8)
            ->password()
            ->revealable()
            ->same('password');
    }

    protected function getTermsFormComponent(): \Filament\Forms\Components\Checkbox
    {
        return \Filament\Forms\Components\Checkbox::make('terms')
            ->label('I agree to the Terms and Conditions')
            ->required()
            ->accepted();
    }

    public function register(): \Filament\Http\Responses\Auth\Contracts\RegistrationResponse|null
    {
        $data = $this->form->getState();

        if (!isset($data['terms']) || !$data['terms']) {
            Notification::make()
                ->title('Terms Required')
                ->body('You must agree to the Terms and Conditions to register.')
                ->danger()
                ->send();
            return null;
        }

        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'user', // Default role for new registrations
            ]);

            Notification::make()
                ->title('Account Created Successfully!')
                ->body('Welcome to Music Store Admin. You are now logged in.')
                ->success()
                ->send();

            Auth::login($user);

            // The middleware will handle redirection based on role
            return null;
        } catch (\Exception $e) {
            Notification::make()
                ->title('Registration Failed')
                ->body('There was an error creating your account. Please try again.')
                ->danger()
                ->send();

            return null;
        }
    }
}

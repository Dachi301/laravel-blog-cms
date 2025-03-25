<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Enums\RolesEnum;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
        $this->record->assignRole(RolesEnum::AUTHOR->value);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialAccountResource\Pages;
use App\Models\SocialAccount;
use App\Models\SocialMedia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class SocialAccountResource extends Resource
{
    protected static ?string $model = SocialAccount::class;
    protected static ?string $navigationGroup = 'Management Sosial Media';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Akun Sosial Media';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('social_media_id')
                    ->label('Social Media Platform')
                    ->options(SocialMedia::pluck('name', 'id'))
                    ->required(),

                Forms\Components\TextInput::make('account_name')
                    ->label('Account Name')
                    ->required(),

                Forms\Components\TextInput::make('account_url')
                    ->label('Account URL')
                    ->url()
                    ->required(),

                Forms\Components\Textarea::make('credentials')
                    ->label('Credentials (JSON)')
                    ->helperText('Masukkan API key atau token dalam format JSON.')
                    ->rows(4),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('platform.name')->label('Platform')->sortable(),
                TextColumn::make('account_name')->searchable(),
                TextColumn::make('account_url')->url(fn($record) => $record->account_url, true),
                TextColumn::make('created_at')->dateTime('d M Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocialAccounts::route('/'),
            'create' => Pages\CreateSocialAccount::route('/create'),
            'edit' => Pages\EditSocialAccount::route('/{record}/edit'),
        ];
    }
}

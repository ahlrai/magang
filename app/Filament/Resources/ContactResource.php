<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Management Sosial Media';
    protected static ?string $navigationLabel = 'Contacts';
    protected static ?string $pluralLabel = 'Contacts';
    protected static ?string $modelLabel = 'Contact';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required(),

                        Forms\Components\TextInput::make('username')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->nullable(),

                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->nullable(),

                        Forms\Components\Select::make('platform')
                            ->options([
                                'instagram' => 'Instagram',
                                'tiktok' => 'TikTok',
                                'facebook' => 'Facebook',
                                'youtube' => 'YouTube',
                            ])
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->options([
                                'baru' => 'Baru',
                                'follow-up' => 'Follow Up',
                                'closing' => 'Closing',
                                'lost' => 'Lost',
                            ])
                            ->default('baru')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('username')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\BadgeColumn::make('platform')
                    ->colors([
                        'info' => 'instagram',
                        'success' => 'tiktok',
                        'warning' => 'facebook',
                        'danger' => 'youtube',
                    ]),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'baru',
                        'warning' => 'follow-up',
                        'success' => 'closing',
                        'danger' => 'lost',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i')->label('Dibuat'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}

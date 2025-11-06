<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConversationResource\Pages;
use App\Models\Conversation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

class ConversationResource extends Resource
{
    protected static ?string $model = Conversation::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Fitur';

    protected static ?string $navigationLabel = 'Conversation Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('social_account_id')
                    ->relationship('socialAccount', 'account_name')
                    ->label('Account')
                    ->searchable()
                    ->required(),
                Textarea::make('message')
                    ->label('Message')
                    ->required()
                    ->rows(4),
                Select::make('direction')
                    ->options([
                        'incoming' => 'Incoming',
                        'outgoing' => 'Outgoing',
                    ])
                    ->required()
                    ->label('Direction'),
                Forms\Components\DateTimePicker::make('sent_at')
                    ->label('Sent At'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('socialAccount.account_name')
                    ->label('Account')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->label('Message')
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\BadgeColumn::make('direction')
                    ->colors([
                        'success' => 'incoming',
                        'info' => 'outgoing',
                    ]),
                Tables\Columns\TextColumn::make('sent_at')
                    ->dateTime('d M Y H:i')
                    ->label('Sent At'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->label('Created'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConversations::route('/'),
            'create' => Pages\CreateConversation::route('/create'),
            'edit' => Pages\EditConversation::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Fitur';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('platform')
                    ->options([
                        'instagram' => 'Instagram',
                        'facebook' => 'Facebook',
                    ])
                    ->required()
                    ->reactive(),

                //Facebook
                Forms\Components\TextInput::make('page_id')
                    ->label('Facebook Page ID')
                    ->visible(fn (callable $get) => $get('platform') === 'facebook'),

                Forms\Components\FileUpload::make('media_url')
                    ->label('Instagram Media')
                    ->image()
                    ->directory('posts/media')
                    ->visible(fn (callable $get) => $get('platform') === 'instagram'),

                Forms\Components\Textarea::make('caption')
                    ->required()
                    ->visible(fn (callable $get) => in_array($get('platform'), ['facebook', 'instagram'])),

                Forms\Components\DateTimePicker::make('scheduled_at')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'posted' => 'Posted',
                        'failed' => 'Failed',
                    ])
                    ->default('scheduled'),
                            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('platform')
                    ->badge()
                    ->colors([
                        'info' => 'facebook',
                        'warning' => 'instagram',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('caption'),
                BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'scheduled',
                        'success' => 'posted',
                        'danger'  => 'failed',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('scheduled_at')
                    ->dateTime('d-M-Y H:i'),

                 TextColumn::make('posted_at')
                    ->dateTime('d-M-Y H:i')
                    ->sortable(),

                TextColumn::make('response_status')
                    ->label('API Response')
                    ->badge()
                    ->colors([
                        'success' => fn ($state) => $state === 'success',
                        'danger'  => fn ($state) => $state === 'error' || $state === 'failed',
                    ])
                    ->default('—'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseResource\Pages;
use App\Filament\Resources\ExerciseResource\RelationManagers;
use App\Models\Exercise;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExerciseResource extends Resource
{
    protected static ?string $model = Exercise::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->columnSpan(8)
                    ->required(),
            
                Forms\Components\Select::make('muscles')
                    ->multiple()
                    ->label('Músculos')
                    ->relationship('muscles','name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nome Exercicio')
                ->limit(50)
                ->searchable(),
            Tables\Columns\TextColumn::make('muscles.name')
                ->label('Músculos')
                ->width('500px')
                ->color('gray')
                ->searchable()
        ])
        ->filters([
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageExercises::route('/'),
        ];
    }

    public static function getLabel(): ?string
    {
        return 'Exercício';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Exercícios';
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkoutModelResource\Pages;
use App\Filament\Resources\WorkoutModelResource\RelationManagers;
use App\Models\WorkoutModel;
use App\Models\WorkoutType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkoutModelResource extends Resource
{
    protected static ?string $model = WorkoutModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome do modelo de Treino')
                    ->columnSpan(1),

                Forms\Components\Placeholder::make('user.name')
                    ->label('Criado por')
                    ->columnSpan(1)
                    ->content(fn ($record) => $record->user->name ?? auth()->user()->name),

                Forms\Components\RichEditor::make('observation')
                    ->label('Observação')
                    ->columnSpanFull(),


                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->user()->id),

                Forms\Components\Section::make('Treino')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Criador')
                    ->sortable()
                    ->searchable()
                
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkoutModels::route('/'),
            'create' => Pages\CreateWorkoutModel::route('/create'),
            'edit' => Pages\EditWorkoutModel::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return 'Modelo de Treino';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Modelos de Treino';
    }

    public static function getNavigationLabel(): string
    {
        return 'Modelos de Treino'; // Personalize exatamente como quer que apareça
    }
}

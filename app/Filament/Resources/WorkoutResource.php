<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkoutResource\Pages;
use App\Models\Exercise;
use App\Models\Method;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutType;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class WorkoutResource extends Resource
{
    protected static ?string $model = Workout::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Hidden::make('user_id')
                    ->required()
                    ->default(auth()->user()->id),

                Forms\Components\TextInput::make('title')
                    ->label('Titúlo')
                    ->columnSpanFull(),

                Forms\Components\Grid::make(4)
                    ->schema([

                        Forms\Components\Select::make('workout_type_id')
                            ->label('Tipo de treino')
                            ->required()
                            ->columnSpan(2)
                            ->relationship('workout_type','name', ),
            
                        Forms\Components\Placeholder::make('user.name')
                            ->label('Criado por')
                            ->columnSpan(1)
                            ->content(fn ($record) => $record->user->name ?? auth()->user()->name),
                        
                        Forms\Components\Toggle::make('public')
                            ->default(true)
                            ->columnSpan(1)
                            ->inline(false)
                            ->onIcon('heroicon-o-eye')
                            ->offIcon('heroicon-o-eye-slash')
                            ->label('Público'),
                    ]),
                    
                Forms\Components\RichEditor::make('observation')
                    ->label('Detalhes')
                    ->columnSpanFull(),

                Forms\Components\Section::make('Divisões do Treino')
                    ->icon('phosphor-list-bullets-bold')
                    ->description('Organize o treino em sessões distintas para facilitar o planejamento e execução.')
                    ->schema([
                        Forms\Components\Repeater::make('workout_divisions')
                            ->relationship()
                            ->label('Divisões')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Nome divisão')  
                                    ->required()
                                    ->default(fn ($get) => 'Treino ' . chr(64 + (count($get('../')) ?? 0))),

                                TableRepeater::make('workout_division_exercises')
                                    ->relationship()
                                    ->orderColumn('order')
                                    ->label('Exercicios')
                                    ->headers([
                                        Header::make('Metodo')->width('250px')->markAsRequired(),
                                        Header::make('Exercício')->width('250px')->markAsRequired(),
                                        Header::make('Series'),
                                        Header::make('Repetições')->width('300px')->markAsRequired(),
                                    ])
                                    ->schema([
                                        Forms\Components\Hidden::make('user_id')
                                            ->default(auth()->user()->id),
                                        Forms\Components\Select::make('method_id')
                                            ->preload()
                                            ->options(Method::all()->pluck('name','id')),
                                        Forms\Components\Select::make('exercise_id')
                                            ->preload()
                                            ->searchable()
                                            ->options(Exercise::all()->pluck('name','id')),
                                        Forms\Components\TextInput::make('series')->numeric(),
                                        Forms\Components\TextInput::make('repetitions')
                                            ->required(),

                                    ])
                                    
                                    
                            ])
                            ->addActionLabel('Adicionar Divisão')
                        
                    ])
                    
                    

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Criado por')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('workout_type.name')
                    ->label('Tipo treino')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\IconColumn::make('public')
                    ->icon('heroicon-o-eye')
            ])
            ->filters([
                SelectFilter::make('Usuários')
                    ->relationship('user','name')
                    ->multiple()
                    ->preload()
                    ->options(User::all()->pluck('name','id')),
                SelectFilter::make('Tipo treino')
                    ->relationship('workout_type','name')
                    ->multiple()
                    ->preload()
                    ->options(WorkoutType::all()->pluck('name','id'))
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
            'index' => Pages\ListWorkouts::route('/'),
            'create' => Pages\CreateWorkout::route('/create'),
            'edit' => Pages\EditWorkout::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Gestão de Treinos';
    }

    public static function getLabel(): ?string
    {
        return 'Treino';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Treinos';
    }
}

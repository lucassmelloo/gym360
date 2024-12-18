<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Exercise;
use App\Models\Method;
use App\Models\Student;
use App\Models\WorkoutType;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'phosphor-student';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                PhoneInput::make('telephone')
                    ->label('Telefone')
                    ->defaultCountry('BR'),

                DatePicker::make('date_of_birth')
                    ->minDate(now()->subYears(150))
                    ->maxDate(now()),
                Forms\Components\RichEditor::make('observation')
                    ->label('Observações')
                    ->columnSpanFull(),

                Forms\Components\Section::make('Treino')
                    ->relationship('principal_workout')
                    ->schema([
                        Forms\Components\Grid::make(4)
                            ->schema([
                                Forms\Components\DatePicker::make('start_date')
                                    ->columnSpan(1),
                                Forms\Components\DatePicker::make('due_date')
                                    ->columnSpan(1),
                                Forms\Components\Select::make('workout_type_id')
                                    ->columnSpan(1)
                                    ->options(fn () => WorkoutType::all()->pluck('name', 'id')),
                            ]),
                        Forms\Components\Repeater::make('workout_divisions')
                            ->label('Divisões')
                            ->orderColumn('order')
                            ->relationship('workout_divisions')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Nome divisão')
                                    ->required()
                                    ->default(fn ($get) => 'Treino '.chr(64 + (count($get('../')) ?? 0))),

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
                                            ->options(Method::all()->pluck('name', 'id')),
                                        Forms\Components\Select::make('exercise_id')
                                            ->preload()
                                            ->searchable()
                                            ->options(Exercise::all()->pluck('name', 'id')),
                                        Forms\Components\TextInput::make('series')
                                            ->numeric()
                                            ->default(3),
                                        Forms\Components\TextInput::make('repetitions')
                                            ->required(),

                                    ]),

                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Gestão de Pessoas';
    }

    public static function getLabel(): string
    {
        return 'Aluno';
    }

    public static function getPluralLabel(): string
    {
        return 'Alunos';
    }
}

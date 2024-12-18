<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkoutResource\Pages;
use App\Models\Exercise;
use App\Models\Method;
use App\Models\Student;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutType;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
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

                Forms\Components\Select::make('student_id')
                    ->label('Aluno')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->options(fn () => Student::all()->pluck('name', 'id')),

                Forms\Components\Placeholder::make('user.name')
                    ->label('Criado por')
                    ->columnSpan(1)
                    ->content(fn ($record) => $record->user->name ?? auth()->user()->name),

                Forms\Components\Grid::make(5)
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Data de Inicio')
                            ->displayFormat('d/m/Y')
                            ->format('Y-m-d')
                            ->default(now())
                            ->columnSpan(1)
                            ->required(),

                        Forms\Components\DatePicker::make('due_date')
                            ->label('Data de Validade')
                            ->displayFormat('d/m/Y')
                            ->format('Y-m-d')
                            ->columnSpan(1)
                            ->default(now()->addDays(45))
                            ->required(),

                        Forms\Components\Select::make('workout_type_id')
                            ->label('Tipo de treino')
                            ->required()
                            ->columnSpan(1)
                            ->relationship('workout_type', 'name'),

                        Forms\Components\Toggle::make('public')
                            ->default(true)
                            ->columnSpan(1)
                            ->inline(false)
                            ->onIcon('heroicon-o-eye')
                            ->offIcon('heroicon-o-eye-slash')
                            ->label('Público'),
                    ]),

                Forms\Components\Section::make('Divisões do Treino')
                    ->icon('phosphor-list-bullets-bold')
                    ->description('Organize o treino em sessões distintas para facilitar o planejamento e execução.')
                    ->schema([
                        Forms\Components\Repeater::make('workout_divisions')
                            ->relationship()
                            ->orderColumn('order')
                            ->label('Divisões')
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

                            ])
                            ->addActionLabel('Adicionar Divisão'),

                    ]),

            ]);
    }

    public static function actions($record): array
    {
        return [
            Forms\Components\Actions\Action::make('tornarPrincipal')
                ->label('Tornar esse treino principal')
                ->color('success') // Escolha a cor do botão
                ->icon('heroicon-o-check-circle') // Ícone para estilizar
                ->requiresConfirmation() // Confirmação antes de executar
                ->visible(fn ($record) => $record->student_id !== null) // Visível apenas se houver estudante
                ->action(function ($record) {
                    // Atualize o `student_id` do estudante para o ID do Workout atual
                    $student = $record->student;

                    if ($student) {
                        $student->update([
                            'workout_id' => $record->id, // Associe o treino como principal
                        ]);
                    }

                    // Mensagem de sucesso
                    Filament\Notifications\Notification::make()
                        ->title('Treino atualizado!')
                        ->body("O treino '{$record->title}' agora é o principal para o estudante {$record->student->name}.")
                        ->success()
                        ->send();
                }),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Aluno')
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
                    ->icon('heroicon-o-eye'),
            ])
            ->filters([
                SelectFilter::make('Aluno')
                    ->relationship('student', 'name')
                    ->preload()
                    ->options(Student::all()->pluck('name', 'id')),
                SelectFilter::make('Usuários')
                    ->relationship('user', 'name')
                    ->multiple()
                    ->preload()
                    ->options(User::all()->pluck('name', 'id')),
                SelectFilter::make('Tipo treino')
                    ->relationship('workout_type', 'name')
                    ->multiple()
                    ->preload()
                    ->options(WorkoutType::all()->pluck('name', 'id')),

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

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;
use App\Filament\Widgets\AttendanceSearchWidget;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->user()->id),
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('attendance_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Nome aluno')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('attendance_date')
                    ->label('Data Presença')
                    ->date('d/m/Y')
                    ->sortable(),

            ])
            ->filters([
                Filter::make('attendance_date')
                ->form([
                    DatePicker::make('Data Inicial')
                        ->default(now()),
                    DatePicker::make('Data Final')
                        ->default(now()),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['Data Inicial'],
                            fn (Builder $query, $date): Builder => $query->whereDate('attendance_date', '>=', $date),
                        )
                        ->when(
                            $data['Data Final'],
                            fn (Builder $query, $date): Builder => $query->whereDate('attendance_date', '<=', $date),
                        );
                })

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



    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAttendances::route('/'),
        ];
    }

    public static function getLabel(): ?string
    {
        return 'Presença';
    }
    
    public static function getPluralLabel(): ?string
    {
        return 'Presenças';
    }
}

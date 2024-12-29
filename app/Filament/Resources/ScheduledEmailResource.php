<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduledEmailResource\Pages;
use App\Filament\Resources\ScheduledEmailResource\RelationManagers;
use App\Models\ScheduledEmail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduledEmailResource extends Resource
{
    protected static ?string $model = ScheduledEmail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Administrador';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('subject')
                    ->label('Assunto')
                    ->columnSpanFull()
                    ->required(),
                    Forms\Components\RichEditor::make('body')
                    ->label('Corpo do E-mail')
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\Select::make('recipients')
                    ->label('Destinatários')
                    ->options(
                        \App\Models\RecipientEmail::all()->pluck('description', 'name')
                    )
                    ->required(),
                Forms\Components\TextInput::make('others_recipients')
                    ->label('Outros Destinatários separados por ";"'),
                Forms\Components\DateTimePicker::make('scheduled_at')
                    ->label('Agendado para')
                    ->seconds(false)
                    ->required(),
                Forms\Components\Hidden::make('status')
                    ->default('pending')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject')
                    ->label('Assunto')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('recipients')
                    ->label('Destinatários')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('scheduled_at')
                    ->dateTime('d/m/Y H:i')
                    ->label('Agendado para')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable(),
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

    public static function getLabel(): ?string
    {
        return 'Agendar E-mail';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Agendar E-mails';   
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScheduledEmails::route('/'),
            'create' => Pages\CreateScheduledEmail::route('/create'),
            'edit' => Pages\EditScheduledEmail::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Intern\Resources\Suggestions\Schemas;

use App\Models\Category;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;

class SuggestionForm
{
    public static function configure(Schema $schema): Schema
    {
        $category = Category::query()
            ->where('category_type', 'Suggestion')
            ->orderBy('category_name')
            ->pluck('category_name', 'category_id');

        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Kategori')
                    ->required()
                    ->options($category)
                    ->native(false)
                    ->searchable(),
                TextInput::make('suggestion_title')
                    ->label('Judul')
                    ->required(),
                RichEditor::make('suggestion_description')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link', 'highlight', 'details'],
                        ['h1', 'h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                        ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                        ['table'],
                        ['undo', 'redo'],
                    ]),
            ]);
    }
}

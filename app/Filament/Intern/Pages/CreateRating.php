<?php

namespace App\Filament\Intern\Pages;

use Filament\Forms;
use App\Models\Rating;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateRating extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.intern.pages.create-rating';

    protected static bool $shouldRegisterNavigation = false; // Hide from navigation

    protected static ?string $title = 'Lengkapi Data Rating Anda';

    public ?array $data = [];

    public function mount(): void
    {
        // Redirect jika sudah ada rating
        if (Auth::user()->rating) {
            redirect()->route('filament.intern.resources.projects.index');
        }

        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Rating Internship')
                    ->description('Mohon berikan penilaian terhadap pengalaman magang Anda')
                    ->schema([
                        Select::make('rating_range')
                            ->label('Rating Keseluruhan')
                            ->options([
                                1 => '1 - Sangat Buruk',
                                2 => '2 - Buruk',
                                3 => '3 - Cukup',
                                4 => '4 - Baik',
                                5 => '5 - Sangat Baik',
                            ])
                            ->required()
                            ->native(false),
                        Textarea::make('rating_description')
                            ->label('Feedback')
                            ->autosize()
                            ->trim()
                            ->placeholder('Berikan feedback mengenai pengalaman magang Anda...')
                            ->maxLength(1000),
                    ]),
                Actions::make([
                    Action::make('submit')
                        ->label('Submit Rating')
                        ->submit('submit')
                        ->color('primary')
                ])
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        try {
            $data = $this->form->getState();

            Rating::create([
                'user_id' => Auth::id(),
                ...$data
            ]);

            Notification::make()
                ->title('Berhasil memberikan rating magang!')
                ->success()
                ->send();

            redirect()->route('filament.intern.resources.projects.index');
        } catch (Halt $exception) {
            return;
        }
    }
}

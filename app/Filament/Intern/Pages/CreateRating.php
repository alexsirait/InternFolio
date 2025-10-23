<?php

namespace App\Filament\Intern\Pages;

use App\Models\Rating;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Mokhosh\FilamentRating\RatingTheme;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Mokhosh\FilamentRating\Components\Rating as ComponentsRating;

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
                        ComponentsRating::make('rating_range')
                            ->default(5)
                            ->color('warning')
                            ->size('xl')
                            ->required(),
                        Textarea::make('rating_description')
                            ->label('Feedback')
                            ->autosize()
                            ->trim()
                            ->placeholder('Berikan feedback mengenai pengalaman magang Anda...')
                            ->maxLength(1000)
                            ->required(),
                        Actions::make([
                            Action::make('submit')
                                ->label('Submit Rating')
                                ->submit('submit')
                                ->color('primary')
                        ])->alignEnd()
                    ]),
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

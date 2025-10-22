<?php

namespace App\Filament\Intern\Pages;

use App\Filament\Intern\Resources\Projects\ProjectResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;

class Profile extends BaseEditProfile
{
    protected string $view = 'filament.intern.pages.profile';

    public function getMaxContentWidth(): ?string
    {
        return '3xl'; // atau '7xl', '6xl', '5xl', dll
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pribadi')
                    ->description('Update informasi profil Anda')
                    ->schema([
                        FileUpload::make('user_image')
                            ->label('Foto Profile')
                            ->image()
                            ->directory('interns')
                            ->disk('public')
                            // ->avatar()
                            ->columnSpanFull(),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('position')
                                    ->label('Posisi')
                                    ->maxLength(255),
                                TextInput::make('major')
                                    ->label('Jurusan')
                                    ->maxLength(255),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('linkedin_url')
                                    ->label('LinkedIn')
                                    ->maxLength(255),
                                TextInput::make('instagram_url')
                                    ->label('Instagram')
                                    ->maxLength(255),
                            ]),
                    ]),

                Section::make('Ubah Password')
                    ->description('Kosongkan jika tidak ingin mengubah password')
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Password Saat Ini')
                            ->password()
                            ->revealable()
                            ->dehydrated(false)
                            ->requiredWith(['new_password', 'new_password_confirmation'])
                            ->rules(['current_password'])
                            ->validationMessages([
                                'current_password' => ':attribute tidak sesuai!',
                                'required_with' => ':attribute wajib diisi jika password baru diisi.',
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('new_password')
                                    ->label('Password Baru')
                                    ->password()
                                    ->revealable()
                                    ->dehydrated(false)
                                    ->minLength(8)
                                    ->same('new_password_confirmation')
                                    ->requiredWith(['current_password', 'new_password_confirmation'])
                                    ->rules(['nullable', 'min:8'])
                                    ->validationMessages([
                                        'min' => 'Password minimal 8 karakter!',
                                        'same' => 'Password harus sama!',
                                        'required_with' => ':attribute wajib diisi jika password saat ini diisi.',
                                    ]),

                                TextInput::make('new_password_confirmation')
                                    ->label('Konfirmasi Password Baru')
                                    ->password()
                                    ->revealable()
                                    ->dehydrated(false)
                                    ->requiredWith(['new_password', 'current_password'])
                                    ->rules(['nullable', 'min:8'])
                                    ->validationMessages([
                                        'min' => 'Password minimal 8 karakter!',
                                        'required_with' => ':attribute wajib diisi jika Password Baru diisi.',
                                    ]),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                Actions::make([
                    Action::make('save')
                        ->label('Simpan Perubahan')
                        ->submit('save')
                        ->icon('heroicon-o-check-circle')
                        ->color('primary'),
                    Action::make('back')
                        ->label('Kembali')
                        ->url(url()->previous())
                        ->color('gray')
                        ->icon('heroicon-o-arrow-left'),
                ])->alignEnd()
            ])
            ->statePath('data')
            ->model(Auth::user());
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user = Auth::user();

        return [
            'user_image' => $user->user_image,
            'position' => $user->position,
            'major' => $user->major,
            'linkedin_url' => $user->linkedin_url,
            'instagram_url' => $user->instagram_url,
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = Auth::user();

        // Hapus foto lama jika ada foto baru
        if (isset($data['user_image']) && $data['user_image'] !== $user->user_image) {
            if ($user->user_image && Storage::disk('public')->exists($user->user_image)) {
                Storage::disk('public')->delete($user->user_image);
            }
        }

        $state = $this->form->getRawState();

        // Update password jika diisi
        if (!empty($state['new_password'])) {
            $data['password'] = Hash::make($state['new_password']);
        }

        return $data;
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Profil berhasil diperbarui';
    }

    public static function getLabel(): string
    {
        return 'Edit Profile';
    }

    protected function getRedirectUrl(): ?string
    {
        return ProjectResource::getIndexUrl();
    }
}

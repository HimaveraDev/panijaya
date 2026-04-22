<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Actions\Action;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $title = 'Pengaturan Website';

    protected static ?string $navigationLabel = 'Pengaturan';

    protected static ?string $slug = 'site-settings';

    protected string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::get();
        $this->form->fill($settings->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Website')
                    ->description('Kelola nama, logo, dan identitas utama situs.')
                    ->components([
                        Grid::make(2)
                            ->components([
                                TextInput::make('site_name')
                                    ->label('Nama Website')
                                    ->required(),
                                FileUpload::make('logo_path')
                                    ->label('Logo Website')
                                    ->image()
                                    ->disk('public')
                                    ->directory('site')
                                    ->visibility('public')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                                    ->maxSize(1024),
                                TextInput::make('logo_height')
                                    ->label('Tinggi Logo (px)')
                                    ->numeric()
                                    ->default(40)
                                    ->helperText('Satuan piksel. Contoh: 40')
                                    ->required(),
                            ]),
                    ]),

                Section::make('Hero & Konten Utama')
                    ->description('Atur gambar dan teks utama yang muncul di halaman depan.')
                    ->components([
                        FileUpload::make('hero_image')
                            ->label('Gambar Hero (Header)')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(3072),
                        TextInput::make('hero_title')
                            ->label('Judul Hero'),
                        Textarea::make('hero_description')
                            ->label('Deskripsi Hero')
                            ->rows(3),
                    ]),

                Section::make('Informasi Kontak')
                    ->description('Detail kontak yang muncul di footer dan tombol WhatsApp.')
                    ->components([
                        Grid::make(3)
                            ->components([
                                TextInput::make('whatsapp_number')
                                    ->label('Nomor WhatsApp (Contoh: +628...)')
                                    ->tel(),
                                TextInput::make('email')
                                    ->label('Email Kontak')
                                    ->email(),
                                TextInput::make('footer_text')
                                    ->label('Teks Footer'),
                            ]),
                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->rows(2),
                        TextInput::make('google_maps_url')
                            ->label('URL Embed Google Maps (Src dari Iframe)'),
                    ]),

                Section::make('Keunggulan (Point of Sale)')
                    ->description('Kelola bagian "Mengapa Memilih Pani Jaya?" di halaman depan.')
                    ->components([
                        TextInput::make('features_title')
                            ->label('Judul Utama Seksi Keunggulan')
                            ->required(),
                        FileUpload::make('features_image')
                            ->label('Gambar Utama Seksi Keunggulan')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048),
                        
                        Grid::make(3)
                            ->components([
                                Section::make('Poin 1')
                                    ->components([
                                        TextInput::make('feature_1_title')
                                            ->label('Judul Poin 1'),
                                        Textarea::make('feature_1_description')
                                            ->label('Deskripsi Poin 1')
                                            ->rows(3),
                                    ]),
                                Section::make('Poin 2')
                                    ->components([
                                        TextInput::make('feature_2_title')
                                            ->label('Judul Poin 2'),
                                        Textarea::make('feature_2_description')
                                            ->label('Deskripsi Poin 2')
                                            ->rows(3),
                                    ]),
                                Section::make('Poin 3')
                                    ->components([
                                        TextInput::make('feature_3_title')
                                            ->label('Judul Poin 3'),
                                        Textarea::make('feature_3_description')
                                            ->label('Deskripsi Poin 3')
                                            ->rows(3),
                                    ]),
                            ]),
                    ]),

                Section::make('Halaman Tentang Kami')
                    ->description('Kelola konten di halaman "Tentang Kami".')
                    ->components([
                        Grid::make(2)
                            ->components([
                                TextInput::make('about_hero_title')
                                    ->label('Judul Hero Halaman'),
                                TextInput::make('about_hero_description')
                                    ->label('Sub-judul Hero'),
                            ]),
                        TextInput::make('about_history_title')
                            ->label('Judul Seksi Sejarah & Visi'),
                        FileUpload::make('about_image')
                            ->label('Gambar Perusahaan/Workshop')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(2048),
                        RichEditor::make('about_history')
                            ->label('Sejarah Perusahaan')
                            ->toolbarButtons([
                                'bold', 'bulletList', 'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'undo',
                            ])
                            ->columnSpanFull(),
                        RichEditor::make('about_vision')
                            ->label('Visi Kami')
                            ->toolbarButtons([
                                'bold', 'italic', 'redo', 'undo',
                            ])
                            ->columnSpanFull(),
                        RichEditor::make('about_mission')
                            ->label('Misi Kami')
                            ->toolbarButtons([
                                'bold', 'bulletList', 'italic', 'link', 'orderedList', 'redo', 'undo',
                            ])
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->getForm('form')->getState();
            $settings = SiteSetting::get();
            $settings->update($data);

            Notification::make()
                ->title('Berhasil!')
                ->body('Pengaturan website telah diperbarui.')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error!')
                ->body('Gagal memperbarui pengaturan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}

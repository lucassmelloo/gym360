<x-filament::page>
    <form wire:submit.prevent="sendEmails" class="space-y-6">
        {{ $this->form }}
        <x-filament::button type="submit" color="primary">
            Enviar E-mails
        </x-filament::button>
    </form>
</x-filament::page>
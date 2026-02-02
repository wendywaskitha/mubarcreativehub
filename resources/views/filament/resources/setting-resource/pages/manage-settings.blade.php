<x-filament-panels::page>
    <form wire:submit="save" class="space-y-6">
        {{ $this->form }}

        <div class="flex justify-end gap-4 mt-6">
            @foreach ($this->getCachedHeaderActions() as $action)
                {{ $action }}
            @endforeach
        </div>
    </form>
</x-filament-panels::page>
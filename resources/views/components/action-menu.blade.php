@props(['id'])

<details class="action-menu" name="row-actions">
    <summary class="action-menu-trigger" aria-label="Afficher les actions" aria-controls="{{ $id }}" title="Actions">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"
            aria-hidden="true">
            <circle cx="12" cy="5" r="1.75" />
            <circle cx="12" cy="12" r="1.75" />
            <circle cx="12" cy="19" r="1.75" />
        </svg>
    </summary>
    <div class="action-menu-panel" id="{{ $id }}">
        {{ $slot }}
    </div>
</details>

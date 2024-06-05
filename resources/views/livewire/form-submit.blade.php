<div class="center">
    <input type="submit" wire:click="pay" wire:init="validateForm" class="button is-primary is-medium is-rounded px-5" value="Pagar" {{ $can_submit ? '' : 'disabled' }}>
</div>
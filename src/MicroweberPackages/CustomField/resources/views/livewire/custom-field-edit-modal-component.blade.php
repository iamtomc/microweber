<div xmlns:x-microweber-ui="http://www.w3.org/1999/html">
    <div class="mw-modal">
        <div class="mw-modal-dialog" role="document">
            <div class="mw-modal-content">
                <div class="mw-modal-header">
                    <h5 class="mw-modal-title">
                        {{_e('Settings')}}
                    </h5>
                    <button type="button" class="btn-close" wire:click="$emit('closeModal')"
                            aria-label="Close"></button>
                </div>
                <div class="mw-modal-body">

                    <div class="mt-3">
                        <x-microweber-ui::label for="name" value="Name" />
                        <x-microweber-ui::input id="name" class="mt-1 block w-full" wire:model="state.name" />
                    </div>

                    <div class="mt-3">
                        <x-microweber-ui::label for="type" value="Type" />
                        @php
                        $customFieldsType = mw()->ui->custom_fields();
                        @endphp
                        <x-microweber-ui::select id="type" :options="$customFieldsType" class="mt-1 block w-full" wire:model="state.type" />
                    </div>

                    <div class="mt-3">
                        <x-microweber-ui::label for="value" value="Value" />
                        <x-microweber-ui::input id="value" class="mt-1 block w-full" wire:model="state.value" />
                    </div>

                    <div class="mt-3">
                        <x-microweber-ui::label for="show_placeholder" value="Show Placeholder" />
                        <x-microweber-ui::toggle id="show_placeholder" class="mt-1 block w-full" wire:model="state.options.show_placeholder" />
                    </div>

                    <div class="mt-3">
                        <x-microweber-ui::label for="required" value="Required" />
                        <x-microweber-ui::toggle id="required" class="mt-1 block w-full" wire:model="state.required" />
                    </div>


                    <div class="mt-3">
                        <x-microweber-ui::label for="error_text" value="Error Text" />
                        <x-microweber-ui::input id="error_text" class="mt-1 block w-full" wire:model="state.error_text" />
                        <small>
                           {{_e('This error will be shown when fields are required but not filled')}}
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

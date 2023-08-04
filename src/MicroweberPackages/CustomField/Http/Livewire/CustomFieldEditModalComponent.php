<?php

namespace MicroweberPackages\CustomField\Http\Livewire;

use MicroweberPackages\Admin\Http\Livewire\AdminModalComponent;
use MicroweberPackages\CustomField\Models\CustomField;
use MicroweberPackages\CustomField\Models\CustomFieldValue;

class CustomFieldEditModalComponent extends AdminModalComponent
{
    public $customFieldId;
    public $state = [];

    public $showValueSettings = false;
    public $showRequiredSettings = false;
    public $showLabelSettings = false;
    public $showPlaceholderSettings = false;
    public $showErrorTextSettings = false;
    public $showOptionsSettings = false;


    public function mount($customFieldId)
    {
        $this->customFieldId = $customFieldId;
    }

    public function save()
    {
        $save = mw()->fields_manager->save($this->state);

        $this->showSettings($this->state['type']);
        $this->emit('customFieldUpdated');
    }

    public function showSettings($type)
    {
        $this->showValueSettings = false;
        $this->showRequiredSettings = false;
        $this->showLabelSettings = false;
        $this->showPlaceholderSettings = false;
        $this->showOptionsSettings = false;
        $this->showErrorTextSettings = false;

        if ($type == 'text'
            || $type == 'date'
            || $type == 'time'
            || $type == 'number'
            || $type == 'phone'
            || $type == 'website'
            || $type == 'email'
            || $type == 'address'
            || $type == 'country'
            || $type == 'color') {
            $this->showValueSettings = true;
            $this->showRequiredSettings = true;
            $this->showLabelSettings = true;
            $this->showPlaceholderSettings = true;
        }

        if ($type == 'upload') {
            $this->showRequiredSettings = true;
            $this->showLabelSettings = true;
            $this->showPlaceholderSettings = true;
        }

        if ($type == 'radio' || $type == 'dropdown' || $type == 'checkbox') {
            $this->showValueSettings = true;
            $this->showRequiredSettings = true;
            $this->showLabelSettings = true;
            $this->showPlaceholderSettings = false;
            $this->showErrorTextSettings = true;
        }

        if ($type == 'price') {
            $this->showValueSettings = true;
        }

        if ($type == 'hidden') {
            $this->showValueSettings = true;
        }

        if ($type == 'property') {
            $this->showValueSettings = true;
        }
    }

    public function render()
    {
        $getCustomField = CustomField::where('id', $this->customFieldId)->first();
        $this->state = $getCustomField->toArray();

        if ($this->state['type'] == 'upload') {
            if (!isset($this->state['options']['file_types'])) {
                $this->state['options']['file_types'] = [];
            }
            if (!is_array($this->state['options']['file_types'])) {
                $this->state['options']['file_types'] = [];
            }
        }

        $this->showSettings($getCustomField->type);

        return view('custom_field::livewire.custom-field-edit-modal-component',[
            'customField' => $getCustomField
        ]);
    }
}

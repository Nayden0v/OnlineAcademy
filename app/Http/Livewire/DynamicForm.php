<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DynamicForm extends Component
{
    public $rows = [];
    public function addRow()
    {
        $this->rows[] = '';
    }
    public function deleteRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);
    }
    public function addModule()
    {
        $this->rows[] = ['module_title' => '', 'module_description' => ''];
    }
    public function render()
    {
        return view('livewire.dynamic-form');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

class Edit extends Component
{
    public $distribuidora_id;
    public $desarrolladora_id;
    public $videojuego_id;



    public function render()
    {
        return view('livewire.edit');
    }
}

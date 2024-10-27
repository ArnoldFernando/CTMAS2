<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ExistingRecordsModal extends Component
{
    /**
     * Create a new component instance.
     */
    public $records;

    // Constructor allows null value for $records
    public function __construct($records = null)
    {
        $this->records = $records;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.existing-records-modal');
    }
}

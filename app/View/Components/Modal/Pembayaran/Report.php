<?php

namespace App\View\Components\Modal\Pembayaran;

use Illuminate\View\Component;

class Report extends Component
{
    public $dataProdi;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dataProdi)
    {
        $this->dataProdi = $dataProdi;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.pembayaran.report');
    }
}

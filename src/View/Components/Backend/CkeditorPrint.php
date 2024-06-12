<?php

namespace Cpkm\Print\View\Components\Backend;

use Illuminate\View\Component;

class CkeditorPrint extends Component
{
    public $text;
    public $placeholder;
    public $name;
    public $value;
    public $required;
    public $disabled;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text,$placeholder,$name,$value = '',$required = false,$disabled = false)
    {
        $this->name = $name;
        $this->value= $value;
        $this->required = $required;
        $this->text = $text;
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view("print::components.backend.ckeditor-print");
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class todocard extends Component
{
    public string $todo_id;
    public string $todo;
    public string $status;
    
    /**
     * Create a new component instance.
     */
    public function __construct(public $data)
    {
        $this->todo_id = $data->todo_id;
        $this->todo = $data->todo;
        $this->status = $data->status;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.todocard');
    }
}

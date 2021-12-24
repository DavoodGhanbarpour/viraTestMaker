<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class courseSelectOptions extends Component
{
    public $selected;

    public function __construct($selected = '')
    {
        $this->selected     = $selected;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        
        $courses = DB::table('courses')->select('*')->where([ [ 'trash', '<>', trashed() ] ])->get()->toArray();
        return view('components.course-select-options', [ 'courses' => $courses, 'selected' => $this->selected  ]);
    }
}

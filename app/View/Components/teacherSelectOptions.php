<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class teacherSelectOptions extends Component
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
        $teachers = DB::table('users')->select('*')->where([ [ 'trash', '<>', trashed() ] ,[ 'role', '=', 'TEACHER' ] ])->get()->toArray();
        return view('components.teacher-select-options', [ 'teachers' => $teachers, 'selected' => $this->selected ]);
    }
}

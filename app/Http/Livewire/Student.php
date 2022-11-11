<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Student extends Component
{
    public $name, $email, $course;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:6',
            'email' => ['required', 'email'],
            'course' => 'required|string',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveStudent()
    {
    }

    public function render()
    {
        return view('livewire.student');
    }
}

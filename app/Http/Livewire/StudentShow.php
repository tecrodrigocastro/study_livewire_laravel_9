<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentShow extends Component
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
        $validated = $this->validate();

        Student::create($validated);
        session()->flash('message', 'Student Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->course = '';
    }

    public function render()
    {
        return view('livewire.student-show');
    }
}
<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Models\Student;
use Livewire\Component;

class StudentShow extends Component
{
    public $name, $email, $course, $student_id;
    public $search = '';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

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

    public function updateStudent()
    {
        $validated = $this->validate();

        Student::where('id', $this->student_id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'course' => $validated['course']
        ]);
        session()->flash('message', 'Student Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editStudent(int $student_id)
    {

        $student = Student::find($student_id);
        if ($student) {
            $this->student_id = $student->id;
            $this->name = $student->name;
            $this->email = $student->email;
            $this->course = $student->course;
        } else {
            return redirect()->to('/students');
        }
    }

    public function deleteStudent(int $student_id)
    {
        $this->student_id = $student_id;
    }
    public function destroyStudent()
    {
        Student::find($this->student_id)->delete();
        session()->flash('message', 'Student Deleted Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->course = '';
    }

    public function render()
    {
        $students = Student::where('name','like','%'.$this->search.'%')->orderBy('id', 'DESC')->paginate(3);
        return view('livewire.student-show', ['students' => $students]);
    }
}

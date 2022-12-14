<div>
    @include('livewire.studentmodal')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Student CRUD with Bootstrap Modal
                            <input type="search" wire:model="search" placeholder="Search..." class="form-control float-end mx-2" style="width: 230px">
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#studentModal">
                                Add New Student
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderd table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Course</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->course }}</td>
                                        <td>
                                            <a href="" class="btn btn-primary"
                                                wire:click="editStudent({{ $student->id }})" data-bs-toggle="modal"
                                                data-bs-target="#updateStudentModal">Edit</a>
                                            <a href="" wire:click="deleteStudent({{ $student->id }})"
                                                class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteStudentModal">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"> No Record Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $students->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

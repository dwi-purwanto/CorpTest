@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Employees') }}</div>

                <div class="card-body">
                     <div class="d-flex align-right">
                        <button class="btn btn-primary mb-4" id="add_button"> <i class="fa fa-plus"></i> Add Employee </button>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Company</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if ( count($employees) > 0 )
                                @foreach ( $employees as $employee )
                                    <tr>
                                        <td> {{$no++}} </td>
                                        <td> {{$employee->company->name}} </td>
                                        <td> {{$employee->name}} </td>
                                        <td> {{$employee->email}} </td>
                                        <td>
                                            <button type="button" class="btn btn-success edit-button" data-id="{{$employee->id}}">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <form method="POST" action="{{route('employee.delete',$employee->id)}}" style="display: inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger delete-button">
                                                    <i class="fa fa-delete"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center"> <h6><b> No Data Results. </b></h6> </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('employees.modal')
@endsection

@section('scripts')
    <script>
        $(document).ready( function() {
            modal        = $('#modalForm');
            form         = $('#form');
            modalLoader  = $('#modalLoader');
            inputName    = form.find('#name')
            inputEmail   = form.find('#email')
            inputcompany = form.find('#company_id')

            @if (count($errors) > 0)
                modal.find('.modal-title').text('New Employee');
                modal.modal('show');
            @endif

            $('.delete-button').click(function(e){
                e.preventDefault() // Don't post the form, unless confirmed
                if (confirm('Are you sure?')) {
                    // Post the form
                    $(e.target).closest('form').submit() // Post the surrounding form
                }
            });

            $('#add_button').click( function() {
                form.attr('action', '{{route("employee.store")}}')
                modal.modal({backdrop: 'static', keyboard: false, show: true});
                modal.find('.modal-title').text('New Employee');
                inputName.val('')
                inputEmail.val('')
                inputcompany.val('')
                form.find('input[name ="_method"]').remove();
                form.find('input[name ="employeeId"]').remove();
                form.submit( function() {
                    modal.modal('hide')
                    modalLoader.modal('show')
                })
            });
            $('#close-modal').on('click', function() {
                modalLoader.modal('hide');
            })

            $('.edit-button').on('click', function() {
                var employeeId = $(this).attr('data-id');
                var url       = "{{ route('employee.show') }}";
                inputName.val('')
                inputEmail.val('')
                inputcompany.val('')
                form.find('input[name ="employeeId"]').remove();
                modal.find('.modal-title').text('Edit Employee');
                form.append('<input type="hidden" name="_method" value="PUT">')
                modalLoader.modal({backdrop: 'static', keyboard: false, show: true})
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: url,
                    method: "POST",
                    data: { employee_id: employeeId },
                    success: function(data) {
                        modalLoader.modal('hide');

                        if (data != false) {
                            modal.modal({backdrop: 'static', keyboard: false, show: true});
                            modalLoader.modal('hide');
                            inputName.val(data.name)
                            inputEmail.val(data.email)
                            inputcompany.val(data.company.id)
                            form.append('<input type="hidden" name="employeeId" value="'+employeeId+'">')
                            form.attr('action', '{{route("employee.update")}}')
                            form.submit( function() {
                                modal.modal('hide')
                                modalLoader.modal('show')
                            })
                        }else {
                            modalLoader.modal('hide');
                            alert('Data Not Found!');
                        }
                    }
                })

            });
        });
    </script>
@endsection

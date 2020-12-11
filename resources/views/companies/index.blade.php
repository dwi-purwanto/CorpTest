@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Companies') }}</div>

                <div class="card-body">
                     <div class="d-flex align-right">
                        <button class="btn btn-primary mb-4" id="add_button"> <i class="fa fa-plus"></i> Add Company </button>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Logo</th>
                                <th>Company Name</th>
                                <th>Website</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if ( count($companies) > 0 )
                                @foreach ( $companies as $company )
                                    <tr>
                                        <td> {{$no++}} </td>
                                        <td>
                                            <img class="img-fluid" src="{{route('company.logo', $company->logo)}}" alt="logo-image" style="width: 100px;height:100px">
                                        </td>
                                        <td> {{$company->name}} </td>
                                        <td> {{$company->website}} </td>
                                        <td>
                                            <button type="button" class="btn btn-success edit-button" data-id="{{$company->id}}">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <form method="POST" action="{{route('company.delete',$company->id)}}" style="display: inline">
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

                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('companies.modal')
@endsection

@section('scripts')
    <script>
        $(document).ready( function() {
            modal       = $('#modalForm');
            form        = $('#form');
            modalLoader = $('#modalLoader');
            inputName   = form.find('#name')
            inputEmail  = form.find('#email')
            inputWeb    = form.find('#website')
            inputLogo   = form.find('#logo')

            @if (count($errors) > 0)
                modal.find('.modal-title').text('New Company');
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
                form.attr('action', '{{route("company.store")}}')
                modal.modal({backdrop: 'static', keyboard: false, show: true});
                modal.find('.modal-title').text('New Company');
                inputName.val('')
                inputEmail.val('')
                inputWeb.val('')
                inputLogo.attr('required', true);
                form.find('input[name ="_method"]').remove();
                form.find('input[name ="companyId"]').remove();
                form.submit( function() {
                    modal.modal('hide')
                    modalLoader.modal('show')
                })
            });
            $('#close-modal').on('click', function() {
                modalLoader.modal('hide');
            })

            $('.edit-button').on('click', function() {
                var companyId = $(this).attr('data-id');
                var url       = "{{ route('company.show') }}";
                inputName.val('')
                inputEmail.val('')
                inputWeb.val('')
                inputLogo.removeAttr('required');
                form.find('input[name ="companyId"]').remove();
                modal.find('.modal-title').text('Edit Company');
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
                    data: { company_id: companyId },
                    success: function(data) {
                        modalLoader.modal('hide');

                        if (data != false) {
                            modal.modal({backdrop: 'static', keyboard: false, show: true});
                            modalLoader.modal('hide');
                            inputName.val(data.name)
                            inputEmail.val(data.email)
                            inputWeb.val(data.website)
                            form.append('<input type="hidden" name="companyId" value="'+companyId+'">')
                            form.attr('action', '{{route("company.update")}}')
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

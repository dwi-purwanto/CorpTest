 <!-- The Modal -->
 <div class="modal fade" id="modalForm">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="form">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label class="text-danger"> * (Required) </label>
                    </div>
                    <div class="form-group">
                        <label for="name">Company :  <span class="text-danger"> * </span></label>
                        <select name="company_id" id="company_id" class="form-control @error('company') is-invalid @enderror" required>
                            <option disabled selected>-- Choose Company --</option>
                            @foreach ($companies as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>

                        @error('company_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name :  <span class="text-danger"> * </span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Employee Name" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email : <span class="text-danger"> * </span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" id="email"  name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="close-modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>

                </div>
            </form>

         </div>
     </div>
 </div>

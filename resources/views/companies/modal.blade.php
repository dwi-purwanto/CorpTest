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
                        <label for="name">Company Name :  <span class="text-danger"> * </span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Company Name" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                    <div class="form-group">
                        <label for="logo">Logo : <span class="text-danger"> * File Must .png, max: 2MB</span></label>
                        <input type="file" class="form-control  @error('logo') is-invalid @enderror" placeholder="Choose File" id="logo" name="logo" value="{{ old('logo') }}" required autocomplete="logo">

                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="website">Website : <span class="text-danger"> * </span></label>
                        <input type="url" class="form-control  @error('website') is-invalid @enderror" placeholder="Enter Link Website" id="website"
                            name="website" value="{{ old('website') }}" required autocomplete="website">

                        @error('website')
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

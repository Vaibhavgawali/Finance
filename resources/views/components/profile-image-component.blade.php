<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 my-3 profile-info-section">
  <div class="card">

    <div class="d-flex justify-content-between p-3">
      <div class="d-flex justify-content-between  w-100">
      <h6>Registered on {{ $data->created_at->format('Y-m-d') }}</h6>
      </div>
    </div>

    <div class="profile-img-div text-center">
      @if(auth()->user()->id == $data->id)
      @if($data->profile && $data->profile->profile_image)
      <div id="image-view-1">
        <img src="{{ asset('storage/images/') }}/{{$data->profile->profile_image}}" alt="{{$data->profile->profile_image}}" class="img-fluid">
        <div class="mt-3" id="change-profile-image">
          <button class="btn btn-primary btn-sm" onclick="toggleProfileImageDiv()">Update image</button>

        </div>
      </div>

      <div style="display:none" id="profile-image-change-div">
        <form action="" id="Profile-image-upload-form">
          @csrf
          <label for="profile_image" id="drop-area">

            <div id="image-view">
              <!-- <img src="icon.png" alt=""> -->
              <i class="mdi mdi-cloud-upload "></i>

              <p>Drag and drop or click here <br>to upload image</p>
              <!-- <span>Upload any images From dekstop</span> -->
            </div>
            <input type="file" accept="image/*" id="profile_image" name="profile_image" hidden>
          </label>
          <div class="form-group">
            <label for="user_id"></label>
            <input type="text" class="form-control" id="user_id" placeholder="user_id" value=" {{$data->id}}" hidden>
          </div>
          <br>
          <div class="d-flex w-100 justify-content-center align-items-center ">
            <button style="display:none" ; type="submit" class="btn btn-sm btn-gradient-primary me-2  my-3" id="">Upload</button>
            <a href="" class="btn btn-secondary btn-sm">Cancel</a>
          </div>
        </form>
        <!-- <div id="profile_image_error"></div> -->
      </div>
      <script>
        function toggleProfileImageDiv() {
          var profileImageDiv = document.getElementById('profile-image-change-div');
          var imageView1Div = document.getElementById('image-view-1');
          // Toggle the profile-image-change-div
          profileImageDiv.style.display = (profileImageDiv.style.display === 'none' || profileImageDiv.style.display === '') ? 'block' : 'none';
          // Hide image-view-1 if profile-image-change-div is visible
          imageView1Div.style.display = (profileImageDiv.style.display === 'block') ? 'none' : 'block';
        }
      </script>
      @else


      <form action="" id="Profile-image-upload-form" >
        <div id="profile_image_status"></div>
        @csrf
        <label for="profile_image" id="drop-area">
          <input type="file" accept="image/*" id="profile_image" name="profile_image" hidden>
          <div id="image-view">
            <!-- <img src="icon.png" alt=""> -->
            <i class="mdi mdi-cloud-upload "></i>

            <p>Drag and drop or click here <br>to upload image</p>
            <!-- <span>Upload any images From dekstop</span> -->
          </div>
          <div id="profile_image_error"></div>
        </label>
        <div class="form-group">
          <label for="user_id"></label>
          <input type="text" class="form-control" id="user_id" placeholder="user_id" value=" {{$data->user_id}}" hidden>
        </div>
        <br>
        <div class="d-flex w-100 justify-content-center align-items-center ">
          <button style="display:none" ; type="submit" class="btn btn-gradient-primary me-2  my-3" id="image-upload-button">Upload</button>
        </div>
      </form>
      @endif

      @else    
          @if(empty($data->profile) || empty($data->profile->profile_image))
          <div id="image-view">
            <img src="/admin-assets/assets/images/profile.jpg" alt="Placeholder Image" class="img-fluid">
          </div>
          @else
          <div id="image-view">
            <img src="{{ asset('storage/images/') }}/{{$data->profile->profile_image}}" alt="{{$data->profile->profile_image}}" class="img-fluid">
          </div>
          @endif
      @endif
    </div>

    <div class="profile-personal-info-section">
      <div class="profile-personal-info-div p-3">

        @if(auth()->user()->id == $data->id)
        <div class="text-end">
          <button class="btn btn-gradient-primary btn-sm " id="basic_details_edit_button"><i class="mdi mdi-table-edit"></i></button>
        </div>
        @endif

        <form class="forms-sample" id="basic_details_update_form">
          <div id="basic_details_status"></div>
          @csrf

          <input type="hidden" class="form-control" id="user_id" placeholder="user_id" value=" {{$data->id}}">

          <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Username" disabled value=" {{ $data->name }}">
            <div id="name_error"></div>
          </div>

          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" disabled value=" {{ $data->email }}">
            <div id="name_error"></div>
          </div>

          <div class="form-group">
            <label for="phone">Contact Number</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" disabled value="{{$data->phone}}">
            <div id="phone_error"></div>
          </div>

          <div class="form-group">
            <label for="father_name">Father's Name</label>
            <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Father's Name" disabled value='{{ isset($data->profile) ? $data->profile->father_name : "" }}'>
            <div id="father_name_error"></div>
          </div>

          <div class="form-group">
            <label for="date_of_birth">Date of birth</label>
            <input type="date" class="form-control p-4" name="date_of_birth" id="date_of_birth" placeholder="Date Of Birth" disabled value='{{ isset($data->profile) ? $data->profile->date_of_birth : "" }}'>
            <div id="date_of_birth_error"></div>
          </div>

          <div class="form-group">
            <label for="alt_phone">Alternate Contact Number</label>
            <input type="text" class="form-control" id="alt_phone" name="alt_phone" placeholder="Alternate Contact Number" disabled value='{{ isset($data->profile) ? $data->profile->alt_phone : "" }}'>
            <div id="alt_phone_error"></div>
          </div>

          <div class="form-group">
            <label for="pan">Pan Number</label>
            <input type="text" class="form-control" id="pan" name="pan" placeholder="Pan Number" disabled value='{{ isset($data->profile) ? $data->profile->pan : "" }}'>
            <div id="pan_error"></div>
          </div>

          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address" disabled value="{{$data->phone}}">
            <div id="address_error"></div>
          </div>

          <div class="form-group">
            <label for="pincode">Pincode</label>
            <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Pincode" disabled value='{{ isset($data->address) ? $data->address->pincode : "" }}'>
            <div id="pincode_error"></div>
          </div>

          <div class="form-group">
            <label for="state">State</label>
            <input type="text" class="form-control" name="state" id="state" placeholder="State" disabled value='{{ isset($data->address) ? $data->address->state : "" }}'>
            <div id="state_error"></div>
          </div>

          <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="City" disabled value='{{ isset($data->address) ? $data->address->city : "" }}'>
            <div id="city_error"></div>
          </div>

          <div class="form-group">
              <label for="gst">GST Number</label>
              <select class="form-control" name="gst" id="gst" disabled>
                <option value="1" {{ $data->profile ? ($data->profile->gst ? 'selected' : '') : '' }}>Yes</option>
                <option value="0" {{ $data->profile ? (!$data->profile->gst ? 'selected' : '') : '' }}>No</option>
              </select>
              <div id="gst_error"></div>
          </div>

          <div class="form-group" id="gst_number_field" style="display: {{ $data->profile ? ($data->profile->gst ? 'block' : 'none') : 'none' }}">
            <label for="gst_number">GST Number</label>
            <input type="text" class="form-control" name="gst_number" id="gst_number" placeholder="GST Number" value='{{ $data->business->where("document_title", "gst")->first()->document_number ?? ""   }}'>
            <div id="gst_number_error"></div>
          </div>

          <div class="form-group">
              <label for="msme">MSME Number</label>
              <select class="form-control" name="msme" id="msme" disabled>
                  <option value="1" {{ $data->profile ? ($data->profile->msme ? 'selected' : '') : '' }}>Yes</option>
                  <option value="0" {{ $data->profile ? (!$data->profile->msme ? 'selected' : '') : '' }}>No</option>
              </select>
              <div id="msme_error"></div>
          </div>

          <div class="form-group" id="msme_number_field" style="display: {{  $data->profile ? ($data->profile->msme ? 'block' : 'none') : 'none' }} }}">
              <label for="msme_number">MSME Number</label>
              <!-- <input type="text" class="form-control" name="msme_number" id="msme_number" placeholder="MSME Number" value='{{ $data->business->where("document_title", "msme")->first()->document_number ?? ""  }}'> -->
              <input type="text" class="form-control" name="msme_number" id="msme_number" placeholder="MSME Number" value='{{ isset($data->business) && $data->business->where("document_title", "msme")->first() ? $data->business->where("document_title", "msme")->first()->document_number : "" }}'>
              <div id="msme_number_error"></div>
          </div>

          @if(auth()->user()->id == $data->id)
          <div id="basic_details_update_button_div">
            <button type="submit" class="btn btn-gradient-primary me-2" id="basic_details_update_button">Update</button>
            <button class="btn btn-light" id="basic_details_cancel_button">Cancel</button>
          </div>
          @endif
        </form>

      </div>
    </div>
  </div>

  <!-- crop image model -->
  <div id="imageModel" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title badge badge-gradient-success" id="exampleModalLabel">Upload Image</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex align-items-center justify-content-center">
        <div id="image_demo" style="width:350px; margin-top:30px"></div>
        <div id="validation-messages"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary crop_image">Upload</button>
        </div>
      </div>
    </div>
  </div>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
  <script>
    let Basic_Details_Toggle = () => {
      let editProfileButton = document.getElementById("basic_details_edit_button");
      let profileUpdateButtonDiv = document.getElementById(
        "basic_details_update_button_div"
      );
      let profileCancelButton = document.getElementById(
        "basic_details_cancel_button"
      );
      let profileUpdateButton = document.getElementById("basic_details_update_button");

      let nameInput = document.getElementById("name");
      let emailInput = document.getElementById("email");
      let phoneInput = document.getElementById("phone");
      let fatherNameInput = document.getElementById("father_name");
      let DobInput = document.getElementById("date_of_birth");
      let altPhoneInput = document.getElementById("alt_phone");
      let panInput = document.getElementById("pan");
      let AddressInput = document.getElementById("address");
      let pincodeInput = document.getElementById("pincode");
      let stateInput = document.getElementById("state");
      let cityInput = document.getElementById("city");
      let gstInput = document.getElementById("gst");
      let msmeInput = document.getElementById("msme");

      let toggle = false;
      profileUpdateButtonDiv.style.display = "none";
      editProfileButton.addEventListener("click", () => {
        toggle = !toggle;
        if (toggle) {
          profileUpdateButtonDiv.style.display = "block";
          nameInput.removeAttribute("disabled");
          emailInput.removeAttribute("disabled");
          phoneInput.removeAttribute("disabled");
          fatherNameInput.removeAttribute("disabled");
          DobInput.removeAttribute("disabled");
          panInput.removeAttribute("disabled");
          AddressInput.removeAttribute("disabled");
          altPhoneInput.removeAttribute("disabled");
          pincodeInput.removeAttribute("disabled");
          stateInput.removeAttribute("disabled");
          cityInput.removeAttribute("disabled");
          gstInput.removeAttribute("disabled");
          msmeInput.removeAttribute("disabled");
        } else {
          profileUpdateButtonDiv.style.display = "none";
          nameInput.setAttribute("disabled", true);
          emailInput.setAttribute("disabled", true);
          phoneInput.setAttribute("disabled", true);
          fatherNameInput.setAttribute("disabled", true);
          DobInput.setAttribute("disabled", true);
          panInput.setAttribute("disabled", true);
          AddressInput.setAttribute("disabled", true);
          altPhoneInput.setAttribute("disabled", true);
          pincodeInput.setAttribute("disabled", true);
          stateInput.setAttribute("disabled", true);
          cityInput.setAttribute("disabled", true);
          gstInput.setAttribute("disabled", true);
          msmeInput.setAttribute("disabled", true);
        }
      });
      profileCancelButton.addEventListener("click", () => {
        toggle = false;

        profileUpdateButtonDiv.style.display = "none";
        nameInput.setAttribute("disabled", true);
        emailInput.setAttribute("disabled", true);
        phoneInput.setAttribute("disabled", true);
        fatherNameInput.setAttribute("disabled", true);
        DobInput.setAttribute("disabled", true);
        panInput.setAttribute("disabled", true);
        AddressInput.setAttribute("disabled", true);
        altPhoneInput.setAttribute("disabled", true);
        pincodeInput.setAttribute("disabled", true);
        stateInput.setAttribute("disabled", true);
        cityInput.setAttribute("disabled", true);
        gstInput.setAttribute("disabled", true);
        msmeInput.setAttribute("disabled", true);
      });
    };

    Basic_Details_Toggle();
  </script>
</div>
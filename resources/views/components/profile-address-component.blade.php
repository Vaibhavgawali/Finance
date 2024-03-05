<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 my-3">
  <div class="profile-address-section card">
    <div class="d-flex justify-content-between p-3">
      <h4>Address</h4>
      @if(auth()->user()->user_id == $data->user_id)
      <button class="btn btn-gradient-primary btn-sm " id="profile_address_edit_button"><i class="mdi mdi-table-edit"></i></button>
      @endif
    </div>
    <div class="profile-address-div p-3">

      <form class="forms-sample" id="profile_address_update_form">
        <div id="profile_address_status"></div>
        @csrf
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" class="form-control" name="city" id="city" placeholder="City" disabled value='{{ $data->address->city ?? "NA" }}'>
          <div id="city_error"></div>
        </div>
        <div class="form-group">
          <label for="pincode">Pincode</label>
          <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Pincode" disabled value='{{ $data->address->pincode ?? "NA" }}'>
          <div id="pincode_error"></div>
        </div>
        <div class="form-group">
          <label for="state">State</label>
          <input type="text" class="form-control" name="state" id="state" placeholder="State" disabled value='{{ $data->address->state ?? "NA" }}'>
          <div id="state_error"></div>
        </div>
        <div class="form-group">
          <label for="country">Country</label>
          <input type="text" class="form-control" name="country" id="country" placeholder="Country" disabled value='{{ $data->address->country ?? "India" }}'>
          <div id="country_error"></div>
        </div>
        <div class="form-group">
          <label for="line1">Address Line 1</label>
          <textarea class="form-control" id="line1" name="line1" rows="1" disabled>{{ $data->address->line1 ?? "NA" }}</textarea>
          <div id="line1_error"></div>
        </div>
        <div class="form-group">
          <label for="line2">Address Line 2</label>
          <textarea class="form-control" id="line2" name="line2" rows="1" disabled>{{ $data->address->line2 ?? "NA" }}</textarea>
          <div id="line2_error"></div>
        </div>
        <div class="form-group">
          <label for="line3">Address Line 3</label>
          <textarea class="form-control" id="line3" name="line3" rows="1" disabled>{{ $data->address->line3 ?? "NA" }}</textarea>
          <div id="line3_error"></div>
        </div>
        <div class="form-group">
            <label for="user_id"></label>
            <input type="text" class="form-control" id="user_id" placeholder="user_id"  value=" {{$data->user_id}}" hidden>
          </div>

        @if(auth()->user()->user_id == $data->user_id)
          <div id="profile_address_update_button_div">
            <button type="submit" class="btn btn-gradient-primary me-2" id="profile_address_update_button">Submit</button>
            <button class="btn btn-light" id="profile_address_cancel_button">Cancel</button>
          </div>
        @endif
      </form>
      <script>
        
let Profile_Address_toggle = () => {
    let editProfileButton = document.getElementById(
        "profile_address_edit_button"
    );
    let profileUpdateButtonDiv = document.getElementById(
        "profile_address_update_button_div"
    );
    let profileCancelButton = document.getElementById(
        "profile_address_cancel_button"
    );

    let cityInput = document.getElementById("city");
    let pincodeyInput = document.getElementById("pincode");
    let stateInput = document.getElementById("state");
    let countryInput = document.getElementById("country");
    let line1Input = document.getElementById("line1");
    let line2Input = document.getElementById("line2");
    let line3Input = document.getElementById("line3");

    let toggle = false;

    profileUpdateButtonDiv.style.display = "none";
    editProfileButton.addEventListener("click", () => {
        toggle = !toggle;
        if (toggle) {
            profileUpdateButtonDiv.style.display = "block";
            cityInput.removeAttribute("disabled");
            pincodeyInput.removeAttribute("disabled");
            stateInput.removeAttribute("disabled");
            countryInput.removeAttribute("disabled");
            line1Input.removeAttribute("disabled");
            line2Input.removeAttribute("disabled");
            line3Input.removeAttribute("disabled");
        } else {
            profileUpdateButtonDiv.style.display = "none";
            cityInput.setAttribute("disabled", true);
            pincodeyInput.setAttribute("disabled", true);
            stateInput.setAttribute("disabled", true);
            countryInput.setAttribute("disabled", true);
            line1Input.setAttribute("disabled", true);
            line2Input.setAttribute("disabled", true);
            line3Input.setAttribute("disabled", true);
        }
    });
    profileCancelButton.addEventListener("click", () => {
        toggle = false;

        profileUpdateButtonDiv.style.display = "none";
        cityInput.setAttribute("disabled", true);
        pincodeyInput.setAttribute("disabled", true);
        stateInput.setAttribute("disabled", true);
        countryInput.setAttribute("disabled", true);
        line1Input.setAttribute("disabled", true);
        line2Input.setAttribute("disabled", true);
        line3Input.setAttribute("disabled", true);
    });
};


Profile_Address_toggle();

      </script>

    </div>
  </div>
</div>
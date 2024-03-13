<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 my-3">
  <div class="profile-address-section card">
    <div class="d-flex justify-content-between p-3">
      <h4>Bank Details</h4>
      @if(auth()->user()->id == $data->id)
      <button class="btn btn-gradient-primary btn-sm " id="bank_details_edit_button"><i class="mdi mdi-table-edit"></i></button>
      @endif
    </div>
    <div class="profile-address-div p-3">

      <form class="forms-sample" id="bank_details_update_form">
        <div id="bank_details_status"></div>
        @csrf
        <input type="text" class="form-control" id="user_id" placeholder="user_id"  value=" {{$data->id}}" hidden>
        <div class="form-group">
          <label for="bank_name">Bank Name</label>
          <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name" disabled value='{{ $data->bank ? $data->bank->bank_name : "" }}'>
          <div id="bank_name_error"></div>
        </div>
        <div class="form-group">
          <label for="acc_holder_name">Account Holder Name</label>
          <input type="text" class="form-control" name="acc_holder_name" id="acc_holder_name" placeholder="Account Holder Name" disabled value='{{ $data->bank ? $data->bank->acc_holder_name : "" }}'>
          <div id="acc_holder_name_error"></div>
        </div>
        <div class="form-group">
          <label for="acc_number">Account Number</label>
          <input type="text" class="form-control" name="acc_number" id="acc_number" placeholder="Account Number" disabled value='{{ $data->bank ? $data->bank->acc_number : "" }}'>
          <div id="acc_number_error"></div>
        </div>
        <div class="form-group">
          <label for="ifsc_code">NEFT IFSC Code</label>
          <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="NEFT IFSC Code" disabled value='{{ $data->bank ? $data->bank->ifsc_code : "" }}'>
          <div id="ifsc_code_error"></div>
        </div>

        <h4>Social Media</h4>

        <div class="form-group">
          <label for="facebook">Facebook</label>
          <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook" disabled value='{{ $data->social_links->where("social_site", "Facebook")->first()->profile_url ?? "" }}'>
          <div id="facebook_error"></div>
        </div>
        <div class="form-group">
          <label for="instagram">Instagram</label>
          <input type="text" class="form-control" name="instagram" id="instagram" placeholder="Instagram" disabled value='{{ $data->social_links->where("social_site", "Instagram")->first()->profile_url ?? "" }}'>
          <div id="instagram_error"></div>
        </div>
        <div class="form-group">
          <label for="linkedin">LinkedIn</label>
          <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="LinkedIn" disabled value='{{ $data->social_links->where("social_site", "LinkedIn")->first()->profile_url ?? "" }}'>
          <div id="linkedin_error"></div>
        </div>
        <div class="form-group">
          <label for="twitter">Twitter</label>
          <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Twitter" disabled value='{{ $data->social_links->where("social_site", "Twitter")->first()->profile_url ?? "" }}'>
          <div id="twitter_error"></div>
        </div>
        <div class="form-group">
          <label for="telegram">Telegram</label>
          <input type="text" class="form-control" name="telegram" id="telegram" placeholder="Telegram" disabled value='{{ $data->social_links->where("social_site", "Telegram")->first()->profile_url ?? "" }}'>
          <div id="telegram_error"></div>
        </div>

        @if(auth()->user()->id == $data->id)
          <div id="bank_details_update_button_div">
            <button type="submit" class="btn btn-gradient-primary me-2" id="bank_details_update_button">Update</button>
            <button class="btn btn-light" id="bank_details_cancel_button">Cancel</button>
          </div>
        @endif
      </form>
      <script>
        
let Bank_Details_toggle = () => {
    let editBankDetailButton = document.getElementById(
        "bank_details_edit_button"
    );
    let bankDetaileUpdateButtonDiv = document.getElementById(
        "bank_details_update_button_div"
    );
    let bankDetailCancelButton = document.getElementById(
        "bank_details_cancel_button"
    );

    let bankNameInput = document.getElementById("bank_name");
    let accHolderInput = document.getElementById("acc_holder_name");
    let ifscCodeInput = document.getElementById("ifsc_code");
    let accNumInput = document.getElementById("acc_number");

    let facebookInput = document.getElementById("facebook");
    let instagramInput = document.getElementById("instagram");
    let linkedInInput = document.getElementById("linkedin");
    let twitterInput = document.getElementById("twitter");
    let telegramInput = document.getElementById("telegram");

    let toggle = false;

    bankDetaileUpdateButtonDiv.style.display = "none";
    editBankDetailButton.addEventListener("click", () => {
        toggle = !toggle;
        if (toggle) {
            bankDetaileUpdateButtonDiv.style.display = "block";
            bankNameInput.removeAttribute("disabled");
            accHolderInput.removeAttribute("disabled");
            ifscCodeInput.removeAttribute("disabled");
            accNumInput.removeAttribute("disabled");

            facebookInput.removeAttribute("disabled");
            instagramInput.removeAttribute("disabled");
            linkedInInput.removeAttribute("disabled");
            twitterInput.removeAttribute("disabled");
            telegramInput.removeAttribute("disabled");
        } else {
            bankDetaileUpdateButtonDiv.style.display = "none";
            bankNameInput.setAttribute("disabled", true);
            accHolderInput.setAttribute("disabled", true);
            ifscCodeInput.setAttribute("disabled", true);
            accNumInput.setAttribute("disabled", true);

            facebookInput.setAttribute("disabled", true);
            instagramInput.setAttribute("disabled", true);
            linkedInInput.setAttribute("disabled", true);
            twitterInput.setAttribute("disabled", true);
            telegramInput.setAttribute("disabled", true);
        }
    });
    bankDetailCancelButton.addEventListener("click", () => {
        toggle = false;

        bankDetaileUpdateButtonDiv.style.display = "none";
        bankNameInput.setAttribute("disabled", true);
        accHolderInput.setAttribute("disabled", true);
        ifscCodeInput.setAttribute("disabled", true);
        accNumInput.setAttribute("disabled", true);

        facebookInput.setAttribute("disabled", true);
        instagramInput.setAttribute("disabled", true);
        linkedInInput.setAttribute("disabled", true);
        twitterInput.setAttribute("disabled", true);
        telegramInput.setAttribute("disabled", true);
    });
};


    Bank_Details_toggle();

      </script>

    </div>
  </div>
</div>
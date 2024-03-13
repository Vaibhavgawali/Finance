<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 my-3">
  <div class="professional-birth-section card">
    <div class="d-flex justify-content-between p-3">

      <h4>KYC Details</h4>
      @if(auth()->user()->id == $data->id)
      <button class="btn btn-gradient-primary btn-sm " id="kyc_details_edit_button"><i class="mdi mdi-table-edit"></i></button>
      @endif
    </div>
    <div class="kyc-birth-div p-3">
      <form class="forms-sample" id="kyc_details_add_form" enctype="multipart/form-data">
        <div id="kyc_details_status"></div>
        @csrf
        <input type="hidden" class="form-control" name="id" id="id" value="{{ $data-> id }}">

        <div class="form-group">
            <label for="pan_card">Pan Card</label>
            <input type="file" class="form-control p-4" name="pan_card" id="pan_card" accept=".jpg, .jpeg, .png, .pdf">
            <div id="pan_card_error"></div>
        </div>

        <div class="form-group">
            <label for="cancel_cheque">Cancel Cheque</label>
            <input type="file" class="form-control p-4" name="cancel_cheque" id="cancel_cheque" accept=".jpg, .jpeg, .png, .pdf">
            <div id="cancel_cheque_error"></div>
        </div>

        <div class="form-group">
            <label for="address_proof">Address Proof</label>
            <select class="form-control p-4" id="address_proof_name" name="address_proof_name" placeholder="address_proof_name" disabled>
                <option value="" disabled selected>--Select--</option>
                <option value="Bank Passbook">Bank Passbook</option>
                <option value="Voter ID card">Voter ID card</option>
                <option value="Electricity Bill">Electricity Bill</option>
                <option value="Rent Agreement">Rent Agreement</option>
                <option value="Driving License" >Driving License</option>
                <option value="Landline or postpaid Mobile Bill">Landline or postpaid Mobile Bill</option>
                <option value="Proof of Gas Connection">Proof of Gas Connection</option>
                <option value="Water Bill on individual's name">Water Bill on individual's name</option>
                <option value="Passport">Passport</option>
            </select>
            <div id="address_proof_name_error"></div>

            <input type="text" class="form-control" name="document_number" id="document_number" placeholder="Document Number" disabled>
            <div id="document_number_error"></div>

            <input type="file" class="form-control p-4" name="address_proof" id="address_proof" accept=".jpg, .jpeg, .png, .pdf">
            <div id="address_proof_error"></div>
        </div>

        <div class="form-group">
            <label for="partner_photo">Partner Photo</label>
            <input type="file" class="form-control p-4" name="partner_photo" id="partner_photo" accept=".jpg, .jpeg, .png">
            <div id="partner_photo_error"></div>
        </div>

        @if(auth()->user()->id == $data->id)
          <div id="kyc_details_add_button_div">
            <button type="submit" class="btn btn-gradient-primary me-2" id="kyc_details_add_button">Update</button>
            <button class="btn btn-light" id="kyc_details_cancel_button">Cancel</button>
          </div>
        @endif

      </form>
      <script>
        let Kyc_Details_toggle = () => {
          let editKycButton = document.getElementById(
            "kyc_details_edit_button"
          );
          let kycUpdateButtonDiv = document.getElementById(
            "kyc_details_add_button_div"
          );
          let kycCancelButton = document.getElementById(
            "kyc_details_cancel_button"
          );

          // address_proof_name
          let panCardInput = document.getElementById("pan_card");
          let cancelChequeInput = document.getElementById("cancel_cheque");
          let documentNumberInput = document.getElementById("document_number");
          let addressProofNameInput = document.getElementById("address_proof_name");
          let addressProofInput = document.getElementById("address_proof");
          let partnerPhotoInput = document.getElementById("partner_photo");

          let toggle = false;

          kycUpdateButtonDiv.style.display = "none";
          editKycButton.addEventListener("click", () => {
            toggle = !toggle;
            if (toggle) {
              kycUpdateButtonDiv.style.display = "block";
              panCardInput.removeAttribute("disabled");
              cancelChequeInput.removeAttribute("disabled");
              addressProofNameInput.removeAttribute("disabled");
              documentNumberInput.removeAttribute("disabled");
              addressProofInput.removeAttribute("disabled");
              partnerPhotoInput.removeAttribute("disabled");
            } else {
              kycUpdateButtonDiv.style.display = "none";
              panCardInput.setAttribute("disabled", true);
              cancelChequeInput.setAttribute("disabled", true);
              addressProofNameInput.setAttribute("disabled", true);
              documentNumberInput.setAttribute("disabled", true);
              addressProofInput.setAttribute("disabled", true);
              partnerPhotoInput.setAttribute("disabled", true);
            }
          });
          kycCancelButton.addEventListener("click", () => {
            toggle = false;

            kycUpdateButtonDiv.style.display = "none";
            panCardInput.setAttribute("disabled", true);
            cancelChequeInput.setAttribute("disabled", true);
            addressProofNameInput.setAttribute("disabled", true);
            documentNumberInput.setAttribute("disabled", true);
            addressProofInput.setAttribute("disabled", true);
            partnerPhotoInput.setAttribute("disabled", true);
          });
        };

        Kyc_Details_toggle();
      </script>
    </div>
  </div>
</div>
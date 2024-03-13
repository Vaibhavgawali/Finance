<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 my-3">
  <div class="professional-birth-section card">
    <div class="d-flex justify-content-between p-3">

      <h4>Professional Details</h4>
      @if(auth()->user()->id == $data->id)
      <button class="btn btn-gradient-primary btn-sm " id="professional_details_edit_button"><i class="mdi mdi-table-edit"></i></button>
      @endif
    </div>
    <div class="professional-birth-div p-3">
      <form class="forms-sample" id="professional_details_update_form">
        <div id="professional_details_status"></div>
        @csrf
        <input type="text" class="form-control" id="user_id" placeholder="user_id"  value=" {{$data->id}}" hidden>

        <div class="form-group">
          <label for="profession">Profession</label>
          <select class="form-control p-4" id="profession" name="profession" placeholder="Profession" disabled>
            <option value="" selected disabled>--Select--</option>
            <option value="Business" {{ isset($data->profession) && $data->profession->profession === 'Business' ? 'selected' : '' }}>Business</option>
            <option value="Salary" {{ isset($data->profession) && $data->profession->profession === 'Salary' ? 'selected' : '' }}>Salary</option>
          </select>
          <div id="profession_error"></div>
        </div>

        <div class="form-group">
          <label for="company_name">Company Name</label>
          <input type="text" class="form-control p-4" name="company_name" id="company_name" placeholder="Company Name" disabled value='{{ $data->profession->company_name ?? "" }}'>
          <div id="company_name_error"></div>
        </div>

        <div class="form-group">
          <label for="monthly_income">Monthly Income</label>
          <select class="form-control p-4" id="monthly_income" name="monthly_income" placeholder="Monthly Income" disabled>
            <option value="" selected disabled>--Select--</option>
            <option value="1" {{ isset($data->profession) && $data->profession->monthly_income === '1' ? 'selected' : '' }}>10k to 25k</option>
            <option value="2" {{ isset($data->profession) && $data->profession->monthly_income === '2' ? 'selected' : '' }}>25k to 50k</option>
            <option value="3" {{ isset($data->profession) && $data->profession->monthly_income === '3' ? 'selected' : '' }}>50k to 100k</option>
            <option value="4" {{ isset($data->profession) && $data->profession->monthly_income === '4' ? 'selected' : '' }}>100k to 300k</option>
            <option value="5" {{ isset($data->profession) && $data->profession->monthly_income === '5' ? 'selected' : '' }}>Above 300k</option>
          </select>
          <div id="monthly_income_error"></div>
        </div>

        <div class="form-group">
          <label for="domain">Domain</label>
          <select class="form-control p-4" id="domain" name="domain" placeholder="Domain" disabled>
            <option value="" selected disabled>--Select--</option> 
            <option value="Insurance" {{ isset($data->profession) && $data->profession->domain === 'Insurance' ? 'selected' : '' }}>Insurance</option>
            <option value="Loan" {{ isset($data->profession) && $data->profession->domain === 'Loan' ? 'selected' : '' }}>Loan</option>
            <option value="Sales" {{ isset($data->profession) && $data->profession->domain === 'Sales' ? 'selected' : '' }}>Sales</option>
            <option value="Marketing" {{ isset($data->profession) && $data->profession->domain === 'Marketing' ? 'selected' : '' }}>Marketing</option>
            <option value="Telecom" {{ isset($data->profession) && $data->profession->domain === 'Telecom' ? 'selected' : '' }}>Telecom</option>
            <option value="Other" {{ (isset($data->profession->domain) && !in_array($data->profession->domain, ['Insurance', 'Loan', 'Sales', 'Marketing', 'Telecom'])) ? 'selected' : '' }}>Other</option>
          </select>
          <div id="domain_error"></div>
        </div>

        <div class="form-group" id="other_domain_field" style="display: {{ !in_array($data->profession->domain ?? '', ['Insurance', 'Loan', 'Sales', 'Marketing', 'Telecom']) ? 'block' : 'none' }}">
            <label for="other_domain">Enter Domain</label>
            <input type="text" class="form-control" name="other_domain" id="other_domain" placeholder="Other Domain" value='{{ $data->profession->domain ?? "" }}'>
            <div id="other_domain_error"></div>
        </div>

        @if(auth()->user()->id == $data->id)
          <div id="professional_details_update_button_div">
            <button type="submit" class="btn btn-gradient-primary me-2" id="professional_details_update_button">Update</button>
            <button class="btn btn-light" id="professional_details_cancel_button">Cancel</button>
          </div>
        @endif
      </form>
      <script>
        let Professional_Details_toggle = () => {
          let editProfessionalButton = document.getElementById(
            "professional_details_edit_button"
          );
          let professionalUpdateButtonDiv = document.getElementById(
            "professional_details_update_button_div"
          );
          let professionalCancelButton = document.getElementById(
            "professional_details_cancel_button"
          );

          let professionInput = document.getElementById("profession");
          let monthlyIncomeInput = document.getElementById("monthly_income");
          let companyNameInput = document.getElementById("company_name");
          let DomainInput = document.getElementById("domain");
          let otherDomainInput = document.getElementById("other_domain");

          let toggle = false;

          professionalUpdateButtonDiv.style.display = "none";
          editProfessionalButton.addEventListener("click", () => {
            toggle = !toggle;
            if (toggle) {
              professionalUpdateButtonDiv.style.display = "block";
              professionInput.removeAttribute("disabled");
              monthlyIncomeInput.removeAttribute("disabled");
              companyNameInput.removeAttribute("disabled");
              DomainInput.removeAttribute("disabled");
              otherDomainInput.removeAttribute("disabled");
            } else {
              professionalUpdateButtonDiv.style.display = "none";
              professionInput.setAttribute("disabled", true);
              monthlyIncomeInput.setAttribute("disabled", true);
              companyNameInput.setAttribute("disabled", true);
              DomainInput.setAttribute("disabled", true);
              otherDomainInput.setAttribute("disabled", true);
            }
          });
          professionalCancelButton.addEventListener("click", () => {
            toggle = false;

            professionalUpdateButtonDiv.style.display = "none";
            professionInput.setAttribute("disabled", true);
            monthlyIncomeInput.setAttribute("disabled", true);
            companyNameInput.setAttribute("disabled", true);
            DomainInput.setAttribute("disabled", true);
            otherDomainInput.setAttribute("disabled", true);
          });
        };

        Professional_Details_toggle();
      </script>
    </div>
  </div>
</div>
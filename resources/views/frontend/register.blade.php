@extends('frontend/layouts.main')
@section('main-section')
<div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section
          id="subheader"
          class="text-light"
          data-bgimage="url(assets/images/background/subheader.jpg) top"
        >
          <div class="center-y relative text-center">
            <div class="container">
              <div class="row">
                <div class="col-md-12 text-center">
                  <h1>User Registration</h1>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </section>
        <!-- section close -->

        <section aria-label="section">
          <div class="container">
            <div class="row">
              <div class="col-md-6 offset-md-3">
                <form
                  name="contactForm"
                  id="contact_form"
                  class="form-border"
                  method="post"
                  action="blank.php"
                >
                  <h3>User Registration</h3>

                  <div class="field-set">
                    <label>Name</label>
                    <input
                      type="text"
                      name="name"
                      id="name"
                      class="form-control"
                      placeholder="Enter name"
                    />
                  </div>
 
                  <div class="field-set">
                    <label>Mobile Number</label>
                    <input
                      type="text"
                      name="phone"
                      id="phone"
                      class="form-control"
                      placeholder="Enter Mobile Number"
                    />
                  </div>
                  <div class="field-set">
                    <label>Email</label>
                    <input
                      type="text"
                      name="email"
                      id="email"
                      class="form-control"
                      placeholder="Enter email"
                    />
                  </div>

                  <div id="submit">
                    <button type="submit"  class="btn btn-custom color-2">Register</button>
                  </div>
                    <div class="clearfix"></div>
                    <div class="spacer-single"></div>

                    <!-- social icons -->
                    <ul class="list s3">
                      <li>Allready have an account ?</li>
                      <li><a class="mx-1" href="/login">Login</a>|</li>
                      <li><a href="/">Home</a></li>
                    </ul>
                    <!-- social icons close -->
                  
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!-- content close -->
      <a href="#" id="back-to-top"></a>
@endsection
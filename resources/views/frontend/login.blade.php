@extends('frontend/layouts.main')
@section('main-section')
      
        <!-- section close -->
        <section>
       <div  class="info-register pb-5">
          <div class="container w-100 mt-200 ">
              <div class="row">
                <div class="col-md-12 text-center">
                  <h1>User Login</h1>
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
                  <h3>Login to your account</h3>

                  <div class="field-set">
                    <label>Mobile Number</label>
                    <input
                      type="text"
                      name="name"
                      id="name"
                      class="form-control"
                      placeholder="Enter mobile number"
                    />
                  </div>

                  <div id="submit">
                    <input
                      type="submit"
                      id="send_message"
                      value="Login"
                      class="btn btn-custom color-2"
                    />
                    <div class="clearfix"></div>
                    <div class="spacer-single"></div>
                    <!-- social icons -->
                    <ul class="list s3">
                      <li>Don't have an account ?</li>
                      <li>
                        <a class="mx-1" href="/register">Register</a>|
                      </li>
                      <li><a class="mx-1" href="#">Forgot Password ?</a> |</li>
                      <li><a href="/">Home</a></li>
                    </ul>
                    <!-- social icons close -->
                  </div>
                </form>
              </div>
            </div>
          </div>
       </div>
       <script>
        
       </script>
       <!-- Info Section End -->
 @endsection
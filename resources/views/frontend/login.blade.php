@extends('frontend/layouts.main')
@section('main-section')
       <!-- Info Section Start -->

       <div  class="info-register pb-5">
          <div class="container w-100 mt-50 ">
              <div class="row">
                
                    <div class="col-12 col-md-12 col-lg-4 shadow rounded  p-2   d-none   d-xl-block bg-white">
                        <div>
                           <img src="{{asset('assets/img/3D-images/register.png')}}" alt="">
                        </div>
                        <div>
                        <div class="ins-main-about-list-area ul-li-block">
                          <ul class="">
                            <li class="fs-6 fst-italic" id="title_1">Build your profile .</li>
                              <li class="fs-6 fst-italic" id="title_2">Learn & stay updated.</li>
                            <li class="fs-6 fst-italic" id="title_3">Find a job .</li>
                          </ul> 
                        </div>
                        </div>
                     </div>
                     <div class="col-12 col-md-12 col-lg-1 "></div>
                     <div style="margin: auto;" class="col-11 col-md-12 col-lg-7 shadow  rounded p-4 bg-white">
                       <div>
                           <h4 class="text-start">Enter your details</h4>
                       </div>
                       <div>
                        <div id="register_status"></div>
                        <form id="login_form">
                           @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Email ID</label>
                              <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Tell us your Email ID">
                              <div id="email_error"></div>
                            </div>
                            
                            <div class="mb-3">
                              <label for="password" class="form-label" >Password</label>
                              <input type="password" class="form-control" id="password" placeholder="Enter Your Password">
                              <div id="password_error"></div>
                            </div>
                              <div>
								<div>
									<button type="submit" id="login_btn" class="btn btn-primary  my-2">Login</button>
								</div>
								Dont have an account ? <a href="/register" class="btn btn-secondary text-white mx-2">Register</a> 
                <a href="/password/reset" class="btn btn-secondary text-white mx-2">Forgot Password</a>
							  </div>
                          </form>
                       </div>
                     </div>
            
              </div>
          </div>
       </div>
       <script>

       </script>
       <!-- Info Section End -->
@endsection
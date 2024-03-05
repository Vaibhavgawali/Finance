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
									<li class="fs-6 fst-italic">Build your profile and let recruiters find you.</li>
								    <li class="fs-6 fst-italic">Get job postings delivered right to your email.</li>
									<li class="fs-6 fst-italic">Find a job and grow your career.</li>
								</ul> 
							</div>
                        </div>
                     </div>
                     <div class="col-12 col-md-12 col-lg-1 "></div>
                     <div style="margin: auto;" class="col-11 col-md-12 col-lg-7 shadow  rounded p-4 bg-white">
                       <div>
                           <h4 class="text-start">Find a job & grow your career</h4>
                       </div>
                       <div>
                        <div id="register_status"></div>
                        <form id="login_form">
                           @csrf
                            <!-- <div class="mb-3">
                                    <label for="number" class="form-label">Log In as</label>
                                    <select  class="form-control" aria-label="">
                                      <option selected disabled>-- Select --</option>
                                        <option value="Candidate">Candidate</option>
                                        <option value="Insurer">Insurer</option>
                                        <option value="Institute">Institute</option>
                                    </select>
                            </div> -->

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
							  </div>
                          </form>
                       </div>
                     </div>
            
              </div>
          </div>
       </div>
       <!-- Info Section End -->
@endsection
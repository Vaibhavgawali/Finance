@extends('frontend/layouts.main')
@section('main-section')
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="text-light" style=""
            data-bgimage="url({{ asset('assets/images/background/subheader2.jpg') }}) top" >
            <h1>Loan</h1>
            
        </section>
        <!-- section close -->

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="fs-4">Before proceeding with your loan application, please make sure you have the following documents ready:</p>
                        <h6 class="fs-6 text-dark">Documents to be required</h6>
                        <ul class="mt-4">
                          <li><strong>Identity Proof</strong>: Any document with your personal details like name, age, gender, etc., can be submitted as identity proof, such as passport, PAN Card or driver’s licence.</li>
                          <li><strong>Residence Proof</strong>: Your permanent and current place of residence should be mentioned on a document that is considered as an address proof such as Aadhaar Card or Voter ID.</li>
                          <li><strong>Employment Proof</strong>: Documents showing your employment details, such as whether you are salaried or a self-employed applicant (business), name of the organisation, etc. are considered as employment proof.</li>
                          <li><strong>Income Proof</strong>: Documents showing your net monthly in-hand income such as bank statements are considered as proof of your earnings.</li>
                        </ul>
                        <h6 class="fs-6 text-dark">Loan Criteria Hinges on Several Key Factors</h6>
                        <ol>
                          <li><strong>Age:</strong> To qualify for a loan, your age typically must fall within the range of 23 to 55 years. This is normally used to gauge your financial stability.</li>
                          <li><strong>Credit Score:</strong> A good credit score is crucial for approval. Having a comparatively low credit score can greatly impact your chances of securing a good loan amount. A bad credit score can affect your ROI as well. You need to have a credit score of 750 or higher.</li>
                          <li><strong>Employment Criteria:</strong> For salaried individuals, stable employment is required and having a work experience of 1 to 3 years can be helpful. For self-employed individuals, you must have a well-established and verifiable income source.</li>
                          <li><strong>Income Level:</strong> Your monthly income plays a vital role. A minimum income requirement is there. An amount of INR 15,000 for salaried individuals is kept as a necessary condition. Self-employed applicants may need to demonstrate a higher income based on their business size and nature.</li>
                          <li><strong>Employment Stability:</strong> Consistency in your employment history is important. Frequent job changes have a negative impact.</li>
                          <li><strong>Existing Financial Commitment:</strong> Your existing loans and credit card debts will play an important role in determining whether or not the loan will be sanctioned. High levels of debt will affect your eligibility as they may hinder your ability to repay a new loan.</li>
                        </ol>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/loan/create">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class="bg-color text-center text-light fa-solid fa-house"></i>
                                <div class="fb-text">
                                    <h4>Home Loan</h4>
                                    <p>Nurturing hopes, homes and happiness</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/loan/create">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class="bg-color text-center text-light fa-solid fa-car"></i>
                                <div class="fb-text">
                                    <h4>Vehicle Loan</h4>
                                    <p>Get doorstep loan assistance from our associates</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/loan/create">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class="bg-color text-center text-light fa-solid fa-hand-holding-dollar"></i>

                                <div class="fb-text">
                                    <h4>Personal Loan</h4>
                                    <p>Make your dreams come true with our Personal Loans</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30">
                        <a href="/loan/create">
                            <div class="f-box f-border f-icon-left f-icon-rounded f-box-s1">
                                <i class="bg-color text-center text-light fa-solid fa-building"></i>

                                <div class="fb-text">
                                    <h4>Business Loan</h4>
                                    <p>Help you manage working capital funds and business expansion</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div>
                    </div>
        </section>

        <section class="bg-color text-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2><span class="id-color-secondary">Call us</span> for further information. BlarkaFin customer care
                            is here to help you <span class="id-color-secondary">anytime</span>.</h2>
                        <p class="lead">We're available for 24 hours!</p>
                    </div>

                    <div class="col-md-6 text-lg-center text-sm-center">
                        <div class="phone-num-big">
                            <i class="fa fa-phone id-color-secondary"></i>
                            <span class="pnb-text">
                                Call Us Now
                            </span>
                            <span class="pnb-num">
                                +91-83416-83476
                            </span>
                        </div>
                        <a href="" class="btn-custom capsule med">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>
        <div id="counts-container" data-bgcolor="#F2F6FE" data-textcolor="text-dark"></div>
    </div>
    <!-- content close -->

    <a href="#" id="back-to-top"></a>
@endsection

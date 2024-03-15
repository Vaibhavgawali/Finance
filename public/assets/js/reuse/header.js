$(document).ready(function(){
  
const header = () => {
  return ` 
  <div id="topbar" class="text-light">
  <div class="container">
    <div class="topbar-left sm-hide">
      <span class="topbar-widget tb-social">
        <a href="https://facebook.com/BlarkaFin"><i class="fa fa-facebook"></i></a>
        <a href="https://www.instagram.com/blarkafin/"><i class="fa fa-instagram"></i></a>
      </span>
    </div>

    <div class="topbar-right">
      <div class="topbar-right">
        <span class="topbar-widget"><a href="login.html">Login</a></span>
        <span class="topbar-widget"><a href="register.html">Register</a></span>
        <span class="topbar-widget"><a href="#">FAQ</a></span>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
         <header class="transparent">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="de-flex sm-pt10">
            <div class="de-flex-col">
              <!-- logo begin -->
              <div id="logo">
                <a href="index.html">
                  <img alt="" class="logo" src="images/logo-light.png" />
                  <img alt="" class="logo-2" src="images/logo.png" />
                </a>
              </div>
              <!-- logo close -->
            </div>
            <div class="de-flex-col header-col-mid">
              <!-- mainmenu begin -->
              <ul id="mainmenu">
                <li>
                  <a href="index.html">Home<span></span></a>
                </li>
               
                <li>
                  <a href="credit.html">Credit cards<span></span></a>
                </li>
                <li>
                  <a href="#">Insurance<span></span></a>
                  <ul>
                    <li>
                      <a href="lifeinsurance.html">Life Insurance</a>
                    </li>
                    <li>
                        <a href="generalinsurance.html">General Insurance</a>
                      </li>
                    <li>
                      <a href="healthinsurance.html"
                        >Health Insurance</a
                      >
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="loan.html">Loan<span></span></a>
                </li>
                <li>
                  <a href="">Mutual Funds<span></span></a>
                </li>
                <li>
                  <a href="">ICICI 3 in 1 Account<span></span></a>
                </li>
              </ul>
            </div>
            <div class="de-flex-col">
              <!-- <div class="h-phone "><span>Need&nbsp;Help?</span><i class="fa fa-phone id-color-secondary"></i> <a href="tel:+91 8341683476">+91-8341683476</a></div> -->
              <span id="menu-btn"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>`;
};

$("#header-container").html(header());

})
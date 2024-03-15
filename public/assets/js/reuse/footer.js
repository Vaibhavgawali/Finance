$(document).ready(function(){
    const footer =()=>
{
    return `
    <footer class="footer-light">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-4">
                <div class="widget">
                    <h5>About Us</h5>
                    BlarkaFin is a Professional Financial Services Company Based in India. We at BlarkaFin provide various financial services like Credit Card, Loan, Insurance, Mutual Fund Investments.
                </div>
            </div>

            <div class="col-lg-3">
                <div class="widget">
                    <h5>Quick Link</h5>
                    <ul>
                       <li><a href="index.html">Home</a></li>
                       <li><a href="register.html">Registration</a></li>
                       <li><a href="contact.html">Contact us</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="widget">
                    <h5>Get In Touch</h5>
                    We're here to listen:
                    <address class="s1">
                        <span><i class="fa fa-map-marker fa-lg"></i>308, 2nd Floor, Towne Center Mall, D park.
                            Rohtak, Haryana-124001
                        </span>
                        <span><i class="fa fa-phone fa-lg"></i><a href="tel:+91 8341683476">+91-83416-83476</a></span>
                        <span><i class="fa fa-envelope-o fa-lg"></i><a href="mailto:info@blarkafin.com">info@blarkafin.com</a></span>
                       
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="subfooter">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="de-flex">
                        <div class="de-flex-col">
                            &copy; Copyright 2024 - Blarkafin Designed & Developed by <a href="https://zynovvatech.com"> ZynovvaTech</a>
                        </div>

                        <div class="de-flex-col">
                            <div class="social-icons">
                                <a href="https://facebook.com/BlarkaFin" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                <a href="https://www.instagram.com/blarkafin/" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
    `
}

$('#footer-container').html(footer());
})
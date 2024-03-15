$(document).ready(function(){
    const call =()=>
{
    return `<section class="no-top no-bottom bg-color text-light">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 bg-color-secondary">
                <div class="padding20">
                    <h2>Call us for further information. Blarkafin customer care is here to help you anytime.</h2>
                    <p class="lead">We're available for 24 hours!</p>
                </div>
            </div>

            <div class="col-md-6 text-center">
                <div class="phone-num-big">
                    <i class="fa fa-phone id-color-secondary"></i>
                    <span class="pnb-text">
                        Call Us Now
                    </span>
                    <span class="pnb-num ">
                        <a href="tel:+91 8341683476" class="custom-anchor">+91 -83416-83476</a>
                    </span>
                </div>
                <a href="#" class="btn-custom capsule med fs-sm-1">Contact Us</a>
            </div>
        </div>
    </div>
</section>`
}

const calldark =()=>
{
    return ` <section class="bg-color text-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2><span class="id-color-secondary">Call us</span> for further information. BlarkaFin customer care is here to help you <span class="id-color-secondary">anytime</span>.</h2>
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
                <a href="#" class="btn-custom capsule med">Contact Us</a>
            </div>
        </div>
    </div>
</section>`
}


$('#callus-container').html(call());
$('#callusdark-container').html(calldark());

})
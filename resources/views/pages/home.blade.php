@extends('pages.partials.app')
@section('page-content')


<div class="site-blocks-cover overlay" style="background-image: url(assets2/images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">


                <h1 class="text-white font-weight-light mb-5 text-uppercase font-weight-bold">Worldwide Freight Services</h1>
                <p><a href="#" class="btn btn-primary py-3 px-5 text-white">Get Started!</a></p>

            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row align-items-center no-gutters align-items-stretch overlap-section">
        <div class="col-md-4">
            <div class="feature-1 pricing h-100 text-center">
                <div class="icon">
                    <span class="icon-dollar"></span>
                </div>
                <h2 class="my-4 heading">Best Prices</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis ipsum odio minima tempora animi iure.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="free-quote bg-dark h-100">
                <h2 class="my-4 heading  text-center">Get Free Quote</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="fq_name">Name</label>
                        <input type="text" class="form-control btn-block" id="fq_name" name="fq_name" placeholder="Enter Name">
                    </div>
                    <div class="form-group mb-4">
                        <label for="fq_email">Email</label>
                        <input type="text" class="form-control btn-block" id="fq_email" name="fq_email" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary text-white py-2 px-4 btn-block" value="Get Quote">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-3 pricing h-100 text-center">
                <div class="icon">
                    <span class="icon-phone"></span>
                </div>
                <h2 class="my-4 heading">24/7 Support</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis ipsum odio minima tempora animi iure.</p>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center border-primary">
                <h2 class="mb-0 text-primary">What We Offer</h2>
                <p class="color-black-opacity-5">Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
        <div class="row align-items-stretch">
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="unit-4 d-flex">
                    <div class="unit-4-icon mr-4"><span class="text-primary flaticon-travel"></span></div>
                    <div>
                        <h3>Air Freight</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                        <p class="mb-0"><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="unit-4 d-flex">
                    <div class="unit-4-icon mr-4"><span class="text-primary flaticon-sea-ship-with-containers"></span></div>
                    <div>
                        <h3>Ocean Freight</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                        <p class="mb-0"><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="unit-4 d-flex">
                    <div class="unit-4-icon mr-4"><span class="text-primary flaticon-frontal-truck"></span></div>
                    <div>
                        <h3>Ground Shipping</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                        <p class="mb-0"><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="site-section block-13">
    <!-- <div class="container"></div> -->


    <div class="owl-carousel nonloop-block-13">
        <div>
            <a href="#" class="unit-1 text-center">
                <img src="assets2/images/img_1.jpg" alt="Image" class="img-fluid">
                <div class="unit-1-text">
                    <h3 class="unit-1-heading">Storage</h3>
                    <p class="px-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos tempore ullam minus voluptate libero.</p>
                </div>
            </a>
        </div>

        <div>
            <a href="#" class="unit-1 text-center">
                <img src="assets2/images/img_2.jpg" alt="Image" class="img-fluid">
                <div class="unit-1-text">
                    <h3 class="unit-1-heading">Air Transports</h3>
                    <p class="px-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos tempore ullam minus voluptate libero.</p>
                </div>
            </a>
        </div>

        <div>
            <a href="#" class="unit-1 text-center">
                <img src="assets2/images/img_3.jpg" alt="Image" class="img-fluid">
                <div class="unit-1-text">
                    <h3 class="unit-1-heading">Cargo Transports</h3>
                    <p class="px-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos tempore ullam minus voluptate libero.</p>
                </div>
            </a>
        </div>

        <div>
            <a href="#" class="unit-1 text-center">
                <img src="assets2/images/img_4.jpg" alt="Image" class="img-fluid">
                <div class="unit-1-text">
                    <h3 class="unit-1-heading">Cargo Ship</h3>
                    <p class="px-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos tempore ullam minus voluptate libero.</p>
                </div>
            </a>
        </div>

        <div>
            <a href="#" class="unit-1 text-center">
                <img src="assets2/images/img_5.jpg" alt="Image" class="img-fluid">
                <div class="unit-1-text">
                    <h3 class="unit-1-heading">Ware Housing</h3>
                    <p class="px-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos tempore ullam minus voluptate libero.</p>
                </div>
            </a>
        </div>


    </div>
</div>




<div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center border-primary">
                <h2 class="font-weight-light text-primary">More Services</h2>
                <p class="color-black-opacity-5">We Offer The Following Services</p>
            </div>
        </div>
        <div class="row align-items-stretch">
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                <div class="unit-4 d-flex">
                    <div class="unit-4-icon mr-4"><span class="text-primary flaticon-travel"></span></div>
                    <div>
                        <h3>Air Air Freight</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                        <p><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                <div class="unit-4 d-flex">
                    <div class="unit-4-icon mr-4"><span class="text-primary flaticon-sea-ship-with-containers"></span></div>
                    <div>
                        <h3>Ocean Freight</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                        <p><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                <div class="unit-4 d-flex">
                    <div class="unit-4-icon mr-4"><span class="text-primary flaticon-frontal-truck"></span></div>
                    <div>
                        <h3>Ground Shipping</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                        <p><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                <div class="unit-4 d-flex">
                    <div class="unit-4-icon mr-4"><span class="text-primary flaticon-barn"></span></div>
                    <div>
                        <h3>Warehousing</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                        <p><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                <div class="unit-4 d-flex">
                    <div class="unit-4-icon mr-4"><span class="text-primary flaticon-platform"></span></div>
                    <div>
                        <h3>Storage</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                        <p><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                <div class="unit-4 d-flex">
                    <div class="unit-4-icon mr-4"><span class="text-primary flaticon-car"></span></div>
                    <div>
                        <h3>Delivery Van</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                        <p><a href="#">Learn More</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="site-blocks-cover overlay inner-page-cover" style="background-image: url(assets2/images/hero_bg_2.jpg); background-attachment: fixed;">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-7" data-aos="fade-up" data-aos-delay="400">
                <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-single-big mb-4 d-inline-block popup-vimeo"><span class="icon-play"></span></a>
                <h2 class="text-white font-weight-light mb-5 h1">View Our Services By Watching This Short Video</h2>

            </div>
        </div>
    </div>
</div>

<div class="site-section border-bottom">
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center border-primary">
                <h2 class="font-weight-light text-primary">Testimonials</h2>
            </div>
        </div>

        <div class="slide-one-item home-slider owl-carousel">
            <div>
                <div class="testimonial">
                    <figure class="mb-4">
                        <img src="assets2/images/person_3.jpg" alt="Image" class="img-fluid mb-3">
                        <p>John Smith</p>
                    </figure>
                    <blockquote>
                        <p>&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur unde reprehenderit aperiam quaerat fugiat repudiandae explicabo animi minima fuga beatae illum eligendi incidunt consequatur. Amet dolores excepturi earum unde iusto.&rdquo;</p>
                    </blockquote>
                </div>
            </div>
            <div>
                <div class="testimonial">
                    <figure class="mb-4">
                        <img src="assets2/images/person_2.jpg" alt="Image" class="img-fluid mb-3">
                        <p>Christine Aguilar</p>
                    </figure>
                    <blockquote>
                        <p>&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur unde reprehenderit aperiam quaerat fugiat repudiandae explicabo animi minima fuga beatae illum eligendi incidunt consequatur. Amet dolores excepturi earum unde iusto.&rdquo;</p>
                    </blockquote>
                </div>
            </div>

            <div>
                <div class="testimonial">
                    <figure class="mb-4">
                        <img src="assets2/images/person_4.jpg" alt="Image" class="img-fluid mb-3">
                        <p>Robert Spears</p>
                    </figure>
                    <blockquote>
                        <p>&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur unde reprehenderit aperiam quaerat fugiat repudiandae explicabo animi minima fuga beatae illum eligendi incidunt consequatur. Amet dolores excepturi earum unde iusto.&rdquo;</p>
                    </blockquote>
                </div>
            </div>

            <div>
                <div class="testimonial">
                    <figure class="mb-4">
                        <img src="assets2/images/person_5.jpg" alt="Image" class="img-fluid mb-3">
                        <p>Bruce Rogers</p>
                    </figure>
                    <blockquote>
                        <p>&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur unde reprehenderit aperiam quaerat fugiat repudiandae explicabo animi minima fuga beatae illum eligendi incidunt consequatur. Amet dolores excepturi earum unde iusto.&rdquo;</p>
                    </blockquote>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center border-primary">
                <h2 class="font-weight-light text-primary">Our Blog</h2>
                <p class="color-black-opacity-5">See Our Daily News &amp; Updates</p>
            </div>
        </div>
        <div class="row mb-3 align-items-stretch">
            <div class="col-md-6 col-lg-6 mb-4 mb-lg-4">
                <div class="h-entry">
                    <img src="assets2/images/blog_1.jpg" alt="Image" class="img-fluid">
                    <h2 class="font-size-regular"><a href="#">Warehousing Your Packages</a></h2>
                    <div class="meta mb-4">by Theresa Winston <span class="mx-2">&bullet;</span> Jan 18, 2019 at 2:00 pm <span class="mx-2">&bullet;</span> <a href="#">News</a></div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus eligendi nobis ea maiores sapiente veritatis reprehenderit suscipit quaerat rerum voluptatibus a eius.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 mb-4 mb-lg-4">
                <div class="h-entry">
                    <img src="assets2/images/blog_2.jpg" alt="Image" class="img-fluid">
                    <h2 class="font-size-regular"><a href="#">Warehousing Your Packages</a></h2>
                    <div class="meta mb-4">by Theresa Winston <span class="mx-2">&bullet;</span> Jan 18, 2019 at 2:00 pm <span class="mx-2">&bullet;</span> <a href="#">News</a></div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus eligendi nobis ea maiores sapiente veritatis reprehenderit suscipit quaerat rerum voluptatibus a eius.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section border-top">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="mb-5 text-black">Login</h2>
                <p class="mb-0"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
                        Login
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="site-section border-top">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="mb-5 text-black">Login</h2>
                <p class="mb-0"><a href="#" class="btn btn-success" data-toggle="modal" data-target="#registerModal">
                        Register
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="loginModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Login</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control">
                    </div>

                    <button class="btn btn-primary btn-block">Login</button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- REGISTER / PHONE MODAL -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Register</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

   <div class="modal-body">

    <!-- Step 1: Phone Input -->
    <div id="phoneStep">
      <form id="phoneForm">
        <div class="form-group">
          <label>Phone Number</label>
          <input type="text" name="phone" class="form-control" placeholder="Enter phone" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Send OTP</button>
      </form>
      <div id="phoneMsg" class="text-danger mt-2"></div>
    </div>

    <!-- Step 2: OTP Input for Phone -->
    <div id="otpStep" style="display:none;">
      <form id="otpForm">
        <div class="form-group">
          <label>Enter Phone OTP</label>
          <input type="text" name="otp" class="form-control" placeholder="Enter OTP" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Verify OTP</button>
      </form>
      <div id="otpMsg" class="text-danger mt-2"></div>
    </div>

    <!-- Step 3: Email Verification -->
    <div id="emailStep" style="display:none;">
      <form id="emailForm">
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Verify Email</button>
      </form>
      <div id="emailMsg" class="text-danger mt-2"></div>
    </div>

    <!-- Step 4: Email OTP Input -->
    <div id="emailOtpStep" style="display:none;">
    <form id="emailOtpForm">
        <div class="form-group">
        <label>Enter Email OTP</label>
        <input type="text" name="otp" class="form-control" placeholder="Enter OTP" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Verify OTP</button>
    </form>
    <div id="emailOtpMsg" class="text-danger mt-2"></div>
    </div>

    <!-- Step 4: Complete Registration -->
    <div id="registerStep" style="display:none;">
      <form id="registerForm">
        <div class="form-group">
          <label>Phone</label>
          <input type="text" name="phone" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" placeholder="Enter name" required>
        </div>
        <div class="form-group">
          <label>PAN Card</label>
          <input type="text" name="pan" class="form-control">
        </div>
        <div class="form-group">
          <label>GST No</label>
          <input type="text" name="gst" class="form-control">
        </div>
        <div class="form-group">
          <label>Country</label>
          <select name="country" class="form-control">
            <option>India</option>
          </select>
        </div>
        <div class="form-group">
          <label>State</label>
          <input type="text" name="state" class="form-control">
        </div>
        <div class="form-group">
          <label>City</label>
          <input type="text" name="city" class="form-control">
        </div>
        <div class="form-group">
          <label>Address</label>
          <textarea name="address" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Complete Registration</button>
      </form>
      <div id="registerMsg" class="text-danger mt-2"></div>
    </div>

</div>


    </div>
  </div>
</div>


<!-- Your existing modal and markup (no change needed) -->

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function(){

  $.ajaxSetup({
    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
  });

  // STEP 1: Send phone OTP
  $('#phoneForm').submit(function(e){
    e.preventDefault();
    $.post('/send-phone-otp', $(this).serialize(), function(res){
      if(res.status){
        $('#phoneStep').hide();
        $('#otpStep').show();
        $('#phoneMsg').text('');
      }
      if(res.type === 'exists'){
        $('#phoneMsg').html(
          res.message + '<br><a href="#" data-toggle="modal" data-target="#loginModal">Login</a>'
        );
      }
    });
  });

  // STEP 2: Verify phone OTP
  $('#otpForm').submit(function(e){
    e.preventDefault();
    $.post('/verify-phone-otp', $(this).serialize(), function(res){
      if(res.status){
        $('#otpStep').hide();
        $('#emailStep').show();

        // Pre-fill phone in registration form
        var phone = $('#phoneForm input[name=phone]').val();
        $('#registerForm input[name=phone]').val(phone);
        $('#otpMsg').text('');
      } else {
        $('#otpMsg').text(res.message);
      }
    });
  });

 // STEP 3: Send email OTP
$('#emailForm').submit(function(e){
    e.preventDefault();
    $.post('/send-email-otp', $(this).serialize(), function(res){
        if(res.status){
            $('#emailForm').hide();
            $('#emailOtpStep').show();
            $('#emailMsg').text('');
        } else {
            $('#emailMsg').text(res.message);
        }
    });
});

// STEP 4: Verify email OTP
$('#emailOtpForm').submit(function(e){
    e.preventDefault();
    $.post('/verify-email-otp', $(this).serialize(), function(res){
        if(res.status){
            $('#emailOtpStep').hide();
            $('#registerStep').show();

            // Pre-fill email
            var email = $('#emailForm input[name=email]').val();
            $('#registerForm input[name=email]').val(email);
            $('#emailOtpMsg').text('');
        } else {
            $('#emailOtpMsg').text(res.message);
        }
    });
});

  

  // STEP 4: Complete registration
  $('#registerForm').submit(function(e){
    e.preventDefault();
    $.post('/register', $(this).serialize(), function(res){
      if(res.status){
        alert(res.message);
        $('#registerModal').modal('hide');
        location.reload();
      } else {
        $('#registerMsg').text(res.message);
      }
    });
  });

});

</script>


@endsection
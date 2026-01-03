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

<!-- <div class="site-section border-top">
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
</div> -->


<div class="site-section border-top">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="mb-5 text-black">Register</h2>
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

            <div class="container mt-5">
             <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Register</h4>
                </div>

                <div class="card-body">

                    {{-- Step 1: Phone --}}
                    <div id="stepPhone">
                        <form id="phoneForm">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="phone" class="form-control" placeholder="Enter phone" required>
                                <div class="input-group-text"><span class="bi bi-telephone"></span></div>
                            </div>
                            <div class="text-danger mb-2" id="phoneMsg"></div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Send OTP</button>
                            </div>
                        </form>
                    </div>

                    {{-- Step 2: Phone OTP --}}
                    <div id="stepPhoneOtp" style="display:none;">
                        <form id="phoneOtpForm">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="otp" class="form-control" placeholder="Enter phone OTP" required>
                                <div class="input-group-text"><span class="bi bi-key-fill"></span></div>
                            </div>
                            <div class="text-danger mb-2" id="phoneOtpMsg"></div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Verify OTP</button>
                            </div>
                        </form>
                    </div>

                    {{-- Step 3: Email --}}
                    <div id="stepEmail" style="display:none;">
                        <form id="emailForm">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                                <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                            </div>
                            <div class="text-danger mb-2" id="emailMsg"></div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Send OTP</button>
                            </div>
                        </form>
                    </div>

                    {{-- Step 4: Email OTP --}}
                    <div id="stepEmailOtp" style="display:none;">
                        <form id="emailOtpForm">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="otp" class="form-control" placeholder="Enter email OTP" required>
                                <div class="input-group-text"><span class="bi bi-key-fill"></span></div>
                            </div>
                            <div class="text-danger mb-2" id="emailOtpMsg"></div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Verify OTP</button>
                            </div>
                        </form>
                    </div>

                    {{-- Step 5: Registration Form --}}
                    <div id="stepRegister" style="display:none;">
                        <form id="registerForm" action="{{ route('user.register.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="phone">
                            <input type="hidden" name="email">

                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                                <div class="input-group-text"><span class="bi bi-person"></span></div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password (optional)">
                                <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="pan" class="form-control" placeholder="PAN Card (optional)">
                                <div class="input-group-text"><span class="bi bi-card-text"></span></div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="gst" class="form-control" placeholder="GST No (optional)">
                                <div class="input-group-text"><span class="bi bi-file-text"></span></div>
                            </div>

                            <div class="input-group mb-3">
                                <select name="country" class="form-select">
                                    <option>India</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="state" class="form-control" placeholder="State">
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="city" class="form-control" placeholder="City">
                            </div>

                            <div class="input-group mb-3">
                                <textarea name="address" class="form-control" placeholder="Address"></textarea>
                            </div>

                            <div class="input-group mb-3">
                                <select name="status" class="form-select" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Complete Registration</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

        </div>
    </div>
</div>


<!-- Your existing modal and markup (no change needed) -->

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        // STEP 1: Send phone OTP
        $('#phoneForm').submit(function(e) {
            e.preventDefault();
            $.post('/send-phone-otp', $(this).serialize(), function(res) {
                if (res.status) {
                    $('#phoneStep').hide();
                    $('#otpStep').show();
                    $('#phoneMsg').text('');
                }
                if (res.type === 'exists') {
                    $('#phoneMsg').html(
                        res.message + '<br><a href="#" data-toggle="modal" data-target="#loginModal">Login</a>'
                    );
                }
            });
        });

        // STEP 2: Verify phone OTP
        $('#otpForm').submit(function(e) {
            e.preventDefault();
            $.post('/verify-phone-otp', $(this).serialize(), function(res) {
                if (res.status) {
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
        $('#emailForm').submit(function(e) {
            e.preventDefault();
            $.post('/send-email-otp', $(this).serialize(), function(res) {
                if (res.status) {
                    $('#emailForm').hide();
                    $('#emailOtpStep').show();
                    $('#emailMsg').text('');
                } else {
                    $('#emailMsg').text(res.message);
                }
            });
        });

        // STEP 4: Verify email OTP
        $('#emailOtpForm').submit(function(e) {
            e.preventDefault();
            $.post('/verify-email-otp', $(this).serialize(), function(res) {
                if (res.status) {
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



    $('#registerForm').submit(function(e) {
    e.preventDefault();

    $.post('/register', $(this).serialize(), function(res) {
        if (res.status) {
            // SweetAlert success popup
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: res.message,
                timer: 2000,         // auto close after 2 seconds
                showConfirmButton: false
            });

            // Close modal after short delay
            setTimeout(function() {
                $('#registerModal').modal('hide');
                location.reload(); // reload page or update table
            }, 2000);

        } else {
            // Show error message in div
            $('#registerMsg').text(res.message);
        }
    });
});


});
</script>


@endsection
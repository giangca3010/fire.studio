@extends('client.layouts.default', ['noFooter' => true])
@section('content')
    <!-- ==================== Start header ==================== -->

    <header class="works-header fixed-slider hfixd valign">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-11 static">
                    <div class="capt mt-50">
                        <div class="parlx">
                            <h2 class="custom-font"><span>Let's</span>{{ $contact->{'title_' . $language} }}</h2>
                            <p>{{ $contact->{'desc_' . $language} }}</p>
                        </div>

                        <div class="bactxt custom-font valign">
                            <span class="full-width">Contact</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ==================== End header ==================== -->

    <!-- ==================== Start main-content ==================== -->

    <div class="main-content">

        <!-- ==================== Start Contact ==================== -->

        <section class="contact section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form md-mb50">

                            <h4 class="extra-title mb-50">Get In Touch.</h4>

                            <form id="contact-form" method="post" action="contact.php">

                                <div class="messages"></div>

                                <div class="controls">

                                    <div class="form-group">
                                        <input id="form_name" type="text" name="name" placeholder="Name"
                                               required="required">
                                    </div>

                                    <div class="form-group">
                                        <input id="form_email" type="email" name="email" placeholder="Email"
                                               required="required">
                                    </div>

                                    <div class="form-group">
                                        <textarea id="form_message" name="message" placeholder="Message" rows="4"
                                                  required="required"></textarea>
                                    </div>

                                    <button type="submit" class="btn-curve btn-lit"><span>Send Message</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                        <div class="cont-info">
                            <h4 class="extra-title mb-50">{{ $contact->{'contact_' . $language} }}</h4>
                            @for($i = 0; $i < count(json_decode($contact->{'box_contact_' . $language})->box_name); $i++)
                                <h3 class="custom-font wow" data-splitting>{{ json_decode($contact->{'box_contact_' . $language})->box_name[$i] }}
                                </h3>
                                <div class="item mb-40">
                                    <h6>{{ json_decode($contact->{'box_contact_' . $language})->box_value[$i] }}</h6>
                                </div>
                            @endfor
                            <div class="social mt-50">
                                <a href="#0" class="icon">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#0" class="icon">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#0" class="icon">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                                <a href="#0" class="icon">
                                    <i class="fab fa-behance"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== End Contact ==================== -->

    @include('client.components.google-map')

    <!-- ==================== Start Footer ==================== -->

        <footer class="footer-half sub-bg">
            <div class="container">
                @include('client.components.copyrights')
            </div>
        </footer>

        <!-- ==================== End Footer ==================== -->

    </div>

    <!-- ==================== End main-content ==================== -->
@endsection

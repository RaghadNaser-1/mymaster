@extends('layouts.master')

@section('content')
<div class="row g-0" style="background-color: #f4623a; height: 70px;"></div>

    <div class="container-fluid px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-10 text-center mt-4">
                <h1 class="mt-0">About Us</h1>
                <hr class="divider" />

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="mission">
                            <h2>Our Mission</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec metus ac ligula mollis pulvinar. Aliquam aliquam, lorem eu facilisis tincidunt, ex lectus blandit mi, vitae vulputate purus enim eu sem.</p>
                        </div>

                        <div class="history">
                            <h2>Our History</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec metus ac ligula mollis pulvinar. Aliquam aliquam, lorem eu facilisis tincidunt, ex lectus blandit mi, vitae vulputate purus enim eu sem.</p>
                        </div>

                        <div class="staff">
                            <h2>Our Staff</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec metus ac ligula mollis pulvinar. Aliquam aliquam, lorem eu facilisis tincidunt, ex lectus blandit mi, vitae vulputate purus enim eu sem.</p>
                        </div>

                        <div class="contact">
                            <h2>Contact Details</h2>
                            <p>Address: 123 Library Street, City, Country</p>
                            <p>Email: info@example.com</p>
                            <p>Phone: +1 123 456 7890</p>
                        </div>

                        <div class="opening-hours">
                            <h2>Opening Hours</h2>
                            <p>Monday - Friday: 9:00 AM to 6:00 PM</p>
                            <p>Saturday: 9:00 AM to 1:00 PM</p>
                            <p>Sunday: Closed</p>
                        </div>

                        <div class="location">
                            <h2>Location</h2>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27063.7074088578!2d35.89014530181883!3d32.0161043875039!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151c9f765ba05b27%3A0x5a5ba049c504b635!2z2KfZhNis2KfZhdi52Kkg2KfZhNij2LHYr9mG2YrYqQ!5e0!3m2!1sar!2sjo!4v1688847834364!5m2!1sar!2sjo" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom styling for the About Us page */
        .divider {
            border-top: 2px solid #f8f9fa;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .mission,
        .history,
        .staff,
        .contact,
        .opening-hours,
        .location {
            margin-bottom: 2rem;
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        p {
            line-height: 1.6;
        }

        .location iframe {
            height: 300px;
        }
    </style>
@endsection

@extends('layouts.master')

@section('content')
    <div class="row g-0" style="background-color: #f4623a; height: 70px;"></div>

    <div class="container-fluid px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-10 text-center mt-4">
                <h1 class="mt-0">About Us</h1>
                <hr class="divider" />

                <div class="row">
                    <div class="col-md-6">
                        <div class="mission">
                            <h2>Our Mission</h2>
                            <p>The mission of our university library is to create a dynamic learning environment that supports the academic pursuits of our community. We provide resources, services, and technologies to facilitate access to knowledge and promote information literacy. Our goal is to inspire a love for learning, foster intellectual curiosity, and encourage collaboration and exploration. We stay current with emerging trends in academia and continually expand our collection to enhance research and learning experiences. Through our dedicated staff and extensive resources, we aim to empower individuals, contribute to academic excellence, and promote lifelong learning within our university community. Join us on a journey of knowledge exploration and unlock your full potential at our university library.
                            </p>
                        </div>

                        <div class="staff">
                            <h2>Our Staff</h2>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="staff-member">
                                        <h4>John Doe</h4>
                                        <p>Librarian</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="staff-member">
                                        <h4>Jane Smith</h4>
                                        <p>Assistant Librarian</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="staff-member">
                                        <h4>Michael Johnson</h4>
                                        <p>Archivist</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="history">
                            <h2>Our History</h2>
                            <p>Established in 2000, our university library has been an integral part of the academic community for several decades. Since its inception, the library has grown and evolved, adapting to the changing needs of students, faculty, and researchers. Throughout the years, we have continuously expanded our collection, embracing new technologies and resources to enhance the learning experience. Our commitment to providing exceptional services and fostering a supportive environment has allowed us to establish a rich history of empowering knowledge, research, and intellectual growth.</p>
                        </div>

                        <div class="opening-hours">
                            <h2>Opening Hours</h2>
                            <p>Monday - Friday: 9:00 AM to 6:00 PM</p>
                            <p>Saturday: 9:00 AM to 1:00 PM</p>
                            <p>Sunday: Closed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom styling for the About Us page */
        /* .divider {
            border-top: 2px solid #f8f9fa;
            margin-top: 2rem;
            margin-bottom: 2rem;
        } */

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

        .staff {
            margin-bottom: 2rem;
        }

        .staff h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .staff .row {
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .staff-member {
            text-align: center;
            margin-bottom: 2rem;
        }

        .staff-member h4 {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .staff-member p {
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
@endsection

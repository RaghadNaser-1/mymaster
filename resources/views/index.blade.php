@extends('layouts.master')
@section('content')

<style>
    .alert-bottom {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
    }
</style>
        <!-- Masthead-->
        @if(session('welcome_message'))
    <div class="alert alert-success alert-bottom alert-dismissible fade show" role="alert">
        {{ session('welcome_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="clearWelcomeMessage()"></button>
    </div>
@endif


        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Discover a World of Knowledge at Your Fingertips</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">Explore our vast collection of books, textbooks, and resources, available for borrowing and learning. Unlock the doors to endless learning possibilities.</p>
                        <a class="btn btn-primary btn-xl" href="#about">Find Out More</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">We've got what you need!</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">At our library, we are passionate about empowering learners and fostering a love for knowledge. With a strong commitment to education, we strive to provide a seamless and enriching experience for students, researchers, and book enthusiasts alike. Our library system is meticulously curated to offer a diverse collection of books, textbooks, and digital resources that cater to various academic disciplines and personal interests. Whether you're a student seeking affordable textbook rentals or an avid reader in search of captivating stories, our platform is designed to meet your needs. We are dedicated to promoting accessibility, affordability, and the joy of learning through our user-friendly interface, convenient rental options, and a welcoming community of learners. Join us on this educational journey as we pave the way for a brighter future through the power of knowledge.</p>
                        <a class="btn btn-light btn-xl" href="#services">Get Started!</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0">Our Services</h2>
                        <hr class="divider" />
                        <p class="mb-4">Discover the range of services we offer to enhance your learning experience:</p>
                        <ul class="list-unstyled">
                            <li>Book borrowing and renewal</li>
                            <li>Online book reservations</li>
                            <li>Digital resources and databases</li>
                            <li>Research assistance</li>
                            <!-- Add more services as needed -->
                        </ul>
                        <a class="btn btn-primary btn-xl" href="#contact">Contact Us</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-section bg-light" id="events">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0">Upcoming Events</h2>
                        <hr class="divider" />
                        <p class="mb-4">Stay updated with our upcoming events and workshops:</p>
                        <ul class="list-unstyled">
                            <li>Author talks and book signings</li>
                            <li>Reading clubs and discussion groups</li>
                            <li>Workshops and seminars</li>
                            <!-- Add more events as needed -->
                        </ul>
                        <a class="btn btn-primary btn-xl" href="#newsletter">Subscribe to Newsletter</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-section" id="resources">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0">Digital Resources</h2>
                        <hr class="divider" />
                        <p class="mb-4">Access a wealth of digital resources and databases:</p>
                        <ul class="list-unstyled">
                            <li>E-books and e-journals</li>
                            <li>Research databases</li>
                            <li>Online learning platforms</li>
                            <!-- Add more resources as needed -->
                        </ul>
                        <a class="btn btn-primary btn-xl" href="#catalog">Explore Catalog</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-section" id="featured-books">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0">Featured Books</h2>
                        <hr class="divider" />
                        <p class="mb-4">Check out some of our handpicked featured books:</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="path/to/book1.jpg" class="card-img-top" alt="Book 1">
                                    <div class="card-body">
                                        <h5 class="card-title">Book 1</h5>
                                        <p class="card-text">Short description or summary of the book.</p>
                                        <a href="#" class="btn btn-primary">Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="path/to/book2.jpg" class="card-img-top" alt="Book 2">
                                    <div class="card-body">
                                        <h5 class="card-title">Book 2</h5>
                                        <p class="card-text">Short description or summary of the book.</p>
                                        <a href="#" class="btn btn-primary">Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="path/to/book3.jpg" class="card-img-top" alt="Book 3">
                                    <div class="card-body">
                                        <h5 class="card-title">Book 3</h5>
                                        <p class="card-text">Short description or summary of the book.</p>
                                        <a href="#" class="btn btn-primary">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-primary btn-xl" href="{{ route('books.index') }}">View All Books</a>
                    </div>
                </div>
            </div>
        </section>

        <script>
            function clearWelcomeMessage() {
                // Make an AJAX request to clear the session
                fetch('/clear-welcome-message', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Optional: Handle the response if needed
                })
                .catch(error => {
                    console.error('An error occurred:', error); // Optional: Handle errors
                });
            }
        </script>

        @endsection

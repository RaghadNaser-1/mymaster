@extends('layouts.master')
@section('content')

<style>
    .alert-bottom {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
    }
    .featured-book-card {
    height: 500px; /* Set the desired height for the card */
}

.featured-book-image {
    height: 380px; /* Set the desired height for the book image */
    object-fit: cover;
}

@media (max-width: 767px) {
    .featured-book-card {
        height: auto; /* Reset the height for smaller screens */
    }
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
            <div class="col-lg-8">
                <h1 class="text-white font-weight-bold mb-4">Discover a World of Knowledge at Your Fingertips</h1>
                <hr class="divider" />
                <p class="text-white-75 mb-5">Explore our vast collection of books, textbooks, and resources, available for borrowing and learning. Unlock the doors to endless learning possibilities.</p>
                {{-- <a class="btn btn-primary btn-xl" href="#about">Find Out More</a> --}}
                <form class="form-inline" action="{{ route('books.index') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control form-control-lg" type="search" placeholder="Search" aria-label="Search" name="search">
                        <select class="form-select form-select-lg" name="category">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-light" type="submit">Search</button>
                    </div>
                </form>
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

        <!-- Our Services -->
<section class="page-section" id="services">
    <div class="container px-4 px-lg-5">
        <div class="text-center">
            <h2 class="section-heading">Our Services</h2>
            <hr class="divider" />
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-book fa-4x mb-4"></i>
                    {{-- <i class="fa-light fa-books"></i> --}}
                    <h3 class="mb-3">Vast Book Collection</h3>
                    <p class="text-muted">Explore our extensive collection of books, covering various genres, subjects, and disciplines.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-search fa-4x mb-4"></i>
                    <h3 class="mb-3">Advanced Search</h3>
                    <p class="text-muted">Efficiently find the books you need using our powerful search functionality and filtering options.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-clock fa-4x mb-4"></i>
                    <h3 class="mb-3">Extended Borrowing</h3>
                    <p class="text-muted">Enjoy longer borrowing periods, allowing you to delve deeper into your chosen topics without time constraints.</p>
                </div>
            </div>
        </div>
    </div>
</section>


        <!-- Upcoming Events -->
        <section class="page-section bg-light" id="events">
            <div class="container px-4 px-lg-5">
                <div class="text-center">
                    <h2 class="section-heading">Upcoming Events</h2>
                    <hr class="divider" />
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <img src="https://www.deonmeyer.com/images/sign.jpg" class="card-img-top" alt="Event 1" height="200">
                            <div class="card-body">
                                <h5 class="card-title">Author Talk and Book Signing</h5>
                                <p class="card-text">Meet acclaimed author John Doe as he discusses his new novel and shares insights into his writing process. Get your copy signed and engage in a Q&A session with the author.</p>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal1">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <img src="https://www.gosnells.wa.gov.au/sites/default/files/styles/banner/public/seamless/book_club_3.jpg?itok=6yr9guk9" class="card-img-top" alt="Event 2" height="200">
                            <div class="card-body">
                                <h5 class="card-title">Book Club Discussion</h5>
                                <p class="card-text">Join us for an engaging book club discussion on the latest bestseller. Share your thoughts, exchange ideas, and connect with fellow book enthusiasts.</p>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal2">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Modals -->
            <div class="modal fade" id="eventModal1" tabindex="-1" aria-labelledby="eventModal1Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eventModal1Label">Author Talk and Book Signing</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Date: August 3, 2023</li>
                                <li class="list-group-item">Time: 7:00 PM - 9:00 PM</li>
                                <li class="list-group-item">Location: Main Library Auditorium</li>

                              </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="eventModal2" tabindex="-1" aria-labelledby="eventModal2Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eventModal2Label">Book Club Discussion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Date: July 15, 2023</li>
                                <li class="list-group-item">Time: 6:00 PM - 8:00 PM</li>
                                <li class="list-group-item">Location: Library Meeting Room</li>

                              </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
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
                        <p class="mb-4">Check out some of our featured books.</p>
                        <div class="row">
                            <!-- Generate book cards dynamically -->
                            @foreach($featuredBooks as $book)
                                <div class="col-md-4 mb-4">
                                    <div class="card featured-book-card">
                                        <img src="{{ $book->image }}" class="card-img-top featured-book-image" alt="{{ $book->title }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $book->title }}</h5>
                                            <p class="card-text">
                                                @if ($book->authors->isNotEmpty())
                                                <a href="{{ route('author.show', $book->authors->first()->id) }}">{{ $book->authors->first()->name }}</a>
                                            @else
                                                No Author
                                            @endif
                                                                                        </p>
                                                                                    </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="btn btn-primary btn-xl" href="{{ route('books.index') }}">View All Books</a>

                    </div>
                </div>
            </div>
        </section>


        <section class="page-section bg-light" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0">Contact Us</h2>
                        <hr class="divider" />
                        <p class="mb-4">Have any questions or inquiries? Feel free to get in touch with us.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fas fa-map-marker-alt fa-2x"></i>
                                <p>123 Library Street, City, Country</p>
                            </div>
                            <div class="col-md-6">
                                <i class="fas fa-envelope fa-2x"></i>
                                <p><a href="mailto:info@example.com">info@example.com</a></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <i class="fas fa-phone fa-2x"></i>
                                <p>+123 456 789</p>
                            </div>
                        </div>
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

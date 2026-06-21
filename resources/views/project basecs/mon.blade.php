<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare</title>
    <link rel="stylesheet" href="{{ asset('project/mon/home.css') }}">
    <link rel="stylesheet" href="{{ asset('project/mon/css/all.css') }}">
</head>

<body>
    <nav class="navbar">
        <div class="container nav-content">

            <div class="logo">
                <div class="logo-box">
                    <img src="{{ asset('project/mon/logo.png') }}" alt="MediCare Logo">
                </div>
                <span>MediCare</span>
            </div>


            <ul class="nav-links">
                <li><a href="index.html" class="active">Home</a></li>
                <li><a href="about.html">About</a></li> <li><a href="Services.html">Services</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="doctors.html">Doctors</a></li>
            </ul>

            <a href="login" class="user-profile">
                <span>Sign In / Login</span>
            </a>

        </div>
    </nav>

    <section class="hero-start">
        <div class="hero-container">
            <div class="hero-text">
                <p class="trusted-tag">Trusted by 10,000+ patients</p>
                <h1>Your Health is Our <br><span class="highlight">Top Priority</span></h1>
                <p class="description">
                    Experience World-class healthcare with our team of expert doctors. Book appointments, access medical
                    records, and manage your health journey seamlessly.
                </p>
                <div class="hero-btns">
                    <button class="btn-book">Book Appointment &rarr;</button>
                    <button class="btn-video">Watch Video</button>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('project/mon/images/home.png') }}" alt="Doctor">
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="stat-item">
            <h3>50+</h3>
            <p>Expert Doctors</p>
        </div>
        <div class="stat-item">
            <h3>10K+</h3>
            <p>Happy Patients</p>
        </div>
        <div class="stat-item">
            <h3>15+</h3>
            <p>Years Experience</p>
        </div>
        <div class="stat-item">
            <h3>24/7</h3>
            <p>Emergency Care</p>
        </div>
    </section>

    <section class="services">
        <h2>Featured Services</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>

        <div class="cards">
            <div class="card">
                <div class="card-image">
                    <img src="{{ asset('project/mon/images/cardiology.jpg') }}" alt="Cardiology">
                </div>
                <div class="card-content">
                    <h4>Cardiology Excellence</h4>
                    <p>Lorem ipsum dolor sit amet. Consectetur adipiscing elit Vestibulum ante ipsum primis in faucibus
                        luctus et ultrices posuere cubilia curae.</p>
                    <a href="#" class="learn-more">Learn More <span class="arrow">&rarr;</span></a>
                </div>
            </div>

            <div class="card">
                <div class="card-image">
                    <img src="{{ asset('project/mon/images/neurology.jpg') }}" alt="Neurology">
                </div>
                <div class="card-content">
                    <h4>Neurology Care</h4>
                    <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation ullamco laboris nisi.</p>
                    <a href="#" class="learn-more">Learn More <span class="arrow">&rarr;</span></a>
                </div>
            </div>

            <div class="card">
                <div class="card-image">
                    <img src="{{ asset('project/mon/images/orthopedic.jpg') }}" alt="Orthopedic">
                </div>
                <div class="card-content">
                    <h4>Orthopedic Surgery</h4>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                    <a href="#" class="learn-more">Learn More <span class="arrow">&rarr;</span></a>
                </div>
            </div>

            <div class="card">
                <div class="card-image">
                    <img src="{{ asset('project/mon/images/pediatric.jpg') }}" alt="Pediatric">
                </div>
                <div class="card-content">
                    <h4>Pediatric Care</h4>
                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum Sed ut perspiciatis unde omnis iste
                        natus error sit voluptatem accusantium.</p>
                    <a href="#" class="learn-more">Learn More <span class="arrow">&rarr;</span></a>
                </div>
            </div>

            <div class="card">
                <div class="card-image">
                    <img src="{{ asset('project/mon/images/oncology.jpg') }}" alt="Oncology">
                </div>
                <div class="card-content">
                    <h4>Oncology Treatment</h4>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corrupti quos dolores et quas molestias.</p>
                    <a href="#" class="learn-more">Learn More <span class="arrow">&rarr;</span></a>
                </div>
            </div>

            <div class="card">
                <div class="card-image">
                    <img src="{{ asset('project/mon/images/laboratory.jpg') }}" alt="Laboratory">
                </div>
                <div class="card-content">
                    <h4>Laboratory Services</h4>
                    <p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et
                        voluptates repudiandae sint et molestiae non recusandae.</p>
                    <a href="#" class="learn-more">Learn More <span class="arrow">&rarr;</span></a>
                </div>
            </div>
        </div>
    </section>

    <section class="why-choose-us">
        <div class="why-container">
            <div class="why-content">
                <span class="sup-why">WHY CHOOSE US</span>
                <h2 class="main-title">Delivering Excellence in Healthcare</h2>
                <p class="description">Combine cutting-edge technology with compassionate care to provide you with the
                    best possible healthcare experience.</p>

                <div class="features-list">
                    <div class="features-item">
                        <div class="features-icon">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <div class="features-text">
                            <h4>Expert Medical Team</h4>
                            <p>Board-certified specialists with years of experience</p>
                        </div>
                    </div>

                    <div class="features-item">
                        <div class="features-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="features-text">
                            <h4>24/7 Availability</h4>
                            <p>Round-the-clock emergency service and support</p>
                        </div>
                    </div>

                    <div class="features-item">
                        <div class="features-icon">
                            <i class="fa-solid fa-microchip"></i>
                        </div>
                        <div class="features-text">
                            <h4>Advanced Technology</h4>
                            <p>State-of-the-art diagnostic and treatment equipment</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="why-image">
                <img src="{{ asset('project/mon/images/why-choose-us.jpg') }}" alt="Why Choose Us">
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials-section">
        <div class="testimonials-container">
            <div class="testimonials-header">
                <span class="badge">Testimonials</span>
                <h2>What Our Patients Say</h2>
                <p>Real stories from real patients who trust us with their healthcare</p>
            </div>

            <div class="testimonials-cards">
                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="testimonial-text">"The care I received was exceptional. The doctors took time to explain
                        everything and made me feel comfortable throughout my treatment."</p>
                    <div class="patient-info">
                        <img src="{{ asset('project/mon/images/person1.jpg') }}" alt="Sarah Johnson">
                        <div class="patient-details">
                            <h4>Sarah Johnson</h4>
                            <span>Patient</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Booking appointments is so easy with their online system. No more long
                        waits on the phone. Highly recommend MediCare to everyone."</p>
                    <div class="patient-info">
                        <img src="{{ asset('project/mon/images/person2.jpg') }}" alt="Michael Chen">
                        <div class="patient-details">
                            <h4>Michael Chen</h4>
                            <span>Patient</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="testimonial-text">"The staff is incredibly friendly and professional. They care about
                        their patients and it shows in everything they do."</p>
                    <div class="patient-info">
                        <img src="{{ asset('project/mon/images/person3.jpg') }}" alt="Emily Davis">
                        <div class="patient-details">
                            <h4>Emily Davis</h4>
                            <span>Patient</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="get-started">
        <div class="cta-box">
            <h2>Ready to Get Started?</h2>
            <p>Book your appointment today and experience the difference of quality healthcare</p>
            <div class="cta-btns">
                <a href="#" class="btn-white">Book Appointment &rarr;</a>
                <a href="#" class="btn-outline">Watch Video</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <h2 class="logo">MediCare</h2>
                <p>Providing quality healthcare services with compassion and excellence since 2008.</p>
            </div>

            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Services</h4>
                <ul>
                    <li><a href="#">Cardiology</a></li>
                    <li><a href="#">Neurology</a></li>
                    <li><a href="#">Pediatrics</a></li>
                    <li><a href="#">Orthopedics</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact Info</h4>
                <p>123 Medical Center Dr, City</p>
                <p>+1 (555) 123-4567</p>
                <p>info@medicare.com</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 MediCare. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
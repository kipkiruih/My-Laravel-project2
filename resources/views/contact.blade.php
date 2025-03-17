@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Page Title -->
    <div class="text-center" data-aos="fade-down">
        <h1 class="fw-bold text-primary">Contact Us</h1>
        <p class="text-muted">We'd love to hear from you! Reach out to us for any inquiries.</p>
    </div>

    <!-- Contact Information -->
    <div class="row mt-5">
        <div class="col-md-6" data-aos="fade-right">
            <h2 class="text-dark">Get in Touch</h2>
            <p class="text-secondary">Have questions about buying, selling, or renting properties? Our team is here to help.</p>

            <div class="d-flex align-items-center mt-3">
                <i class="fas fa-map-marker-alt fa-2x text-danger"></i>
                <p class="ms-3 text-secondary">123 Bingwa Street, Nairobi, Kenya</p>
            </div>
            <div class="d-flex align-items-center mt-3">
                <i class="fas fa-phone fa-2x text-success"></i>
                <p class="ms-3 text-secondary">+254 712 345 678</p>
            </div>
            <div class="d-flex align-items-center mt-3">
                <i class="fas fa-envelope fa-2x text-primary"></i>
                <p class="ms-3 text-secondary">info@bingwahomes.com</p>
            </div>

            <!-- Social Media -->
            <div class="mt-4">
                <a href="#" class="social-icon"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter fa-2x"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram fa-2x"></i></a>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-md-6" data-aos="fade-left">
            <div class="card shadow-lg p-4">
                <h3 class="text-dark mb-4">Send Us a Message</h3>

                <!-- Success Message Alert -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-dark">Full Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark">Email Address</label>
                        <input type="email" name="email" class="form-control" required placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark">Message</label>
                        <textarea name="message" class="form-control" rows="4" required placeholder="Write your message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 btn-hover">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edica :: Home</title>
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/all.min.css">
    <link href="assets/vendors/aos/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="assets/js/loader.js"></script>
</head>
<body>
    <div class="edica-loader"></div>
    <header class="edica-header edica-landing-header">
        <div class="container-fluid">
            <!-- Navbar dengan posisi absolute -->
            <nav class="navbar navbar-expand-lg navbar-light" style="position: absolute; top: 0; left: 0; width: 100%; z-index: 2;">
                <a class="navbar-brand" href="index.html" style="margin-left: 20px;">
                    <h2 style="display: flex; align-items: center; color: white; font-family: 'Poppins', sans-serif; font-weight: 600;">
                        <img src="assets/images/logo-smk.png" alt="SMKN 4 Bogor" style="max-width: 50px; height: 50px; margin-right: 15px;">
                        SMKN 4 KOTA BOGOR
                    </h2>
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#edicaMainNav" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="edicaMainNav">
                    <ul class="navbar-nav mt-2 mt-lg-0" style="margin-right: 50px;">
                        <li class="nav-item">
                            <a href="{{ route('sign-in') }}" class="nav-link btn btn-outline-primary font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" style="padding: 5px 15px; border-radius: 20px;">
                                Login
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Slider dengan gambar yang full-height -->
            <div class="carousel-img-wrapper" style="height: 100vh; background-image: url('assets/images/Slider_11.jpg'); background-size: cover; background-position: center;">
            </div>
        </div>
    </header>


    <main>
        <section class="edica-landing-section edica-landing-about">
            <div class="container">
                <div class="row">
                    <div class="col-md-6" data-aos="fade-up-left">
                        <img src="assets/images/Slider_5.jpg" width="468px" alt="about" class="img-fluid">
                    </div>
                    <div class="col-md-6" data-aos="fade-up-right">
                        <h4 class="edica-landing-section-subtitle-alt">Galery Kegiatan Sekolah</h4>
                        <h2 class="edica-landing-section-title">Judul</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisl tincidunt eget nullam non. Quis hendrerit dolor magna eget est lorem ipsum dolor sit. Volutpat odio facilisis mauris sit amet massa. Commodo odio aenean sed adipiscing diam donec adipiscing tristique. Mi eget mauris pharetra et. Non tellus orci ac auctor augue. </p>
                        {{-- <ul class="landing-about-list">
                            <li>Powerful and flexible theme</li>
                            <li>Simple, transparent pricing</li>
                            <li>Build tools and full documention</li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </section>
        <section class="edica-landing-section edica-landing-about">
            <div class="container">
                <div class="row">
                    <div class="col-md-6" data-aos="fade-up-right">
                        {{-- <h4 class="edica-landing-section-subtitle-alt">Galery Kegiatan Sekolah</h4> --}}
                        <h2 class="edica-landing-section-title">Judul Agenda Sekolah</h2>
                        <ul class="landing-about-list">
                            <li>Upacara Bendera setiap Senin</li>
                            <li>Pentas Seni Tahunan - 25 Oktober 2024</li>
                            <li>Lomba Olahraga Antar Kelas - 10 November 2024</li>
                            <li>Ujian Akhir Semester Ganjil - 1 Desember 2024</li>
                            <li>Kegiatan Pramuka Kemah Bakti - 15 Desember 2024</li>
                            <li>Penerimaan Rapor Semester Ganjil - 22 Desember 2024</li>
                            <li>Lomba Olahraga Antar Kelas - 10 November 2024</li>
                            <li>Ujian Akhir Semester Ganjil - 1 Desember 2024</li>
                        </ul>
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-center" data-aos="fade-up-left" style="text-align: center; justify-content: center;">
                        <h2 class="edica-landing-section-title">Informasi Terkini</h2>
                        <h4 class="edica-landing-section-subtitle" data-aos="fade-up">Prestasi Juara 1 Lomba Kompetensi</h4>
                        <img src="assets/images/Slider_6.jpg" width="300px" alt="about" class="img-fluid">
                        <p class="edica-landing-section-description" data-aos="fade-up">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elit at imperdiet dui accumsan sit. Ornare arcu dui vivamus arcu felis.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="edica-landing-section edica-landing-blog">
            <div class="container">
            <h2 class="edica-landing-section-title" data-aos="fade-up" style="text-align: center; justify-content: center;">Trending</h2>
                <div class="row">
                    <div class="col-md-4 landing-blog-post" data-aos="fade-right">
                        <img src="assets/images/Slider_8.jpg" alt="blog post" class="blog-post-thumbnail">
                        <p class="blog-post-category">Post 1</p>
                    </div>
                    <div class="col-md-4 landing-blog-post" data-aos="fade-up">
                        <img src="assets/images/Slider_9.jpg" alt="blog post" class="blog-post-thumbnail">
                        <p class="blog-post-category">Post 2</p>
                    </div>
                    <div class="col-md-4 landing-blog-post" data-aos="fade-left">
                        <img src="assets/images/Slider_10.jpg" alt="blog post" class="blog-post-thumbnail">
                        <p class="blog-post-category">Post 3</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="edica-footer" data-aos="fade-up">
        <div class="container">
            <div class="row footer-widget-area">
                <!-- Bagian Teks Footer -->
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="index.html" class="footer-brand-wrapper">
                                <img src="assets/images/logo.svg" alt="edica logo">
                            </a>
                            <p class="contact-details">hello@edica.com</p>
                            <p class="contact-details">+23 3000 000 00</p>
                            <nav class="footer-social-links">
                                <a href="#!"><i class="fab fa-facebook-f"></i></a>
                                <a href="#!"><i class="fab fa-twitter"></i></a>
                                <a href="#!"><i class="fab fa-behance"></i></a>
                                <a href="#!"><i class="fab fa-dribbble"></i></a>
                            </nav>
                        </div>
                        <div class="col-md-6">
                            <nav class="footer-nav">
                                <a href="#!" class="nav-link">Privacy & Policy</a>
                                <a href="#!" class="nav-link">Terms</a>
                                <a href="#!" class="nav-link">Site Map</a>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Bagian Peta Sekolah -->
                <div class="col-md-6">
                    <h4 class="footer-section-title">Peta Sekolah</h4>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.1620025994133!2d106.8246939!3d-6.6407334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sen!2sid!4v1697102536400!5m2!1sen!2sid"
                        width="600"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>
    </footer>
    <script src="assets/vendors/popper.js/popper.min.js"></script>
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/vendors/aos/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        AOS.init({
            duration: 2000
        });
      </script>
</body>
</html>
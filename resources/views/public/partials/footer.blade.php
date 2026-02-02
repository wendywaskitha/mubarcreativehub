<!-- Footer -->
<footer class="bg-primary-gradient text-white pt-5 pb-4 mt-auto">
    <div class="container">
        <div class="row g-4 mb-4">
            <!-- About Section -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h5 class="fw-bold mb-3 position-relative pb-2">
                        {{ $settings['site_title'] ?? 'Mubar Creative Hub' }}
                        <span class="position-absolute bottom-0 start-0"
                              style="width: 50px; height: 3px; background: white; border-radius: 2px;"></span>
                    </h5>
                    <p class="mb-3 opacity-90" style="line-height: 1.8;">
                        {{ $settings['site_description'] ?? 'Platform digital untuk mempromosikan dan mengembangkan ekonomi kreatif serta UMKM di Kabupaten Muna Barat.' }}
                    </p>
                    <div class="d-flex align-items-center p-3 rounded"
                         style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);">
                        <i class="fas fa-award fa-2x me-3 opacity-75"></i>
                        <div>
                            <small class="d-block opacity-75">Didukung oleh</small>
                            <strong>Pemkab Muna Barat</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <div class="footer-section">
                    <h5 class="fw-bold mb-3 position-relative pb-2">
                        Menu Cepat
                        <span class="position-absolute bottom-0 start-0"
                              style="width: 50px; height: 3px; background: white; border-radius: 2px;"></span>
                    </h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2">
                            <a href="{{ route('home') }}" class="text-white text-decoration-none d-inline-flex align-items-center">
                                <i class="fas fa-chevron-right me-2" style="font-size: 0.75rem;"></i>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('umkm.index') }}" class="text-white text-decoration-none d-inline-flex align-items-center">
                                <i class="fas fa-chevron-right me-2" style="font-size: 0.75rem;"></i>
                                <span>Katalog UMKM</span>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('map.index') }}" class="text-white text-decoration-none d-inline-flex align-items-center">
                                <i class="fas fa-chevron-right me-2" style="font-size: 0.75rem;"></i>
                                <span>Peta UMKM</span>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('blog.index') }}" class="text-white text-decoration-none d-inline-flex align-items-center">
                                <i class="fas fa-chevron-right me-2" style="font-size: 0.75rem;"></i>
                                <span>Blog & Artikel</span>
                            </a>
                        </li>
                        {{-- <li class="mb-2">
                            <a href="{{ route('tentang') }}" class="text-white text-decoration-none d-inline-flex align-items-center">
                                <i class="fas fa-chevron-right me-2" style="font-size: 0.75rem;"></i>
                                <span>Tentang Kami</span>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-section">
                    <h5 class="fw-bold mb-3 position-relative pb-2">
                        Kontak Kami
                        <span class="position-absolute bottom-0 start-0"
                              style="width: 50px; height: 3px; background: white; border-radius: 2px;"></span>
                    </h5>
                    <ul class="list-unstyled footer-contact">
                        <li class="mb-3 d-flex align-items-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                 style="width: 36px; height: 36px; background: rgba(255, 255, 255, 0.15);">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <small class="d-block opacity-75 mb-1">Alamat</small>
                                <span>{{ $settings['contact_address'] ?? 'Jl. Poros KM. 5, Buranga, Muna Barat' }}</span>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                 style="width: 36px; height: 36px; background: rgba(255, 255, 255, 0.15);">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <small class="d-block opacity-75 mb-1">Telepon</small>
                                <a href="tel:{{ $settings['contact_phone'] ?? '+6281234567890' }}" class="text-white text-decoration-none">{{ $settings['contact_phone'] ?? '+62 812-3456-7890' }}</a>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                 style="width: 36px; height: 36px; background: rgba(255, 255, 255, 0.15);">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <small class="d-block opacity-75 mb-1">Email</small>
                                <a href="mailto:{{ $settings['contact_email'] ?? 'info@mubarcreativehub.go.id' }}" class="text-white text-decoration-none">{{ $settings['contact_email'] ?? 'info@mubarcreativehub.go.id' }}</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Social Media & Newsletter -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-section">
                    <h5 class="fw-bold mb-3 position-relative pb-2">
                        Ikuti Kami
                        <span class="position-absolute bottom-0 start-0"
                              style="width: 50px; height: 3px; background: white; border-radius: 2px;"></span>
                    </h5>
                    <p class="mb-3 opacity-90 small">Dapatkan update terbaru dari kami</p>
                    <div class="d-flex gap-2 mb-4 flex-wrap">
                        <a href="#"
                           class="social-icon text-white d-flex align-items-center justify-content-center"
                           style="width: 42px; height: 42px; background: rgba(255, 255, 255, 0.15); border-radius: 10px; transition: all 0.3s ease;"
                           onmouseover="this.style.background='rgba(255, 255, 255, 0.25)'; this.style.transform='translateY(-3px)'"
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.15)'; this.style.transform='translateY(0)'">
                            <i class="fab fa-facebook-f fa-lg"></i>
                        </a>
                        <a href="#"
                           class="social-icon text-white d-flex align-items-center justify-content-center"
                           style="width: 42px; height: 42px; background: rgba(255, 255, 255, 0.15); border-radius: 10px; transition: all 0.3s ease;"
                           onmouseover="this.style.background='rgba(255, 255, 255, 0.25)'; this.style.transform='translateY(-3px)'"
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.15)'; this.style.transform='translateY(0)'">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                        <a href="#"
                           class="social-icon text-white d-flex align-items-center justify-content-center"
                           style="width: 42px; height: 42px; background: rgba(255, 255, 255, 0.15); border-radius: 10px; transition: all 0.3s ease;"
                           onmouseover="this.style.background='rgba(255, 255, 255, 0.25)'; this.style.transform='translateY(-3px)'"
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.15)'; this.style.transform='translateY(0)'">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a href="#"
                           class="social-icon text-white d-flex align-items-center justify-content-center"
                           style="width: 42px; height: 42px; background: rgba(255, 255, 255, 0.15); border-radius: 10px; transition: all 0.3s ease;"
                           onmouseover="this.style.background='rgba(255, 255, 255, 0.25)'; this.style.transform='translateY(-3px)'"
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.15)'; this.style.transform='translateY(0)'">
                            <i class="fab fa-youtube fa-lg"></i>
                        </a>
                        <a href="#"
                           class="social-icon text-white d-flex align-items-center justify-content-center"
                           style="width: 42px; height: 42px; background: rgba(255, 255, 255, 0.15); border-radius: 10px; transition: all 0.3s ease;"
                           onmouseover="this.style.background='rgba(255, 255, 255, 0.25)'; this.style.transform='translateY(-3px)'"
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.15)'; this.style.transform='translateY(0)'">
                            <i class="fab fa-tiktok fa-lg"></i>
                        </a>
                    </div>

                    <!-- Quick Subscribe -->
                    <div class="p-3 rounded"
                         style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);">
                        <small class="d-block mb-2 opacity-90">
                            <i class="fas fa-bell me-1"></i>Subscribe Newsletter
                        </small>
                        <form action="#" method="POST" class="d-flex gap-2">
                            <input type="email"
                                   class="form-control form-control-sm"
                                   placeholder="Email..."
                                   style="background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.3); color: white; border-radius: 8px;"
                                   onfocus="this.style.background='rgba(255, 255, 255, 0.3)'"
                                   onblur="this.style.background='rgba(255, 255, 255, 0.2)'">
                            <button type="submit"
                                    class="btn btn-light btn-sm px-3"
                                    style="border-radius: 8px; font-weight: 500;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <hr class="my-4" style="border-color: rgba(255,255,255,0.2); opacity: 0.5;">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="mb-0 opacity-90">
                    <i class="far fa-copyright me-1"></i>{{ date('Y') }} Mubar Creative Hub.
                    <span class="d-none d-md-inline">All rights reserved.</span>
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="d-flex justify-content-center justify-content-md-end gap-3 flex-wrap">
                    <a href="#" class="text-white text-decoration-none opacity-90 small hover-link">Syarat & Ketentuan</a>
                    <span class="opacity-50">|</span>
                    <a href="#" class="text-white text-decoration-none opacity-90 small hover-link">Kebijakan Privasi</a>
                    <span class="opacity-50">|</span>
                    <a href="#" class="text-white text-decoration-none opacity-90 small hover-link">Sitemap</a>
                </div>
            </div>
        </div>

        <!-- Back to Top Button -->
        <button id="backToTop"
                class="btn btn-light position-fixed d-none"
                style="bottom: 90px; right: 20px; width: 45px; height: 45px; border-radius: 12px; z-index: 999; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>
</footer>

<!-- Floating Action Buttons -->
<div class="floating-actions">
    <!-- WhatsApp Button -->
    <a href="https://wa.me/{{ preg_replace('/^(\+?62)/', '62', str_replace([' ', '-', '(', ')'], '', $settings['contact_phone'] ?? '6281234567890')) }}?text=Halo%20Mubar%20Creative%20Hub,%20saya%20ingin%20bertanya"
       target="_blank"
       class="floating-btn floating-whatsapp"
       data-tooltip="Chat WhatsApp">
        <i class="fab fa-whatsapp"></i>
        <span class="pulse-ring"></span>
    </a>

    <!-- Telegram Button (Optional) -->
    <!-- <a href="#"
       target="_blank"
       class="floating-btn floating-telegram"
       data-tooltip="Chat Telegram"
       style="bottom: 160px;">
        <i class="fab fa-telegram"></i>
    </a> -->
</div>

<style>
/* Footer Styling */
footer {
    position: relative;
    overflow: hidden;
}

footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.05)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
    background-size: cover;
    background-position: bottom;
    opacity: 0.5;
}

.footer-section {
    position: relative;
    z-index: 1;
}

/* Footer Links Animation */
.footer-links a {
    transition: all 0.3s ease;
    opacity: 0.9;
}

.footer-links a:hover {
    opacity: 1;
    padding-left: 8px;
}

.footer-links a i {
    transition: transform 0.3s ease;
}

.footer-links a:hover i {
    transform: translateX(3px);
}

/* Footer Contact */
.footer-contact a:hover {
    text-decoration: underline !important;
}

/* Hover Link */
.hover-link {
    transition: all 0.3s ease;
}

.hover-link:hover {
    opacity: 1 !important;
    text-decoration: underline !important;
}

/* Newsletter Input */
footer input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

/* Back to Top Button */
#backToTop {
    transition: all 0.3s ease;
    animation: fadeInUp 0.5s ease;
}

#backToTop:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.2);
}

/* Floating Actions Container */
.floating-actions {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Floating Button Base */
.floating-btn {
    position: relative;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    animation: fadeInUp 0.5s ease;
    text-decoration: none;
    color: white;
}

.floating-btn::before {
    content: attr(data-tooltip);
    position: absolute;
    right: 70px;
    background: rgba(0, 0, 0, 0.85);
    color: white;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s ease;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}

.floating-btn:hover::before {
    opacity: 1;
    right: 75px;
}

/* WhatsApp Button */
.floating-whatsapp {
    background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
}

.floating-whatsapp:hover {
    transform: scale(1.15) rotate(5deg);
    box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
}

/* Telegram Button */
.floating-telegram {
    background: linear-gradient(135deg, #0088cc 0%, #006699 100%);
}

.floating-telegram:hover {
    transform: scale(1.15) rotate(5deg);
    box-shadow: 0 8px 25px rgba(0, 136, 204, 0.4);
}

/* Pulse Ring Animation */
.pulse-ring {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: rgba(37, 211, 102, 0.4);
    animation: pulse 2s ease-out infinite;
    z-index: -1;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

/* Fade In Up Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .floating-actions {
        bottom: 15px;
        right: 15px;
    }

    .floating-btn {
        width: 55px;
        height: 55px;
        font-size: 24px;
    }

    .floating-btn::before {
        display: none;
    }

    #backToTop {
        bottom: 80px !important;
        right: 15px !important;
        width: 40px !important;
        height: 40px !important;
    }
}

/* Social Icons Enhancement */
.social-icon {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Smooth Scroll */
html {
    scroll-behavior: smooth;
}
</style>

<script>
// Back to Top Button
document.addEventListener('DOMContentLoaded', function() {
    const backToTopBtn = document.getElementById('backToTop');

    if (backToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.remove('d-none');
            } else {
                backToTopBtn.classList.add('d-none');
            }
        });

        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});

// Add smooth scroll for all anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && document.querySelector(href)) {
            e.preventDefault();
            document.querySelector(href).scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
</script>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Anjay</title>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .font-syne { font-family: 'Syne', sans-serif; }

        .shadow-luxury {
            box-shadow: 0 25px 50px -12px rgba(74, 52, 40, 0.2);
        }

        .bg-gradient-gold {
            background: linear-gradient(135deg, #D9B382 0%, #B89366 100%);
        }

     
        @media (max-width: 768px) {
            .floating-card-mobile {
                left: 50%;
                transform: translateX(-50%);
                bottom: -20px;
                width: 90%;
                position: absolute;
            }
        }

     
        .faq-answer {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .faq-header:hover {
            border-color: #D9B382;
            background: #FDFBF9;
        }


        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px -15px rgba(74, 52, 40, 0.25);
        }


        .carousel-track {
            will-change: transform;
        }
        
        /* Hide scrollbar */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="overflow-x-hidden">

<section class="py-16 md:py-32 bg-white px-4 font-poppins overflow-hidden">
    <div class="container mx-auto flex flex-col lg:flex-row items-center justify-center gap-16 lg:gap-24 max-w-6xl">
        <div class="relative w-full max-w-[340px] md:max-w-md shrink-0 group" data-aos="fade-right">
            <div class="absolute -top-6 -left-6 w-32 h-32 bg-[#D9B382]/10 rounded-full blur-3xl"></div>
            
            <div class="relative shadow-luxury rounded-[2.5rem] md:rounded-[3.5rem] overflow-hidden border-[8px] border-white">
                <img class="w-full h-[420px] md:h-[550px] object-cover transform group-hover:scale-110 transition-transform duration-1000"
                    src="https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=600&auto=format&fit=crop"
                    alt="Anjay Collection">
                <div class="absolute inset-0 bg-gradient-to-t from-[#2D1B14]/50 to-transparent"></div>
            </div>

            <div class="floating-card-mobile md:absolute flex items-center gap-4 bg-white p-5 rounded-3xl shadow-2xl border border-[#D9B382]/15 md:-right-12 md:bottom-12 z-20">
                <div class="flex -space-x-3 shrink-0">
                    <img src="https://ui-avatars.com/api/?name=A+S&background=4A3428&color=D9B382" class="size-10 rounded-full border-2 border-white">
                    <img src="https://ui-avatars.com/api/?name=J+K&background=D9B382&color=4A3428" class="size-10 rounded-full border-2 border-white">
                    <div class="flex items-center justify-center text-[10px] font-bold text-white size-10 rounded-full border-2 border-white bg-[#D9B382]">12K+</div>
                </div>
                <p class="text-[11px] font-bold leading-tight text-[#4A3428] uppercase tracking-wider">Telah Bergabung<br><span class="text-[#B89366]">Solid Circle</span></p>
            </div>
        </div>

        <div class="max-w-xl text-center lg:text-left mt-8 md:mt-0" data-aos="fade-left">
            <div class="inline-block px-4 py-1.5 rounded-full bg-[#4A3428]/5 border border-[#4A3428]/10 text-[#4A3428] text-[10px] font-bold tracking-[.3em] uppercase mb-6">
                Gerakan Kami
            </div>
            <h2 class="text-[#4A3428] text-4xl md:text-5xl font-black tracking-tighter">
                Apa Yang <span class="text-[#D9B382]">Sebenarnya</span> Kami Lakukan?
            </h2>
            <div class="w-20 h-1.5 rounded-full bg-gradient-gold mx-auto lg:mx-0 mb-8"></div>
            <div class="space-y-6 text-[#4A3428]/70 text-base md:text-lg font-medium leading-relaxed">
                <p><strong class="text-[#4A3428]">Anjay</strong> bukan sekadar brand, tapi standar baru gaya hidup. Kami mengkurasi fashion yang bikin lo tampil beda dan berkelas.</p>
                <p>Setiap produk dibuat untuk memastikan lo punya <span class="italic text-[#D9B382] font-bold">pride</span> lebih di tongkrongan, dari kualitas bahan hingga detail cuttingan.</p>
            </div>
            <div class="mt-10 flex flex-col sm:flex-row items-center gap-6 justify-center lg:justify-start">
                <a href="/products" class="group w-full sm:w-auto flex items-center justify-center gap-3 bg-[#4A3428] py-5 px-10 rounded-2xl text-white font-bold hover:bg-[#D9B382] hover:text-[#4A3428] transition-all shadow-xl shadow-[#4A3428]/20">
                    <span>LIHAT KOLEKSI</span>
                    <svg class="group-hover:translate-x-2 transition-transform" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
                <div class="flex items-center gap-2">
                    <span class="size-3 rounded-full bg-[#D9B382] animate-pulse"></span>
                    <span class="text-xs font-bold text-[#4A3428]/40 uppercase tracking-widest">Stok Terbatas 2026</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="tentang-kami" class="py-20 md:py-32 bg-[#4A3428] relative overflow-hidden font-poppins">
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#D9B382]/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#B89366]/10 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-6 max-w-6xl relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-block px-4 py-1.5 rounded-full bg-[#D9B382]/20 border border-[#D9B382]/30 text-[#D9B382] text-[10px] font-bold tracking-[.3em] uppercase mb-6">
                Siapa Kami
            </div>
            <h2 class="text-white text-4xl md:text-5xl font-black tracking-tighter mb-6">
                Tentang <span class="text-[#D9B382]">Toko Anjay</span>
            </h2>
            <div class="w-20 h-1.5 rounded-full bg-gradient-gold mx-auto mb-8"></div>
            <p class="text-white/70 text-base md:text-lg max-w-3xl mx-auto leading-relaxed">
                Lahir dari passion untuk fashion berkelas dan kebutuhan akan produk yang <span class="text-[#D9B382] font-bold">autentik</span>, Toko Anjay hadir sebagai solusi bagi lo yang menolak pasaran biasa.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center">
            <div class="space-y-6 text-white/80 text-base md:text-lg leading-relaxed" data-aos="fade-right">
                <p>
                    Sejak <strong class="text-white">2021</strong>, kami fokus menghadirkan koleksi fashion yang nggak cuma mengikuti trend, tapi <span class="text-[#D9B382] italic font-bold">menciptakan standar baru</span> dalam style dan kualitas.
                </p>
                <p>
                    Dari streetwear hingga casual premium, setiap item dikurasi dengan teliti—mulai dari pemilihan material, proses produksi, hingga quality control yang ketat.
                </p>
                <p>
                    <strong class="text-white">12,000+ customer</strong> sudah jadi bagian dari <span class="text-[#D9B382] font-bold">Solid Circle</span>, komunitas eksklusif yang dapet akses first dibs ke koleksi terbaru dan promo khusus.
                </p>
                <div class="flex items-center gap-4 pt-4">
                    <div class="flex-1 h-1 bg-gradient-gold rounded-full"></div>
                    <span class="text-[#D9B382] text-xs font-bold tracking-widest uppercase">Est. 2021</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6" data-aos="fade-left">
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-6 text-center hover:bg-white/10 transition-all">
                    <div class="text-4xl md:text-5xl font-black text-[#D9B382] mb-2 counter" data-target="12000">0</div>
                    <div class="text-white/60 text-sm font-medium uppercase tracking-wider">Happy Customers</div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-6 text-center hover:bg-white/10 transition-all">
                  <div class="text-4xl md:text-5xl font-black text-[#D9B382] mb-2 counter" data-target="500">0</div>
                  <div class="text-white/60 text-sm font-medium uppercase tracking-wider">Produk Terjual</div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-6 text-center hover:bg-white/10 transition-all">
                    <div class="text-4xl md:text-5xl font-black text-[#D9B382] mb-2 counter" data-target="4.9">0</div>
                    <div class="text-white/60 text-sm font-medium uppercase tracking-wider">Rating Bintang</div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-6 text-center hover:bg-white/10 transition-all">
                   <div class="text-4xl md:text-5xl font-black text-[#D9B382] mb-2 counter" data-target="100">0</div>
                   <div class="text-white/60 text-sm font-medium uppercase tracking-wider">Original Design</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 md:py-32 bg-white font-poppins">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-block px-4 py-1.5 rounded-full bg-[#4A3428]/5 border border-[#4A3428]/10 text-[#4A3428] text-[10px] font-bold tracking-[.3em] uppercase mb-6">
                Keunggulan
            </div>
            <h2 class="text-[#4A3428] text-4xl md:text-5xl font-black tracking-tighter mb-6">
                Kenapa Harus <span class="text-[#D9B382]">Pilih Anjay?</span>
            </h2>
            <div class="w-20 h-1.5 rounded-full bg-gradient-gold mx-auto mb-8"></div>
            <p class="text-[#4A3428]/60 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                Bukan cuma janji, ini <span class="font-bold text-[#4A3428]">bukti nyata</span> kenapa ribuan customer memilih Anjay sebagai fashion partner mereka.
            </p>
        </div>

        <div class="relative group-carousel px-2 md:px-0" data-aos="fade-up" data-aos-delay="200">
            
            <button id="prevBtn" class="md:hidden absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white border border-[#4A3428]/10 text-[#4A3428] p-3 rounded-full shadow-lg hover:bg-[#D9B382] hover:text-white transition-all -ml-2">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            <button id="nextBtn" class="md:hidden absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white border border-[#4A3428]/10 text-[#4A3428] p-3 rounded-full shadow-lg hover:bg-[#D9B382] hover:text-white transition-all -mr-2">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>

            <div class="overflow-hidden md:overflow-visible rounded-3xl">
                <div id="featureTrack" class="flex md:grid md:grid-cols-3 gap-8 carousel-track">
                    
                    <div class="feature-card w-full flex-shrink-0 md:w-auto bg-white border-2 border-[#4A3428]/10 rounded-3xl p-8 text-center hover:border-[#D9B382] group">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-gold mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl md:text-2xl font-black text-[#4A3428] mb-4 uppercase tracking-tight">Premium Quality</h3>
                        <p class="text-[#4A3428]/60 text-sm md:text-base leading-relaxed">
                            Bahan pilihan kelas atas dengan jahitan presisi. Setiap produk melalui quality control ketat sebelum sampai ke tangan lo.
                        </p>
                    </div>

                    <div class="feature-card w-full flex-shrink-0 md:w-auto bg-white border-2 border-[#4A3428]/10 rounded-3xl p-8 text-center hover:border-[#D9B382] group">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-gold mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                <line x1="7" y1="7" x2="7.01" y2="7"/>
                            </svg>
                        </div>
                        <h3 class="text-xl md:text-2xl font-black text-[#4A3428] mb-4 uppercase tracking-tight">Original Design</h3>
                        <p class="text-[#4A3428]/60 text-sm md:text-base leading-relaxed">
                            100% eksklusif dari tim kreatif kami. Nggak ada duplikasi, nggak ada kembar—lo dijamin tampil beda dari yang lain.
                        </p>
                    </div>

                    <div class="feature-card w-full flex-shrink-0 md:w-auto bg-white border-2 border-[#4A3428]/10 rounded-3xl p-8 text-center hover:border-[#D9B382] group">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-gold mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <h3 class="text-xl md:text-2xl font-black text-[#4A3428] mb-4 uppercase tracking-tight">Fast Delivery</h3>
                        <p class="text-[#4A3428]/60 text-sm md:text-base leading-relaxed">
                            Proses di hari yang sama dengan ekspedisi terpercaya. Jabodetabek 1-2 hari, luar kota 3-5 hari kerja maksimal.
                        </p>
                    </div>

                    <div class="feature-card w-full flex-shrink-0 md:w-auto bg-white border-2 border-[#4A3428]/10 rounded-3xl p-8 text-center hover:border-[#D9B382] group">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-gold mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <h3 class="text-xl md:text-2xl font-black text-[#4A3428] mb-4 uppercase tracking-tight">Solid Circle</h3>
                        <p class="text-[#4A3428]/60 text-sm md:text-base leading-relaxed">
                            Join komunitas eksklusif dengan akses first dibs ke koleksi baru, promo khusus, dan benefit member lainnya.
                        </p>
                    </div>

                    <div class="feature-card w-full flex-shrink-0 md:w-auto bg-white border-2 border-[#4A3428]/10 rounded-3xl p-8 text-center hover:border-[#D9B382] group">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-gold mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                        <h3 class="text-xl md:text-2xl font-black text-[#4A3428] mb-4 uppercase tracking-tight">Easy Return</h3>
                        <p class="text-[#4A3428]/60 text-sm md:text-base leading-relaxed">
                            Salah ukuran? Tenang! Lo punya 3 hari untuk retur/tukar ukuran tanpa ribet. Customer service kami siap bantu.
                        </p>
                    </div>

                    <div class="feature-card w-full flex-shrink-0 md:w-auto bg-white border-2 border-[#4A3428]/10 rounded-3xl p-8 text-center hover:border-[#D9B382] group">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-gold mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                                <line x1="1" y1="10" x2="23" y2="10"/>
                            </svg>
                        </div>
                        <h3 class="text-xl md:text-2xl font-black text-[#4A3428] mb-4 uppercase tracking-tight">Secure Payment</h3>
                        <p class="text-[#4A3428]/60 text-sm md:text-base leading-relaxed">
                            Berbagai metode pembayaran aman: Transfer Bank, E-Wallet, hingga COD. Transaksi lo 100% terjamin keamanannya.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center" data-aos="fade-up" data-aos-delay="400">
            <div class="inline-flex items-center gap-3 bg-[#4A3428]/5 px-6 py-3 rounded-full mb-6">
                <span class="size-2 rounded-full bg-[#D9B382] animate-pulse"></span>
                <span class="text-xs md:text-sm font-bold text-[#4A3428] uppercase tracking-wider">Ribuan customer puas dengan pilihan mereka</span>
            </div>
            <a href="/products" class="group inline-flex items-center gap-3 bg-[#4A3428] py-5 px-12 rounded-2xl text-white font-bold hover:bg-[#D9B382] hover:text-[#4A3428] transition-all shadow-xl shadow-[#4A3428]/20 text-base md:text-lg">
                <span>MULAI BELANJA SEKARANG</span>
                <svg class="group-hover:translate-x-2 transition-transform" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>
</section>

<section class="py-20 md:py-32 bg-[#FDFBF9] border-t border-[#4A3428]/5 font-poppins">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="text-center mb-16" data-aos="fade-up">
            <p class="text-[#D9B382] font-bold tracking-[.4em] uppercase text-xs mb-3">Bantuan</p>
            <h2 class="text-[#4A3428] text-4xl md:text-5xl font-black tracking-tighter">Pertanyaan Populer</h2>
            <p class="text-[#4A3428]/50 text-sm md:text-base max-w-md mx-auto">Segala hal yang perlu lo tau tentang produk dan layanan eksklusif dari Toko Anjay.</p>
        </div>

        <div id="faqContainer" class="space-y-4" data-aos="fade-up" data-aos-delay="200">
        </div>
    </div>
</section>

<script>

    AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
        mirror: false,
        offset: 80
    });


    document.addEventListener('DOMContentLoaded', () => {
        const track = document.getElementById('featureTrack');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        let cards = track.querySelectorAll('.feature-card');
        
       
        let currentIndex = 0;
        const originalCount = cards.length;
        let autoSlideInterval;
        let isTransitioning = false;


        const firstCardClone = cards[0].cloneNode(true);

        firstCardClone.classList.add('md:hidden'); 
        track.appendChild(firstCardClone);
        
     
        cards = track.querySelectorAll('.feature-card');

        const updateCarousel = (instant = false) => {
    
            if (window.innerWidth < 768) {
                if (instant) {
                    track.style.transition = 'none';
                } else {
                    track.style.transition = 'transform 0.5s ease-out';
                }
                track.style.transform = `translateX(-${currentIndex * 100}%)`;
            } else {
                // Reset styling di desktop
                track.style.transform = 'none';
                track.style.transition = 'none';
            }
        };

        const nextSlide = () => {
            if (isTransitioning) return;
            if (window.innerWidth >= 768) return;

            isTransitioning = true;
            currentIndex++;
            updateCarousel();

            if (currentIndex === originalCount) {

                setTimeout(() => {
                    currentIndex = 0;
                    updateCarousel(true); 
                    isTransitioning = false;
                }, 500); 
            } else {
                setTimeout(() => {
                    isTransitioning = false;
                }, 500);
            }
        };

        const prevSlide = () => {
            if (isTransitioning) return;
            if (window.innerWidth >= 768) return;

            isTransitioning = true;

            if (currentIndex === 0) {
                currentIndex = originalCount;
                updateCarousel(true);
              
                track.offsetHeight; 
                
              
                requestAnimationFrame(() => {
                    currentIndex--;
                    updateCarousel();
                    setTimeout(() => isTransitioning = false, 500);
                });
            } else {
                currentIndex--;
                updateCarousel();
                setTimeout(() => isTransitioning = false, 500);
            }
        };

        
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetAutoSlide();
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetAutoSlide();
        });

  
        const startAutoSlide = () => {
            if (window.innerWidth < 768) {
    
                autoSlideInterval = setInterval(nextSlide, 2000); 
            }
        };

        const resetAutoSlide = () => {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        };


        window.addEventListener('resize', () => {
            updateCarousel();
            clearInterval(autoSlideInterval);
            startAutoSlide();
        });

  
        startAutoSlide();
    });


    const faqsData = [
        {
            question: 'Bagaimana kualitas bahan produk Anjay?',
            answer: 'Kami hanya menggunakan bahan premium pilihan (High-Grade Cotton & Synthetic) yang awet, nyaman di kulit, dan memberikan kesan mewah saat dipakai.'
        },
        {
            question: 'Berapa lama proses pengirimannya?',
            answer: 'Pesanan lo diproses di hari yang sama. Untuk wilayah Jabodetabek biasanya 1-2 hari, dan luar kota 3-5 hari kerja menggunakan ekspedisi kilat.'
        },
        {
            question: 'Apakah bisa tukar ukuran (Size Return)?',
            answer: 'Bisa banget! Kalau ukuran nggak pas, lo punya waktu 3 hari setelah barang sampai untuk retur. Hubungi admin WhatsApp kami untuk proses cepatnya.'
        },
        {
            question: 'Apakah produknya original desain sendiri?',
            answer: '100% Original. Semua desain dikurasi dan diproduksi secara eksklusif oleh tim kreatif Anjay, jadi lo nggak bakal nemu kembarannya di tempat lain.'
        },
        {
            question: 'Bagaimana cara dapet promo khusus Solid Circle?',
            answer: 'Cukup lakukan pembelian pertama, lo otomatis terdaftar di database Solid Circle kami dan bakal dapet info promo via WA/Email sebelum publik tau.'
        }
    ];

    const faqContainer = document.getElementById('faqContainer');

    faqContainer.innerHTML = faqsData.map((faq, index) => `
    <div class="faq-item group">
        <div class="faq-header flex items-center justify-between w-full cursor-pointer bg-white border border-[#4A3428]/10 p-5 md:p-6 rounded-2xl transition-all shadow-sm group-hover:shadow-md">
            <h2 class="text-sm md:text-base font-bold text-[#4A3428] uppercase tracking-tight">${faq.question}</h2>
            <div class="faq-icon-wrapper flex items-center justify-center size-8 rounded-full bg-[#4A3428]/5 text-[#4A3428] transition-all group-hover:bg-[#D9B382] group-hover:text-white">
                <svg class="faq-icon transition-transform duration-500" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </div>
        </div>
        <div class="faq-answer overflow-hidden max-h-0 opacity-0 bg-white mx-4 rounded-b-2xl">
            <div class="p-6 text-sm md:text-base text-[#4A3428]/60 leading-relaxed border-x border-b border-[#4A3428]/5 rounded-b-2xl">
                ${faq.answer}
            </div>
        </div>
    </div>
    `).join('');

    document.querySelectorAll('.faq-header').forEach((header, index) => {
        header.addEventListener('click', () => {
            const item = header.parentElement;
            const answer = item.querySelector('.faq-answer');
            const icon = item.querySelector('.faq-icon');
            const isOpen = answer.classList.contains('opacity-100');

            document.querySelectorAll('.faq-answer').forEach((el, i) => {
                el.classList.remove('opacity-100', 'max-h-[300px]', 'mt-[-10px]', 'pb-4');
                el.classList.add('max-h-0', 'opacity-0');
                document.querySelectorAll('.faq-icon')[i].classList.remove('rotate-180');
                document.querySelectorAll('.faq-header')[i].classList.remove('border-[#D9B382]');
            });

    
            if (!isOpen) {
                answer.classList.remove('max-h-0', 'opacity-0');
                answer.classList.add('opacity-100', 'max-h-[300px]', 'mt-[-10px]', 'pb-4');
                icon.classList.add('rotate-180');
                header.classList.add('border-[#D9B382]');
            }
        });
    });

    // --- COUNTER LOGIC ---
    const counters = document.querySelectorAll('.counter');
    let started = false;

    const animateCounter = (counter) => {
        const target = parseFloat(counter.getAttribute('data-target'));
        const isDecimal = target % 1 !== 0;
        const duration = 2000;
        const startTime = performance.now();

        const update = (currentTime) => {
            const progress = Math.min((currentTime - startTime) / duration, 1);
            let value = progress * target;

            if (isDecimal) {
                counter.innerText = value.toFixed(1);
            } else {
                counter.innerText = Math.floor(value).toLocaleString();
            }

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                if (target === 12000) counter.innerText = "12K+";
                if (target === 500) counter.innerText += "+";
                if (target === 100) counter.innerText += "%";
            }
        };

        requestAnimationFrame(update);
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !started) {
                counters.forEach(counter => animateCounter(counter));
                started = true;
            }
        });
    }, { threshold: 0.4 });

    const faqSection = document.querySelector('#faqContainer');
    if (faqSection) {
        const statsSection = faqSection.closest('section').previousElementSibling.previousElementSibling;
        if (statsSection) {
            observer.observe(statsSection);
        }
    }
</script>

</body>
</html>
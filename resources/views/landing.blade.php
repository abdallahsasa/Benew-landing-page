<!DOCTYPE html>
<html lang="en" dir="ltr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benew® | Be New To Be Fine — Dental &amp; Plastic Surgery Clinic</title>
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', 'Cairo', sans-serif; }
        [dir="rtl"] body { font-family: 'Cairo', 'Inter', sans-serif; }
        .font-serif-display { font-family: 'Playfair Display', 'Cairo', Georgia, serif; }
        .bg-benew-gradient { background: linear-gradient(135deg, #1E083B 0%, #330F63 100%); }
    </style>
    @if(!empty($clinic['meta_pixel_id']))
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ $clinic['meta_pixel_id'] }}');
        fbq('track', 'PageView');
    </script>
    @endif
</head>
<body class="bg-[#F6F3FA] text-gray-800 antialiased pb-16 md:pb-0">

    <!-- Navbar (No Admin Dashboard button) -->
    <header class="bg-benew-gradient text-white sticky top-0 z-40 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-3">
            <a href="#heroSection" class="flex items-center gap-3 shrink-0">
                <img src="{{ asset('images/benew-logo.jpg') }}" alt="Benew Logo" class="h-10 w-auto rounded-md object-cover">
            </a>
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="#servicesSection" data-i18n="nav_services" class="hover:text-amber-300 transition">Dental Services</a>
                <a href="#whoWeAreSection" data-i18n="nav_who" class="hover:text-amber-300 transition">Who We Are</a>
                <a href="#footerSection" data-i18n="nav_contact" class="hover:text-amber-300 transition">Contact</a>
            </nav>
            <div class="flex items-center gap-2.5">
                <button id="btnLangToggle" type="button" class="px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-xs font-bold border border-white/20 transition">
                    عربي
                </button>
                <a href="#heroFormCard" data-i18n="nav_book" class="bg-amber-400 text-[#1E083B] text-xs sm:text-sm font-semibold px-3.5 sm:px-4 py-2 rounded-full hover:bg-amber-300 transition">
                    Book Consultation
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section: Side by Side -->
    <section id="heroSection" class="bg-benew-gradient text-white py-10 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-6 space-y-5">
                <span data-i18n="hero_badge" class="inline-block bg-white/10 border border-white/20 text-amber-300 text-xs font-semibold px-3 py-1 rounded-full tracking-wide uppercase">
                    Precision Dental &amp; Aesthetic Care
                </span>
                <h1 data-i18n="hero_title" class="text-3xl sm:text-4xl lg:text-5xl font-serif-display font-bold leading-tight">
                    Transform Your Smile with <span class="text-amber-300">Benew®</span>
                </h1>
                <p data-i18n="hero_desc" class="text-purple-100 text-base sm:text-lg leading-relaxed">
                    From Emax Veneer Lenses and Dental Implants to Laser Whitening and Orthodontics, our specialists deliver pain-free, natural-looking dental treatments tailored to your facial harmony.
                </p>
                 <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-sm">
                  <div class="bg-white/10 rounded-xl p-3 border border-white/10 flex items-center gap-3">
                     <img src="{{ asset('images/dental-services.jpg') }}" alt="14 Dental Services" class="w-10 h-10 rounded-lg object-cover shrink-0">
                <div>
                   <p data-i18n="stat_1_title" class="font-bold text-amber-300">14 Dental Services</p>
                 <p data-i18n="stat_1_sub" class="text-purple-200 text-xs">Complete smile care</p>
              </div>
                </div>
                <div class="bg-white/10 rounded-xl p-3 border border-white/10 flex items-center gap-3">
                <img src="{{ asset('images/specialist-doctors.jpg') }}" alt="Specialist Doctors" class="w-10 h-10 rounded-lg object-cover shrink-0">
          <div>
            <p data-i18n="stat_2_title" class="font-bold text-amber-300">Specialist Doctors</p>
            <p data-i18n="stat_2_sub" class="text-purple-200 text-xs">Certified materials</p>
        </div>
    </div>
</div>
            </div>

            <div id="heroFormCard" class="lg:col-span-6 bg-white text-gray-800 rounded-2xl shadow-2xl p-6 sm:p-8">
                <h2 data-i18n="form_title" class="text-2xl font-bold text-[#1E083B] mb-1">Contact Us &amp; Free Assessment</h2>
                <p data-i18n="form_subtitle" class="text-sm text-gray-500 mb-5">Leave your details and our dental coordinator will contact you shortly.</p>

                <div id="leadSuccessAlert" class="hidden bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl p-4 mb-4 text-sm"></div>
                <div id="leadErrorAlert" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-xl p-3 mb-4 text-sm"></div>

                <form id="leadForm" class="space-y-4">
                    <div>
                        <label for="leadName" data-i18n="label_name" class="block text-xs font-semibold text-gray-600 mb-1">Full Name *</label>
                        <input id="leadName" type="text" required class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-purple-700 focus:outline-none">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="leadPhone" data-i18n="label_phone" class="block text-xs font-semibold text-gray-600 mb-1">Phone / WhatsApp *</label>
                            <input id="leadPhone" type="tel" required class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-purple-700 focus:outline-none">
                        </div>
                        <div>
                            <label for="leadEmail" data-i18n="label_email" class="block text-xs font-semibold text-gray-600 mb-1">Email (Optional)</label>
                            <input id="leadEmail" type="email" class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-purple-700 focus:outline-none">
                        </div>
                    </div>
                    <div>
                        <label for="leadService" data-i18n="label_service" class="block text-xs font-semibold text-gray-600 mb-1">Treatment of Interest *</label>
                        <select id="leadService" required class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm bg-white focus:ring-2 focus:ring-purple-700 focus:outline-none"></select>
                    </div>
                    <div>
                        <label for="leadMessage" data-i18n="label_notes" class="block text-xs font-semibold text-gray-600 mb-1">Notes / Questions</label>
                        <textarea id="leadMessage" rows="2" class="w-full rounded-xl border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-purple-700 focus:outline-none"></textarea>
                    </div>
                    <button id="btnSubmitLead" type="submit" data-i18n="btn_submit" class="w-full bg-benew-gradient text-white font-semibold py-3 rounded-xl hover:opacity-95 transition shadow-md">
                        Request Free Consultation
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Dental Services & Case Gallery -->
    <section id="servicesSection" class="py-14 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h2 data-i18n="services_title" class="text-3xl font-serif-display font-bold text-[#1E083B]">Our Dental Treatments &amp; Case Results</h2>
            <p data-i18n="services_sub" class="text-gray-600 mt-2 text-sm sm:text-base">Tap any of the 14 treatments below to view details and clinical case results.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div id="serviceButtonsGrid" class="lg:col-span-5 grid grid-cols-2 gap-2.5 h-fit"></div>
            <div class="lg:col-span-7 bg-white rounded-2xl shadow-sm border border-purple-100 p-6">
                <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-100 pb-4 mb-4">
                    <div>
                        <h3 id="activeServiceTitle" class="text-2xl font-bold text-[#1E083B]"></h3>
                        <p id="activeServiceDesc" class="text-sm text-gray-600 mt-1"></p>
                    </div>
                    <button id="btnBookSelectedService" type="button" data-i18n="btn_book_service"
                            class="bg-amber-400 text-[#1E083B] font-semibold text-xs sm:text-sm px-4 py-2.5 rounded-xl hover:bg-amber-300 transition">
                        Book This Treatment
                    </button>
                </div>
                <h4 data-i18n="gallery_title" class="text-sm font-semibold text-gray-700 mb-3">Case Results Gallery</h4>
                <div id="serviceGalleryGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-4"></div>
            </div>
        </div>
    </section>

    <!-- Who We Are (Dynamic DB Section) -->
    <section id="whoWeAreSection" class="py-14 bg-white border-y border-purple-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span data-i18n="about_badge" class="text-xs font-bold uppercase tracking-widest text-purple-700">About Benew®</span>
            <h2 id="whoWeAreTitle" class="text-3xl font-serif-display font-bold text-[#1E083B] mt-2"></h2>
            <p id="whoWeAreSubtitle" class="text-purple-700 font-medium mt-2"></p>
            <p id="whoWeAreBody" class="mt-5 text-gray-600 leading-relaxed text-base sm:text-lg max-w-3xl mx-auto whitespace-pre-line"></p>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footerSection" class="bg-benew-gradient text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <img src="{{ asset('images/benew-logo.jpg') }}" alt="Benew Logo" class="h-12 w-auto rounded-md mb-3">
                <p data-i18n="footer_tagline" class="text-purple-200 text-sm">Be New To Be Fine — Dental Treatments.&amp; </p>
            </div>
            <div class="space-y-2.5 text-sm">
                <h3 data-i18n="footer_contact" class="font-bold text-amber-300 uppercase tracking-wider text-xs mb-3">Contact &amp; Location</h3>
                <p>Phone: <a href="tel:{{ preg_replace('/\s+/', '', $clinic['phone']) }}" class="underline hover:text-amber-300" dir="ltr">{{ $clinic['phone'] }}</a></p>
                <p>Location: <a href="{{ $clinic['maps_url'] }}" target="_blank" rel="noopener" id="clinicAddressLink" class="underline hover:text-amber-300">{{ $clinic['address_en'] }}</a></p>
            </div>
            <div>
                <h3 data-i18n="footer_follow" class="font-bold text-amber-300 uppercase tracking-wider text-xs mb-3">Follow Us</h3>
                <div class="flex flex-wrap gap-2.5 text-xs">
                    <a href="{{ $clinic['social']['instagram'] }}" target="_blank" class="bg-white/10 px-3 py-2 rounded-lg hover:bg-white/20">Instagram</a>
                    <a href="{{ $clinic['social']['facebook'] }}" target="_blank" class="bg-white/10 px-3 py-2 rounded-lg hover:bg-white/20">Facebook</a>
                    <a href="{{ $clinic['social']['tiktok'] }}" target="_blank" class="bg-white/10 px-3 py-2 rounded-lg hover:bg-white/20">TikTok</a>
                    <a href="{{ $clinic['social']['youtube'] }}" target="_blank" class="bg-white/10 px-3 py-2 rounded-lg hover:bg-white/20">YouTube</a>
                    <a href="https://wa.me/{{ $clinic['whatsapp'] }}" target="_blank" class="bg-emerald-500 text-white px-3 py-2 rounded-lg hover:bg-emerald-400">WhatsApp</a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-purple-300">
            <span data-i18n="footer_copy">&copy; {{ date('Y') }} Benew® Clinic. All rights reserved.</span>
            <span>Powered by <a href="https://threedigitsoftware.com" target="_blank" rel="noopener noreferrer" class="text-amber-300 hover:underline font-semibold">Threedigitsoftware</a></span>
        </div>
    </footer>

    <!-- Sticky Mobile Bottom CTA Bar -->
    <div class="md:hidden fixed bottom-0 inset-x-0 bg-white border-t border-gray-200 px-3 py-2 flex gap-2 z-40 shadow-lg">
        <a href="tel:{{ preg_replace('/\s+/', '', $clinic['phone']) }}" data-i18n="mob_call" class="flex-1 text-center bg-gray-100 text-[#1E083B] font-semibold text-xs py-2.5 rounded-lg">Call</a>
        <a href="https://wa.me/{{ $clinic['whatsapp'] }}" target="_blank" data-i18n="mob_wa" class="flex-1 text-center bg-emerald-500 text-white font-semibold text-xs py-2.5 rounded-lg">WhatsApp</a>
        <a href="#heroFormCard" data-i18n="mob_book" class="flex-1 text-center bg-[#2B0C54] text-white font-semibold text-xs py-2.5 rounded-lg">Book Now</a>
    </div>

    <script>
        let currentLang = 'en';
        const allServices = @json($services->load('caseImages'));
        const dentalServices = allServices.filter(s => s.category === 'dental');
        const whoWeAreData = @json($whoWeAre);
        const clinicAddress = { en: @json($clinic['address_en']), ar: @json($clinic['address_ar']) };
        let activeServiceId = dentalServices[0]?.id || 1;

        const i18n = {
            en: {
                nav_services: 'Dental Services', nav_who: 'Who We Are', nav_contact: 'Contact', nav_book: 'Book Consultation',
                hero_badge: 'Precision Dental & Aesthetic Care',
                hero_title: 'Transform Your Smile with <span class="text-amber-300">Benew®</span>',
                hero_desc: 'From Emax Veneer Lenses and Dental Implants to Laser Whitening and Orthodontics, our specialists deliver pain-free, natural-looking dental treatments tailored to your facial harmony.',
                stat_1_title: '14 Dental Services', stat_1_sub: 'Complete smile care',
                stat_2_title: 'Specialist Doctors', stat_2_sub: 'Certified materials',
                stat_3_title: 'Plastic Surgery', stat_3_sub: 'Full aesthetic suite',
                form_title: 'Contact Us & Free Assessment', form_subtitle: 'Leave your details and our dental coordinator will contact you shortly.',
                label_name: 'Full Name *', label_phone: 'Phone / WhatsApp *', label_email: 'Email (Optional)',
                label_service: 'Treatment of Interest *', label_notes: 'Notes / Questions', btn_submit: 'Request Free Consultation',
                services_title: 'Our Dental Treatments & Case Results', services_sub: 'Tap any of the 14 treatments below to view details and clinical case results.',
                btn_book_service: 'Book This Treatment', gallery_title: 'Case Results Gallery',
                about_badge: 'About Benew®', footer_tagline: 'Be New To Be Fine — Dental Treatments & Plastic Surgery.',
                footer_contact: 'Contact & Location', footer_follow: 'Follow Us', footer_copy: '© {{ date("Y") }} Benew® Clinic. All rights reserved.',
                mob_call: 'Call', mob_wa: 'WhatsApp', mob_book: 'Book Now'
            },
            ar: {
                nav_services: 'خدمات الأسنان', nav_who: 'من نحن', nav_contact: 'تواصل معنا', nav_book: 'احجز استشارة',
                hero_badge: 'رعاية دقيقة للأسنان والطب التجميلي',
                hero_title: 'جدّد ابتسامتك مع <span class="text-amber-300">Benew®</span>',
                hero_desc: 'من عدسات الإيماكس وزراعة الأسنان إلى تبييض الليزر وتقويم الأسنان، يقدم أطباؤنا علاجات أسنان بدون ألم وبنتائج طبيعية متناغمة مع ملامح وجهك.',
                stat_1_title: '14 خدمة أسنان', stat_1_sub: 'عناية متكاملة بالابتسامة',
                stat_2_title: 'أطباء مختصون', stat_2_sub: 'خامات طبية معتمدة',
                stat_3_title: 'جراحة التجميل', stat_3_sub: 'خدمات تجميلية شاملة',
                form_title: 'تواصل معنا واحصل على تقييم مجاني', form_subtitle: 'اترك بياناتك وسيتواصل معك منسق العيادة في أقرب وقت.',
                label_name: 'الاسم الكامل *', label_phone: 'رقم الهاتف / الواتساب *', label_email: 'البريد الإلكتروني (اختياري)',
                label_service: 'الخدمة المطلوبة *', label_notes: 'ملاحظات أو استفسارات', btn_submit: 'اطلب استشارة مجانية',
                services_title: 'علاجات الأسنان ونتائج الحالات', services_sub: 'اختر أياً من الخدمات الـ 14 أدناه للاطلاع على التفاصيل وصور الحالات السريرية.',
                btn_book_service: 'احجز هذه الخدمة', gallery_title: 'معرض نتائج الحالات',
                about_badge: 'عن عيادة Benew®', footer_tagline: 'Be New To Be Fine — علاجات الأسنان وجراحة التجميل.',
                footer_contact: 'التواصل والموقع', footer_follow: 'تابعنا', footer_copy: '© {{ date("Y") }} عيادة Benew®. جميع الحقوق محفوظة.',
                mob_call: 'اتصال', mob_wa: 'واتساب', mob_book: 'احجز الآن'
            }
        };

        function svcName(s) { return currentLang === 'ar' ? s.name_ar : s.name_en; }
        function svcDesc(s) { return currentLang === 'ar' ? s.short_description_ar : s.short_description_en; }

        function applyTranslations() {
            const dict = i18n[currentLang];
            document.documentElement.lang = currentLang;
            document.documentElement.dir = currentLang === 'ar' ? 'rtl' : 'ltr';
            document.getElementById('btnLangToggle').textContent = currentLang === 'ar' ? 'EN' : 'عربي';
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const k = el.getAttribute('data-i18n');
                if (dict[k]) {
                    if (k === 'hero_title') el.innerHTML = dict[k];
                    else el.textContent = dict[k];
                }
            });
            document.getElementById('clinicAddressLink').textContent = clinicAddress[currentLang];
            if (whoWeAreData) {
                document.getElementById('whoWeAreTitle').textContent = currentLang === 'ar' ? whoWeAreData.title_ar : whoWeAreData.title_en;
                document.getElementById('whoWeAreSubtitle').textContent = currentLang === 'ar' ? (whoWeAreData.subtitle_ar || '') : (whoWeAreData.subtitle_en || '');
                document.getElementById('whoWeAreBody').textContent = currentLang === 'ar' ? whoWeAreData.body_ar : whoWeAreData.body_en;
            }
            renderServices();
            renderActivePanel();
        }

        function renderServices() {
            const grid = document.getElementById('serviceButtonsGrid');
            const select = document.getElementById('leadService');
            const prev = select.value;
            grid.innerHTML = '';
            select.innerHTML = '';
            dentalServices.forEach(s => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = s.id === activeServiceId
                    ? 'text-start px-3.5 py-3 rounded-xl border border-purple-200 text-xs sm:text-sm font-medium bg-[#2B0C54] text-white shadow-md transition'
                    : 'text-start px-3.5 py-3 rounded-xl border border-purple-100 text-xs sm:text-sm font-medium bg-white text-gray-700 hover:bg-purple-50 transition';
                btn.textContent = svcName(s);
                btn.addEventListener('click', () => { activeServiceId = s.id; renderServices(); renderActivePanel(); });
                grid.appendChild(btn);
            });
            allServices.forEach(s => {
                const opt = document.createElement('option');
                opt.value = s.name_en;
                opt.textContent = svcName(s);
                select.appendChild(opt);
            });
            if (prev) select.value = prev;
        }

        function renderActivePanel() {
            const s = dentalServices.find(x => x.id === activeServiceId) || dentalServices[0];
            if (!s) return;
            document.getElementById('activeServiceTitle').textContent = svcName(s);
            document.getElementById('activeServiceDesc').textContent = svcDesc(s) || '';
            const gal = document.getElementById('serviceGalleryGrid');
            gal.innerHTML = '';
            if (!s.case_images || !s.case_images.length) {
                gal.innerHTML = `<div class="col-span-full rounded-xl bg-[#F6F3FA] p-6 text-center text-sm text-gray-500">${
                    currentLang === 'ar' ? 'لا توجد صور حالات بعد لهذه الخدمة.' : 'No case photos uploaded yet for this treatment.'
                }</div>`;
                return;
            }
            s.case_images.forEach(img => {
                const card = document.createElement('div');
                card.className = 'rounded-xl overflow-hidden border border-purple-100 bg-gray-50';
                card.innerHTML = `<img src="${img.image_url}" alt="${img.caption || ''}" class="w-full h-48 object-cover">` +
                    (img.caption ? `<p class="p-2.5 text-xs text-gray-600 font-medium">${img.caption}</p>` : '');
                gal.appendChild(card);
            });
        }

        document.getElementById('btnLangToggle').addEventListener('click', () => {
            currentLang = currentLang === 'en' ? 'ar' : 'en';
            applyTranslations();
        });

        document.getElementById('btnBookSelectedService').addEventListener('click', () => {
            const s = dentalServices.find(x => x.id === activeServiceId);
            if (s) document.getElementById('leadService').value = s.name_en;
            document.getElementById('heroFormCard').scrollIntoView({ behavior: 'smooth' });
        });

        document.getElementById('leadForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const params = new URLSearchParams(window.location.search);
            const okBox = document.getElementById('leadSuccessAlert');
            const errBox = document.getElementById('leadErrorAlert');
            okBox.classList.add('hidden');
            errBox.classList.add('hidden');
            try {
                const res = await fetch('/api/v1/leads', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({
                        full_name: document.getElementById('leadName').value,
                        phone: document.getElementById('leadPhone').value,
                        email: document.getElementById('leadEmail').value || null,
                        service_interest: document.getElementById('leadService').value,
                        message: document.getElementById('leadMessage').value || null,
                        utm_source: params.get('utm_source'),
                        utm_medium: params.get('utm_medium'),
                        utm_campaign: params.get('utm_campaign'),
                        utm_content: params.get('utm_content'),
                        fbclid: params.get('fbclid'),
                    })
                });
                const data = await res.json();
                if (!res.ok) {
                    errBox.textContent = data.message || 'Validation error.';
                    errBox.classList.remove('hidden');
                    return;
                }
                okBox.textContent = currentLang === 'ar' ? 'تم استلام طلبك بنجاح! سيتواصل معك فريقنا قريباً.' : data.message;
                okBox.classList.remove('hidden');
                document.getElementById('leadForm').reset();
                if (typeof fbq === 'function') fbq('track', 'Lead');
            } catch (err) {
                errBox.textContent = 'Network error. Please try again.';
                errBox.classList.remove('hidden');
            }
        });

        applyTranslations();
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benew® Admin Dashboard</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#1E083B">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', 'Cairo', sans-serif; }
        [dir="rtl"] body { font-family: 'Cairo', 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F6F4FA] text-gray-800 min-h-screen antialiased" x-data="adminApp()" x-init="init()">
    <header class="bg-[#1E083B] text-white sticky top-0 z-30 border-b border-white/10 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 h-16 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3.5">
                <img src="{{ asset('images/benew-logo-white.png') }}" alt="Benew®" width="712" height="248" class="h-9 sm:h-10 w-auto object-contain translate-y-[1px]">
                <span class="h-5 w-px bg-white/20 hidden sm:inline-block"></span>
                <span class="font-semibold text-sm text-purple-200 hidden sm:inline-block" x-text="lang==='ar' ? 'لوحة التحكم' : 'Admin Dashboard'"></span>
            </div>
            <div class="flex items-center gap-2 sm:gap-2.5 text-xs sm:text-sm">
                <button @click="toggleLang" class="bg-white/10 hover:bg-white/20 border border-white/15 px-3.5 py-1.5 rounded-full font-bold transition" x-text="lang==='ar' ? 'EN' : 'عربي'"></button>
                <a href="/" target="_blank" class="bg-white/10 hover:bg-white/20 border border-white/15 px-3.5 py-1.5 rounded-full font-medium transition" x-text="lang==='ar' ? 'عرض الموقع ↗' : 'View Site ↗'"></a>
                <button @click="logout" class="bg-red-500/90 hover:bg-red-500 px-3.5 py-1.5 rounded-full font-semibold transition" x-text="lang==='ar' ? 'خروج' : 'Logout'"></button>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-8 py-6 sm:py-8 space-y-6">
        <!-- Navigation Tabs -->
        <div class="flex flex-wrap items-center gap-2 bg-white p-1.5 rounded-2xl border border-purple-100/80 shadow-sm w-fit">
            <button @click="tab='leads'" :class="tab==='leads' ? 'bg-[#2B0C54] text-white shadow-sm' : 'text-gray-600 hover:text-[#1E083B] hover:bg-purple-50/60'" class="px-4 py-2 rounded-xl text-sm font-semibold transition" x-text="lang==='ar' ? 'العملاء (Leads)' : 'Leads CRM'"></button>
            <button @click="tab='cases'" :class="tab==='cases' ? 'bg-[#2B0C54] text-white shadow-sm' : 'text-gray-600 hover:text-[#1E083B] hover:bg-purple-50/60'" class="px-4 py-2 rounded-xl text-sm font-semibold transition" x-text="lang==='ar' ? 'صور الحالات' : 'Case Images'"></button>
            <button @click="tab='content'" :class="tab==='content' ? 'bg-[#2B0C54] text-white shadow-sm' : 'text-gray-600 hover:text-[#1E083B] hover:bg-purple-50/60'" class="px-4 py-2 rounded-xl text-sm font-semibold transition" x-text="lang==='ar' ? 'تعديل من نحن' : 'Who We Are'"></button>
            <button @click="tab='password'" :class="tab==='password' ? 'bg-[#2B0C54] text-white shadow-sm' : 'text-gray-600 hover:text-[#1E083B] hover:bg-purple-50/60'" class="px-4 py-2 rounded-xl text-sm font-semibold transition" x-text="lang==='ar' ? 'تغيير كلمة المرور' : 'Change Password'"></button>
        </div>

        <!-- Toast Alert -->
        <template x-if="notice">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center justify-between gap-3 text-sm font-medium shadow-sm">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-600 text-white text-xs">✓</span>
                    <span x-text="notice"></span>
                </div>
                <button @click="notice=''" class="text-emerald-600 hover:text-emerald-900 font-bold px-1">&times;</button>
            </div>
        </template>

        <!-- Leads CRM -->
        <div x-show="tab==='leads'" x-cloak class="space-y-4">
            <!-- KPI Summary Row -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
                <div class="bg-white rounded-2xl border border-purple-100/80 p-4 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400" x-text="lang==='ar' ? 'إجمالي الطلبات' : 'Total Leads'"></p>
                    <p class="text-2xl font-bold text-[#1E083B] mt-1" x-text="leads.length"></p>
                </div>
                <div class="bg-white rounded-2xl border border-purple-100/80 p-4 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wider text-blue-600" x-text="lang==='ar' ? 'جديد (New)' : 'New'"></p>
                    <p class="text-2xl font-bold text-gray-900 mt-1" x-text="leads.filter(l => l.status === 'New').length"></p>
                </div>
                <div class="bg-white rounded-2xl border border-purple-100/80 p-4 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wider text-amber-600" x-text="lang==='ar' ? 'تم التواصل' : 'Contacted'"></p>
                    <p class="text-2xl font-bold text-gray-900 mt-1" x-text="leads.filter(l => l.status === 'Contacted').length"></p>
                </div>
                <div class="bg-white rounded-2xl border border-purple-100/80 p-4 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600" x-text="lang==='ar' ? 'موعد مؤكد' : 'Scheduled'"></p>
                    <p class="text-2xl font-bold text-gray-900 mt-1" x-text="leads.filter(l => l.status === 'Scheduled').length"></p>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-purple-100/80 overflow-hidden">
                <!-- Toolbar -->
                <div class="p-4 sm:px-6 sm:py-5 border-b border-gray-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <h2 class="text-lg font-bold text-[#1E083B]" x-text="lang==='ar' ? 'العملاء المحتملون' : 'Patient Leads'"></h2>
                        <div class="flex flex-wrap items-center gap-1.5">
                            <template x-for="flt in ['All','New','Contacted','Scheduled','Archived']" :key="flt">
                                <button
                                    type="button"
                                    @click="statusFilter = (flt === 'All' ? '' : flt); fetchLeads()"
                                    :class="(statusFilter === '' && flt === 'All') || statusFilter === flt
                                        ? 'bg-[#2B0C54] text-white'
                                        : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                                    class="px-2.5 py-1 rounded-lg text-xs font-semibold transition"
                                    x-text="statusLabel(flt)"
                                ></button>
                            </template>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2.5">
                        <div class="relative flex-1 sm:flex-initial">
                            <input
                                type="text"
                                x-model="leadSearch"
                                @input.debounce.350ms="fetchLeads"
                                :placeholder="lang==='ar' ? 'بحث بالاسم أو الرقم...' : 'Search name, phone, email...'"
                                class="w-full sm:w-64 border border-gray-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-100 focus:outline-none rounded-xl px-3.5 py-2 text-sm transition"
                            >
                        </div>
                        <button
                            type="button"
                            @click="exportCsv"
                            class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs sm:text-sm px-4 py-2 rounded-xl shadow-sm transition shrink-0"
                        >
                            <span>⬇</span>
                            <span x-text="lang==='ar' ? 'تصدير CSV' : 'Export CSV'"></span>
                        </button>
                    </div>
                </div>

                <!-- Properly Aligned Responsive Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="bg-gray-50/90 border-b border-gray-200 text-[11px] font-bold uppercase tracking-wider text-gray-500">
                                <th class="px-5 py-3.5 text-left rtl:text-right" x-text="lang==='ar' ? 'الاسم' : 'Patient'"></th>
                                <th class="px-5 py-3.5 text-left rtl:text-right" x-text="lang==='ar' ? 'الهاتف' : 'Phone'"></th>
                                <th class="px-5 py-3.5 text-left rtl:text-right" x-text="lang==='ar' ? 'الخدمة المطلوبة' : 'Service'"></th>
                                <th class="px-5 py-3.5 text-left rtl:text-right" x-text="lang==='ar' ? 'المصدر (UTM)' : 'UTM Source'"></th>
                                <th class="px-5 py-3.5 text-left rtl:text-right" x-text="lang==='ar' ? 'التاريخ' : 'Created'"></th>
                                <th class="px-5 py-3.5 text-left rtl:text-right" x-text="lang==='ar' ? 'الحالة' : 'Status'"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template x-if="leads.length === 0">
                                <tr>
                                    <td colspan="6" class="px-5 py-12 text-center text-gray-400 text-sm" x-text="lang==='ar' ? 'لا توجد طلبات مطابقة حالياً.' : 'No leads found matching your filter.'"></td>
                                </tr>
                            </template>
                            <template x-for="lead in leads" :key="lead.id">
                                <tr class="hover:bg-purple-50/30 transition-colors align-middle">
                                    <!-- Patient Name + Optional Email / Note -->
                                    <td class="px-5 py-4 text-left rtl:text-right">
                                        <div class="font-semibold text-gray-900" x-text="lead.full_name"></div>
                                        <template x-if="lead.email">
                                            <div class="text-xs text-gray-500 mt-0.5" x-text="lead.email"></div>
                                        </template>
                                        <template x-if="lead.message">
                                            <div class="text-xs text-gray-500 mt-1 max-w-xs truncate" :title="lead.message" x-text="'💬 ' + lead.message"></div>
                                        </template>
                                    </td>

                                    <!-- Phone (LTR digits inside start-aligned cell) -->
                                    <td class="px-5 py-4 text-left rtl:text-right whitespace-nowrap">
                                        <a :href="'tel:' + (lead.phone || '').replace(/\s+/g, '')" dir="ltr" class="inline-block font-medium text-gray-700 hover:text-purple-700 hover:underline" x-text="lead.phone"></a>
                                    </td>

                                    <!-- Service Pill -->
                                    <td class="px-5 py-4 text-left rtl:text-right">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-purple-50 text-[#2B0C54] border border-purple-100 text-xs font-semibold" x-text="lead.service_interest"></span>
                                    </td>

                                    <!-- UTM Badge -->
                                    <td class="px-5 py-4 text-left rtl:text-right whitespace-nowrap">
                                        <template x-if="lead.utm_source">
                                            <div>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100 text-xs font-semibold" x-text="lead.utm_source"></span>
                                                <template x-if="lead.utm_campaign">
                                                    <div class="text-[11px] text-gray-400 mt-0.5 truncate max-w-[140px]" :title="lead.utm_campaign" x-text="lead.utm_campaign"></div>
                                                </template>
                                            </div>
                                        </template>
                                        <template x-if="!lead.utm_source">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-gray-100 text-gray-500 text-xs font-medium" x-text="lang==='ar' ? 'مباشر (Direct)' : 'Direct'"></span>
                                        </template>
                                    </td>

                                    <!-- Created Date -->
                                    <td class="px-5 py-4 text-left rtl:text-right whitespace-nowrap text-xs text-gray-500">
                                        <span dir="ltr" class="inline-block" x-text="formatDate(lead.created_at)"></span>
                                    </td>

                                    <!-- Color-Coded Status Select -->
                                    <td class="px-5 py-4 text-left rtl:text-right whitespace-nowrap">
                                        <select
                                            @change="updateLeadStatus(lead, $event.target.value)"
                                            :class="statusBadgeClass(lead.status)"
                                            class="rounded-xl px-3 py-1.5 text-xs font-bold border focus:outline-none focus:ring-2 focus:ring-purple-500 cursor-pointer transition"
                                        >
                                            <template x-for="st in ['New','Contacted','Scheduled','Archived']" :key="st">
                                                <option :value="st" :selected="lead.status === st" class="bg-white text-gray-800 font-medium" x-text="statusLabel(st)"></option>
                                            </template>
                                        </select>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Case Images -->
        <div x-show="tab==='cases'" x-cloak class="bg-white rounded-2xl shadow-sm border border-purple-100/80 p-4 sm:p-6 space-y-5">
            <h2 class="text-lg font-bold" x-text="lang==='ar' ? 'رفع صور الحالات لكل خدمة' : 'Manage Case Images per Service'"></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <div>
                    <label class="block text-xs font-semibold mb-1">Service</label>
                    <select x-model="selectedServiceId" @change="loadSelectedServiceImages" class="w-full border rounded-xl px-3 py-2 text-sm">
                        <template x-for="svc in services" :key="svc.id">
                            <option :value="svc.id" x-text="lang==='ar' ? svc.name_ar : svc.name_en"></option>
                        </template>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1">Caption</label>
                    <input type="text" x-model="caseCaption" placeholder="Before & After" class="w-full border rounded-xl px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1">Upload Images</label>
                    <input type="file" multiple accept="image/*" @change="uploadCases($event)" class="w-full text-sm">
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4">
                <template x-for="img in currentCaseImages" :key="img.id">
                    <div class="border rounded-xl overflow-hidden bg-gray-50">
                        <img :src="img.image_url" class="w-full h-36 object-cover">
                        <div class="p-2 flex justify-between items-center text-xs">
                            <span class="truncate" x-text="img.caption || 'Case'"></span>
                            <button @click="deleteCase(img.id)" class="text-red-600 font-semibold">Delete</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Who We Are Bilingual Editor -->
        <div x-show="tab==='content'" x-cloak class="bg-white rounded-2xl shadow-sm border border-purple-100/80 p-4 sm:p-6 max-w-3xl space-y-4">
            <h2 class="text-lg font-bold" x-text="lang==='ar' ? 'تعديل قسم من نحن (عربي / إنكليزي)' : 'Edit Who We Are (EN & AR)'"></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-3">
                    <label class="block text-xs font-bold text-purple-800">English</label>
                    <input type="text" x-model="whoWeAre.title_en" placeholder="Title (EN)" class="w-full border rounded-xl px-3 py-2 text-sm">
                    <input type="text" x-model="whoWeAre.subtitle_en" placeholder="Subtitle (EN)" class="w-full border rounded-xl px-3 py-2 text-sm">
                    <textarea x-model="whoWeAre.body_en" rows="4" placeholder="Body (EN)" class="w-full border rounded-xl px-3 py-2 text-sm"></textarea>
                </div>
                <div class="space-y-3" dir="rtl">
                    <label class="block text-xs font-bold text-purple-800">العربية</label>
                    <input type="text" x-model="whoWeAre.title_ar" placeholder="العنوان" class="w-full border rounded-xl px-3 py-2 text-sm">
                    <input type="text" x-model="whoWeAre.subtitle_ar" placeholder="العنوان الفرعي" class="w-full border rounded-xl px-3 py-2 text-sm">
                    <textarea x-model="whoWeAre.body_ar" rows="4" placeholder="النص" class="w-full border rounded-xl px-3 py-2 text-sm"></textarea>
                </div>
            </div>
            <button @click="saveWhoWeAre" class="bg-[#2B0C54] text-white px-5 py-2.5 rounded-xl text-sm font-semibold">Save Changes</button>
        </div>

        <!-- Change Password -->
        <div x-show="tab==='password'" x-cloak class="bg-white rounded-2xl shadow-sm border border-purple-100/80 p-4 sm:p-6 max-w-md space-y-4">
            <h2 class="text-lg font-bold" x-text="lang==='ar' ? 'تغيير كلمة المرور' : 'Change Dashboard Password'"></h2>
            <input type="password" x-model="pw.current_password" placeholder="Current Password" class="w-full border rounded-xl px-3 py-2 text-sm">
            <input type="password" x-model="pw.new_password" placeholder="New Password (min 8 chars)" class="w-full border rounded-xl px-3 py-2 text-sm">
            <input type="password" x-model="pw.new_password_confirmation" placeholder="Confirm New Password" class="w-full border rounded-xl px-3 py-2 text-sm">
            <button @click="changePassword" class="bg-[#2B0C54] text-white px-5 py-2.5 rounded-xl text-sm font-semibold">Update Password</button>
        </div>
    </main>

    <script>
        function adminApp() {
            const token = localStorage.getItem('benew_token') || '';
            const headers = () => ({ 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' });

            return {
                lang: 'en',
                tab: 'leads',
                notice: '',
                leads: [],
                leadSearch: '',
                statusFilter: '',
                services: @json($services),
                selectedServiceId: {{ $services->first()?->id ?? 1 }},
                currentCaseImages: [],
                caseCaption: '',
                whoWeAre: {
                    title_en: @json($whoWeAre->title_en ?? 'Who We Are'),
                    title_ar: @json($whoWeAre->title_ar ?? 'من نحن'),
                    subtitle_en: @json($whoWeAre->subtitle_en ?? ''),
                    subtitle_ar: @json($whoWeAre->subtitle_ar ?? ''),
                    body_en: @json($whoWeAre->body_en ?? ''),
                    body_ar: @json($whoWeAre->body_ar ?? ''),
                },
                pw: { current_password: '', new_password: '', new_password_confirmation: '' },

                init() { this.fetchLeads(); this.loadSelectedServiceImages(); },
                toggleLang() {
                    this.lang = this.lang === 'en' ? 'ar' : 'en';
                    document.documentElement.dir = this.lang === 'ar' ? 'rtl' : 'ltr';
                },
                statusLabel(st) {
                    if (this.lang !== 'ar') return st;
                    const map = { All: 'الكل', New: 'جديد', Contacted: 'تم التواصل', Scheduled: 'موعد مؤكد', Archived: 'مؤرشف' };
                    return map[st] || st;
                },
                statusBadgeClass(st) {
                    const map = {
                        New: 'bg-blue-50 text-blue-700 border-blue-200',
                        Contacted: 'bg-amber-50 text-amber-800 border-amber-200',
                        Scheduled: 'bg-emerald-50 text-emerald-700 border-emerald-200',
                        Archived: 'bg-gray-100 text-gray-600 border-gray-200',
                    };
                    return map[st] || 'bg-gray-50 text-gray-700 border-gray-200';
                },
                formatDate(dt) {
                    if (!dt) return '-';
                    return dt.slice(0, 16);
                },
                async fetchLeads() {
                    const params = new URLSearchParams();
                    if (this.leadSearch) params.set('search', this.leadSearch);
                    if (this.statusFilter) params.set('status', this.statusFilter);
                    const res = await fetch('/api/v1/admin/leads?' + params.toString(), { headers: headers() });
                    if (res.status === 401) return window.location.href = '/admin/login';
                    const json = await res.json();
                    this.leads = json.data || [];
                },
                async updateLeadStatus(lead, status) {
                    const res = await fetch('/api/v1/admin/leads/' + lead.id, {
                        method: 'PATCH',
                        headers: { ...headers(), 'Content-Type': 'application/json' },
                        body: JSON.stringify({ status }),
                    });
                    if (res.ok) {
                        lead.status = status;
                        this.notice = this.lang === 'ar' ? 'تم تحديث حالة الطلب بنجاح.' : 'Lead status updated.';
                    }
                },
                async exportCsv() {
                    const res = await fetch('/api/v1/admin/leads/export', { headers: headers() });
                    if (res.status === 401) return window.location.href = '/admin/login';
                    const blob = await res.blob();
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'benew-leads-' + new Date().toISOString().slice(0, 10) + '.csv';
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    URL.revokeObjectURL(url);
                },
                loadSelectedServiceImages() {
                    const svc = this.services.find(s => s.id == this.selectedServiceId);
                    this.currentCaseImages = svc ? (svc.case_images || []) : [];
                },
                async uploadCases(e) {
                    const files = e.target.files;
                    if (!files.length) return;
                    const fd = new FormData();
                    for (const f of files) fd.append('images[]', f);
                    fd.append('caption', this.caseCaption);
                    const res = await fetch('/api/v1/admin/services/' + this.selectedServiceId + '/cases', {
                        method: 'POST', headers: headers(), body: fd,
                    });
                    const json = await res.json();
                    if (res.ok) {
                        const svc = this.services.find(s => s.id == this.selectedServiceId);
                        svc.case_images = [...(svc.case_images || []), ...json.data];
                        this.loadSelectedServiceImages();
                        this.notice = 'Case images uploaded.';
                    }
                },
                async deleteCase(id) {
                    const res = await fetch('/api/v1/admin/cases/' + id, { method: 'DELETE', headers: headers() });
                    if (res.ok) {
                        const svc = this.services.find(s => s.id == this.selectedServiceId);
                        svc.case_images = svc.case_images.filter(i => i.id !== id);
                        this.loadSelectedServiceImages();
                        this.notice = 'Case image deleted.';
                    }
                },
                async saveWhoWeAre() {
                    const res = await fetch('/api/v1/admin/content/who_we_are', {
                        method: 'PUT',
                        headers: { ...headers(), 'Content-Type': 'application/json' },
                        body: JSON.stringify(this.whoWeAre),
                    });
                    if (res.ok) this.notice = '"Who We Are" updated successfully.';
                },
                async changePassword() {
                    const res = await fetch('/api/v1/admin/password', {
                        method: 'PUT',
                        headers: { ...headers(), 'Content-Type': 'application/json' },
                        body: JSON.stringify(this.pw),
                    });
                    const json = await res.json();
                    this.notice = json.message || 'Done.';
                    if (res.ok) this.pw = { current_password: '', new_password: '', new_password_confirmation: '' };
                },
                async logout() {
                    await fetch('/api/v1/auth/logout', { method: 'POST', headers: headers() });
                    localStorage.removeItem('benew_token');
                    window.location.href = '/admin/login';
                }
            }
        }
    </script>
</body>
</html>

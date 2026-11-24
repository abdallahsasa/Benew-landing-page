<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benew® Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen" x-data="adminApp()" x-init="init()">
    <header class="bg-[#1E083B] text-white px-4 sm:px-8 py-4 flex flex-wrap items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/benew-logo.jpg') }}" alt="Benew" class="h-9 rounded">
            <span class="font-bold" x-text="lang==='ar' ? 'لوحة تحكم Benew®' : 'Benew® Dashboard'"></span>
        </div>
        <div class="flex items-center gap-3 text-xs sm:text-sm">
            <button @click="toggleLang" class="bg-white/10 px-3 py-1.5 rounded-lg font-bold" x-text="lang==='ar' ? 'EN' : 'عربي'"></button>
            <a href="/" target="_blank" class="bg-white/10 px-3 py-1.5 rounded-lg hover:bg-white/20" x-text="lang==='ar' ? 'عرض الموقع' : 'View Site'"></a>
            <button @click="logout" class="bg-red-500 px-3 py-1.5 rounded-lg hover:bg-red-400" x-text="lang==='ar' ? 'خروج' : 'Logout'"></button>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-8 py-6">
        <div class="flex flex-wrap gap-2 mb-6">
            <button @click="tab='leads'" :class="tab==='leads' ? 'bg-[#2B0C54] text-white' : 'bg-white'" class="px-4 py-2 rounded-xl text-sm font-semibold border" x-text="lang==='ar' ? 'العملاء (Leads)' : 'Leads CRM'"></button>
            <button @click="tab='cases'" :class="tab==='cases' ? 'bg-[#2B0C54] text-white' : 'bg-white'" class="px-4 py-2 rounded-xl text-sm font-semibold border" x-text="lang==='ar' ? 'صور الحالات' : 'Case Images'"></button>
            <button @click="tab='content'" :class="tab==='content' ? 'bg-[#2B0C54] text-white' : 'bg-white'" class="px-4 py-2 rounded-xl text-sm font-semibold border" x-text="lang==='ar' ? 'تعديل من نحن' : 'Who We Are'"></button>
            <button @click="tab='password'" :class="tab==='password' ? 'bg-[#2B0C54] text-white' : 'bg-white'" class="px-4 py-2 rounded-xl text-sm font-semibold border" x-text="lang==='ar' ? 'تغيير كلمة المرور' : 'Change Password'"></button>
        </div>

        <template x-if="notice">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-4 text-sm" x-text="notice"></div>
        </template>

        <!-- Leads -->
        <div x-show="tab==='leads'" class="bg-white rounded-2xl shadow-sm border p-4 sm:p-6">
            <div class="flex flex-wrap justify-between items-center gap-3 mb-4">
                <h2 class="text-lg font-bold" x-text="lang==='ar' ? 'العملاء المحتملين' : 'Leads'"></h2>
                <div class="flex flex-wrap gap-2">
                    <input type="text" x-model="leadSearch" @input.debounce.400ms="fetchLeads" placeholder="Search..." class="border rounded-lg px-3 py-1.5 text-sm">
                    <a href="/api/v1/admin/leads/export" class="bg-emerald-600 text-white text-sm px-3 py-1.5 rounded-lg">Export CSV</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-start">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr><th class="p-3">Name</th><th class="p-3">Phone</th><th class="p-3">Service</th><th class="p-3">UTM</th><th class="p-3">Status</th></tr>
                    </thead>
                    <tbody>
                        <template x-for="lead in leads" :key="lead.id">
                            <tr class="border-t">
                                <td class="p-3 font-medium" x-text="lead.full_name"></td>
                                <td class="p-3" dir="ltr" x-text="lead.phone"></td>
                                <td class="p-3" x-text="lead.service_interest"></td>
                                <td class="p-3 text-xs text-gray-500" x-text="lead.utm_source || '-'"></td>
                                <td class="p-3">
                                    <select @change="updateLeadStatus(lead.id, $event.target.value)" class="border rounded-lg px-2 py-1 text-xs">
                                        <template x-for="st in ['New','Contacted','Scheduled','Archived']">
                                            <option :value="st" :selected="lead.status === st" x-text="st"></option>
                                        </template>
                                    </select>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Case Images -->
        <div x-show="tab==='cases'" class="bg-white rounded-2xl shadow-sm border p-4 sm:p-6 space-y-5">
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
        <div x-show="tab==='content'" class="bg-white rounded-2xl shadow-sm border p-4 sm:p-6 max-w-3xl space-y-4">
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
        <div x-show="tab==='password'" class="bg-white rounded-2xl shadow-sm border p-4 sm:p-6 max-w-md space-y-4">
            <h2 class="text-lg font-bold" x-text="lang==='ar' ? 'تغيير كلمة المرور' : 'Change Dashboard Password'"></h2>
            <input type="password" x-model="pw.current_password" placeholder="Current Password" class="w-full border rounded-xl px-3 py-2 text-sm">
            <input type="password" x-model="pw.new_password" placeholder="New Password (min 8 chars)" class="w-full border rounded-xl px-3 py-2 text-sm">
            <input type="password" x-model="pw.new_password_confirmation" placeholder="Confirm New Password" class="w-full border rounded-xl px-3 py-2 text-sm">
            <button @click="changePassword" class="bg-[#2B0C54] text-white px-5 py-2.5 rounded-xl text-sm font-semibold">Update Password</button>
        </div>
    </div>

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
                async fetchLeads() {
                    const res = await fetch('/api/v1/admin/leads?search=' + encodeURIComponent(this.leadSearch), { headers: headers() });
                    if (res.status === 401) return window.location.href = '/admin/login';
                    const json = await res.json();
                    this.leads = json.data || [];
                },
                async updateLeadStatus(id, status) {
                    await fetch('/api/v1/admin/leads/' + id, {
                        method: 'PATCH',
                        headers: { ...headers(), 'Content-Type': 'application/json' },
                        body: JSON.stringify({ status }),
                    });
                    this.notice = 'Lead status updated.';
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

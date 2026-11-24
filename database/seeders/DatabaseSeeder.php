<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\SiteContent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@benew.com'],
            [
                'name' => 'Benew Admin',
                'password' => Hash::make('Benew@2026!'),
            ]
        );

        $dentalServices = [
            ['en' => 'Filling', 'ar' => 'حشوات الأسنان', 'desc_en' => 'Tooth-colored aesthetic composite fillings for natural, durable cavity restoration.', 'desc_ar' => 'حشوات تجميلية بلون السن الطبيعي لترميم متين وجميل.'],
            ['en' => 'Orthodontic', 'ar' => 'تقويم الأسنان', 'desc_en' => 'Modern braces and clear aligners designed for balanced bite and confident alignment.', 'desc_ar' => 'تقويم شفاف ومعدني حديث لتناسق الأسنان وتوازن الإطباق.'],
            ['en' => 'Normal Gingivectomy', 'ar' => 'قص اللثة العادي', 'desc_en' => 'Gentle gum contouring to frame your teeth symmetrically and enhance your smile line.', 'desc_ar' => 'تحديد وتنسيق اللثة بلطف لإبراز جمال الابتسامة.'],
            ['en' => 'Dentures', 'ar' => 'أطقم الأسنان', 'desc_en' => 'Custom-fitted full and partial dentures engineered for comfort and natural aesthetics.', 'desc_ar' => 'أطقم أسنان كاملة وجزئية مصممة للراحة والمظهر الطبيعي.'],
            ['en' => 'Jaw Surgery', 'ar' => 'جراحة الفكين', 'desc_en' => 'Corrective orthognathic jaw procedures restoring facial harmony and bite function.', 'desc_ar' => 'جراحة تقويم الفكين لاستعادة تناسق الوجه ووظيفة المضغ.'],
            ['en' => 'Laser Whitening', 'ar' => 'تبييض الأسنان بالليزر', 'desc_en' => 'Fast, enamel-safe in-clinic laser whitening for visibly brighter teeth in a single visit.', 'desc_ar' => 'تبييض فوري وآمن على المينا بالليزر خلال زيارة واحدة.'],
            ['en' => 'Root Canal Treatment', 'ar' => 'علاج الجذور (العصب)', 'desc_en' => 'Pain-free endodontic care to save natural teeth using precision digital imaging.', 'desc_ar' => 'علاج جذور بدون ألم للحفاظ على الأسنان الطبيعية.'],
            ['en' => 'Bone Grafts', 'ar' => 'تطعيم العظم', 'desc_en' => 'Regenerative bone grafting to build a strong foundation prior to dental implants.', 'desc_ar' => 'زراعة وتطعيم العظم لتهيئة أساس قوي قبل زراعة الأسنان.'],
            ['en' => 'Dental Implant', 'ar' => 'زراعة الأسنان', 'desc_en' => 'Biocompatible titanium and zirconia implants that look, feel, and function like natural teeth.', 'desc_ar' => 'غرسات أسنان متوافقة حيوياً بمظهر ووظيفة الأسنان الطبيعية.'],
            ['en' => 'Porcelain Crown', 'ar' => 'تاج البورسلين', 'desc_en' => 'Custom-crafted porcelain crowns restoring strength, shape, and natural translucency.', 'desc_ar' => 'تيجان بورسلين مصممة بدقة لاستعادة القوة والشكل الطبيعي.'],
            ['en' => 'Lumineers', 'ar' => 'اللومينير', 'desc_en' => 'Ultra-thin, minimal-prep veneers for a radiant smile makeover without sensitivity.', 'desc_ar' => 'عدسات فائقة الرقة بدون برد للأسنان لابتسامة مشرقة.'],
            ['en' => 'Emax Crowns', 'ar' => 'تيجان الإيماكس', 'desc_en' => 'High-strength lithium disilicate crowns offering lifelike aesthetics.', 'desc_ar' => 'تيجان إيماكس عالية القوة والشفافية الجمالية.'],
            ['en' => 'Emax Veneer Lenses', 'ar' => 'عدسات فينير الإيماكس', 'desc_en' => 'Precision Emax veneer lenses tailored for Hollywood Smile transformations.', 'desc_ar' => 'عدسات فينير إيماكس دقيقة المصممة لابتسامة هوليوود.'],
            ['en' => 'Zirconium Crowns', 'ar' => 'تيجان الزيركون', 'desc_en' => 'Metal-free, biocompatible zirconium crowns combining durability with natural beauty.', 'desc_ar' => 'تيجان زيركون خالية من المعادن تجمع بين المتانة والجمال.'],
        ];

        foreach ($dentalServices as $index => $item) {
            Service::updateOrCreate(
                ['slug' => Str::slug($item['en'])],
                [
                    'name_en' => $item['en'],
                    'name_ar' => $item['ar'],
                    'category' => 'dental',
                    'short_description_en' => $item['desc_en'],
                    'short_description_ar' => $item['desc_ar'],
                    'display_order' => $index + 1,
                ]
            );
        }

        Service::updateOrCreate(
            ['slug' => 'plastic-surgery-consultation'],
            [
                'name_en' => 'Plastic Surgery Consultation',
                'name_ar' => 'استشارة جراحة التجميل',
                'category' => 'plastic_surgery',
                'short_description_en' => 'Comprehensive facial and body aesthetic surgery consultations tailored to your goals.',
                'short_description_ar' => 'استشارات شاملة لجراحات تجميل الوجه والجسم المصممة خصيصاً لأهدافك.',
                'display_order' => 15,
            ]
        );

        SiteContent::updateOrCreate(
            ['section_key' => 'who_we_are'],
            [
                'title_en' => 'Who We Are',
                'title_ar' => 'من نحن',
                'subtitle_en' => 'Be New To Be Fine — Precision Dentistry & Aesthetic Excellence',
                'subtitle_ar' => 'Be New To Be Fine — طب الأسنان الدقيق والتميز التجميلي',
                'body_en' => 'At Benew®, we combine advanced digital dentistry with specialized aesthetic medicine to craft natural, long-lasting results tailored to every patient.',
                'body_ar' => 'في عيادة Benew®، نجمع بين طب الأسنان الرقمي المتقدم والطب التجميلي المتخصص لنقدم نتائج طبيعية وآمنة تدوم طويلاً ومصممة لكل مريض.',
            ]
        );
    }
}

<?php

use Illuminate\Database\Seeder;
use Admission\Models\OnlineRegisterMessages;

class AdmissionSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OnlineRegisterMessages::create([
            'durationParentInterview' => '29',
            'durationAssessmentTest' => '60',
            'offDays' => 'Friday',
            'defaultPaid' => 'جاري مراجعة البيانات وفي انتظار استلام الاوراق ورسوم فتح الملف',
            'paidText' => 'تم سداد رسوم فتح الملف واستلام الاوراق',
            'defaultParentInterview' => 'لم يتم تحديد ميعاد مقابلة',
            'parentInterviewBeforeSetDate' => 'يمكنك الان تحديد ميعاد المقابلة',
            'parentInterviewSetDate' => 'تم تحديد ميعاد المقابلة.. ستتم المقابلة من خلال برنامج زووم الرجاء كن مستعدا في الميعاد المحدد. يمكن تنزيل تطبيق زووم من خلال المتجر جوجل لهاتف اندرويد',
            'parentAfterInterview' => 'سيتم التواصل معك لابلاغك بنتيجة المقابلة',
            'parentInterviewRejected' => 'لم تتم المقابلة بنجاح',
            'parentInterviewAccepted' => 'تمت المقابلة بنجاح',
            'defaultOpenAssessment' => 'لم يتم تحديد ميعاد اختبار التقييم',
            'assessmentBeforeSetDate' => 'يمكنك الان تحديد اختبار التقييم للمتقدم',
            'assessmentSetDate' => 'تحديد ميعاد اختبار التقييم.. ستتم المقابلة من خلال برنامج زووم الرجاء كن مستعدا في الميعاد المحدد',
            'afterAssessment' => 'سيتم التواصل معك لبلاغك بنتيجة اختبار القبول',
            'assessmentRejected' => 'لم يتم اجتياز اختبار القبول',
            'assessmentAccepted' => 'تم اجتياز اختبار القبول - الرجاء تجهيز الاوراق المطلوبة',
            'parentInterviewDuration' => '29',
            'assessmentTestDuration' => '29',
            'allowedDays' => '14',
            'defaultInstallmentMsg' => 'سيتم تحديد فترة سداد القسط الاول بعد اعلان نتيجة قبول المتقدم',
            'installmentAfterResultMsg' => 'يمكنك الان تحديد ميعاد سداد القسط الاول مع مراعاة اخر ميعاد سداد - الرجاء تجهيز الاوراق المطلوبة لتسليمها مع القسط الاول',
            'installmentAfterSetDateMsg' => 'تم تحديد الميعاد بنجاح .. وسيتم التواصل لتأكيد الميعاد',
            'installmentAfterPaiedMsg' => 'تم سداد القسط الاول',
            'beforeSetReassessmentDate' => 'يمكنك تحديد ميعاد اختبار اعادة التقييم',
            'afterSetReassessmentDate' => 'تم تحديد الميعاد.. يرجى الاستعداد في الموعد المحدد',
            'afterReassessmentDone' => 'سيتم التواصل معك وابلاغك بنتيجة الاختبار',
            'reAssessmentRejected' => 'لم يتم اجتياز اختبار اعادة التقييم',
            'reAssessmentAccepeted' => 'تم اجتياز اختبار اعادة التقييم'
        ]);
    }
}

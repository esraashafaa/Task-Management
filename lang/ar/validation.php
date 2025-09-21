<?php

return [
    'required' => 'حقل :attribute مطلوب.',
    'string' => 'يجب أن يكون :attribute نص.',
    'max' => [
        'string' => 'لا يجب أن يتجاوز :attribute :max حرف.',
    ],
    'min' => [
        'string' => 'يجب أن يكون :attribute على الأقل :min حرف.',
    ],
    'integer' => 'يجب أن يكون :attribute رقم صحيح.',
    'exists' => 'الـ :attribute المحدد غير صحيح.',
    'nullable' => 'حقل :attribute اختياري.',
    
    'attributes' => [
        'title' => 'عنوان المهمة',
        'description' => 'وصف المهمة',
        'project_id' => 'المشروع',
        'assigned_to' => 'المستخدم المعين',
    ],
];

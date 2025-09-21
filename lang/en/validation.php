<?php

return [
    'required' => 'The :attribute field is required.',
    'string' => 'The :attribute must be a string.',
    'max' => [
        'string' => 'The :attribute may not be greater than :max characters.',
    ],
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'integer' => 'The :attribute must be an integer.',
    'exists' => 'The selected :attribute is invalid.',
    'nullable' => 'The :attribute field is optional.',
    
    'attributes' => [
        'title' => 'task title',
        'description' => 'task description',
        'project_id' => 'project',
        'assigned_to' => 'assigned user',
    ],
];

<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    //login rule

    public $login = [
        'email' => 'trim|required|valid_email',
        'password' => 'required|min_length[6]|max_length[20]'
    ];
     
    public $login_errors = [
        'email' => [
            'required'      => 'email wajib diisi',
            'valid_email'    => 'email tidak valid'
        ],
        'password' => [
            'required'      => 'Password wajib diisi',
            'min_length'    => 'Password minimal terdiri dari 6 karakter',
            'max_length'    => 'Password maksimal terdiri dari 20 karakter'
        ]
    ];

    //request reset password rule
    public $request = [
        'email' => 'trim|required|valid_email'
    ];

    public $request_errors = [
        'email' => [
            'required'      => 'Email wajib diisi',
            "valid_email" => "Email tidak valid"
        ]
    ];
}

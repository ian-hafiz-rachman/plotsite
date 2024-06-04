<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
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
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    // Define validation rules for the "film" group
    public $film = [
        'title' => 'required|max_length[255]',
        'genre' => 'required|max_length[255]',
        'rilis' => 'required|valid_date[Y-m-d]',
        'synopsis' => 'required',
        'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
        'trailer' => 'valid_url'
    ];

    public $film_errors = [
        'title' => [
            'required' => 'Title is required.',
            'min_length' => 'Title must be at least 3 characters long.',
            'max_length' => 'Title cannot exceed 255 characters.',
        ],
        'synopsis' => [
            'required' => 'Synopsis is required.',
        ],
        'image' => [
            'uploaded' => 'You must upload an image.',
            'max_size' => 'Image size cannot exceed 1MB.',
            'is_image' => 'Uploaded file must be an image.',
            'mime_in' => 'Image must be of type jpg, jpeg, or png.',
        ],
        'genre' => [
            'required' => 'Genre is required.',
        ],
        'rilis' => [
            'required' => 'Release date is required.',
            'valid_date' => 'Release date is not valid.',
        ],
    ];
}

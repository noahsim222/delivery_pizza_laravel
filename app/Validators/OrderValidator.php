<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class OrderValidator.
 *
 * @package namespace App\Validators;
 */
class OrderValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'delivery.address' => 'required',
            'delivery.customer_name' => 'required',
            'delivery.customer_phone' => 'required',
            'items' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}

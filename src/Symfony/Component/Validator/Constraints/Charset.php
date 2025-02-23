<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * @author Alexandre Daubois <alex.daubois@gmail.com>
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class Charset extends Constraint
{
    public const BAD_ENCODING_ERROR = '94c5e58b-f892-4e25-8fd6-9d89c80bfe81';

    protected const ERROR_NAMES = [
        self::BAD_ENCODING_ERROR => 'BAD_ENCODING_ERROR',
    ];

    public array|string $encodings = [];
    public string $message = 'The detected character encoding is invalid ({{ detected }}). Allowed encodings are {{ encodings }}.';

    public function __construct(array|string $encodings = null, string $message = null, array $groups = null, mixed $payload = null, array $options = null)
    {
        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
        $this->encodings = (array) ($encodings ?? $this->encodings);

        if ([] === $this->encodings) {
            throw new ConstraintDefinitionException(sprintf('The "%s" constraint requires at least one encoding.', static::class));
        }
    }
}

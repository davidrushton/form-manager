<?php
namespace FormManager\Attributes;

class Multiple
{
    /**
     * Callback used on add this attribute to an input
     *
     * @param InputInterface $input The input in which the attribute will be added
     * @param mixed          $value The value of this attribute
     *
     * @return mixed $value The value sanitized
     */
    public static function onAdd($input, $value)
    {
        if (!is_bool($value)) {
            throw new \InvalidArgumentException('The multiple value must be a boolean');
        }

        if ($value && ($name = $input->attr('name')) && (substr($name, -2) !== '[]')) {
            $input->attr('name', $name.'[]');
        }

        return $value;
    }
}

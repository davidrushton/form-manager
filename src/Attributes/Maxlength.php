<?php
namespace FormManager\Attributes;

class Maxlength
{
    public static $error_message = 'The max length allowed is %s';

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
        if (!is_int($value) || ($value < 0)) {
            throw new \InvalidArgumentException('The maxlength value must be a non-negative integer');
        }

        $input->addValidator('maxlength', array(__CLASS__, 'validate'));

        return $value;
    }

    /**
     * Callback used on remove this attribute from an input
     *
     * @param InputInterface $input The input from the attribute will be removed
     */
    public static function onRemove($input)
    {
        $input->removeValidator('maxlength');
    }

    /**
     * Validates the input value according to this attribute
     *
     * @param InputInterface $input The input to validate
     *
     * @return string|true True if its valid, string with the error if not
     */
    public static function validate($input)
    {
        $value = $input->val();
        $attr = $input->attr('maxlength');

        return (empty($attr) || (strlen($value) <= $attr)) ? true : sprintf(static::$error_message, $attr);
    }
}

<?php
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Api\Controller\Admin;

class CustomFieldsCallbacks
{
    public function appwebInputCallback($input)
    {
        return $input;
    }

    public function appwebAdminSection()
    {
        echo "Check this beautiful section!";
    }

    public function appwebTextExample()
    {
        $value = esc_attr(get_option('text_example'));
        echo "<input type='text' class='regular-text' name='text_example' value='$value' placeholder='Placeholder'>";
    }

    public function appwebFirstName()
    {
        $value = esc_attr(get_option('first_name'));
        echo "<input type='text' class='regular-text' name='first_name' value='$value' placeholder='First name'>";
    }
}
<?php
/*

Plugin Name: wooCheckout-plugin

*/


/**
 * Add the field to the checkout
 */
// Add custom checkout field: woocommerce_review_order_before_submit

add_action('woocommerce_after_order_notes', 'my_custom_checkout_fields');

function my_custom_checkout_fields()
{
    echo '<div id="my_custom_checkout_field">';

    woocommerce_form_field('my_field_name_checkbox', array(
        'type'      => 'checkbox',
        'class'     => array('input-checkbox'),
        'label'     => __('My custom checkbox'),
    ),  WC()->checkout->get_value('my_field_name_checkbox'));
    echo '</div>';

    echo '<div id="my_custom_checkout_field">';

    woocommerce_form_field('my_field_name', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Message for the gift'),
        'placeholder'   => __('Enter Message'),
    ),  WC()->checkout->get_value('my_field_name'));

    echo '</div>';
}

// Save the custom checkout field in the order meta, when checkbox has been checked
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );


function my_custom_checkout_field_update_order_meta($order_id)
{

    if (!empty($_POST['my_field_name_checkbox']))
        update_post_meta($order_id, 'My Field', $_POST['my_field_name_checkbox']);

        if (!empty($_POST['my_field_name'])) {
            update_post_meta($order_id, 'My Field', sanitize_text_field($_POST['my_field_name']));
        }
        
}

// Display the custom field result on the order edit page (backend) when checkbox has been checked
add_action('woocommerce_admin_order_data_after_billing_address', 'display_custom_field_on_order_edit_pages', 10, 1);
function display_custom_field_on_order_edit_pages($order)
{

    if(get_post_meta($order->get_id(), 'My Field', true == 1))
    echo '<p><strong>' . __('My Field') . ':</strong> ' . get_post_meta($order->get_id(), 'My Field', true) . '</p>';


    echo '<p><strong>My custom field: </strong> <span style="color:red;">Is enabled</span></p>';
    
}

<?php
/**
* Plugin Name: Extra Product Options
* Plugin URI: https://www.st-extra-product-options.com/
* Description: Adding Additional Product Options in your Websites.
* Version: 1.0
* Author: Supreme Technologies
* Author URI: https://www.st-extra-product-options.com/
**/


// Step 1: Create Custom Field

function add_delivery_charge_field() {
    woocommerce_wp_text_input(array(
        'id' => '_delivery_charge',
        'label' => __('Delivery Charge ($)', 'woocommerce'),
        'desc_tip' => 'true',
        'description' => __('Enter the delivery charge for this product.', 'woocommerce'),
   		)
	);
 }
add_action('woocommerce_product_options_general_product_data', 'add_delivery_charge_field');

// Step 2: Save Custom Field Data

function save_delivery_charge_field($post_id) {
    $delivery_charge = isset($_POST['_delivery_charge']) ? sanitize_text_field($_POST['_delivery_charge']) : '';
    update_post_meta($post_id, '_delivery_charge', $delivery_charge);
}
add_action('woocommerce_process_product_meta', 'save_delivery_charge_field');

// Step 3: Display Checkbox on Product Page

function display_delivery_charge_checkbox() {
    echo '<div class="delivery-charge-checkbox">';

	$delivery_charge = get_post_meta(get_the_ID(), '_delivery_charge', true);
	echo  'Fast Delivery Charges ' . ' $ ' . $delivery_charge;

    woocommerce_form_field('delivery_charge_checkbox', array(
        'type' => 'checkbox',
        'class' => array('input-checkbox'),
        'label' => __('Add Delivery Charges', 'woocommerce'),
		'required' => false,
    ));
    echo '</div>';
}
add_action('woocommerce_before_add_to_cart_button', 'display_delivery_charge_checkbox');

// Step 4: Calculate and Update Total Amount

// Save user fast delivery choice
function save_user_fast_delivery_choice($cart_item_data, $product_id) {
    if (isset($_POST['delivery_charge_checkbox']) && $_POST['delivery_charge_checkbox'] == '1') {
        $cart_item_data['delivery_cost'] = true;
    }
    return $cart_item_data;
}

add_filter('woocommerce_add_cart_item_data', 'save_user_fast_delivery_choice', 10, 2);

// Step 5: Display Charges on Cart and Checkout

function total_cart_calculate_fees( $cart_object ) {
    echo '<pre>';
    // print_r($cart_object);
    echo '</pre>';
	foreach ($cart_object->cart_contents as $cart_item_key => $cart) {
		if (isset($cart['delivery_cost']) && $cart['delivery_cost']) {
			$admin_fast_delivery_cost = get_post_meta($cart['product_id'], '_delivery_charge', true);
		}
	}
		WC()->cart->add_fee( __( 'Delivery Charge', 'woocommerce' ) , $admin_fast_delivery_cost );
	}
	  add_action( 'woocommerce_cart_calculate_fees', 'total_cart_calculate_fees' );









//												step	one

function st_name_field() {
    woocommerce_wp_text_input(array(
        'id' => 'st_name_field',
		'label' => __('Name', 'woocommerce'),
		'desc_tip' => 'true',
        'description' => __('Enter the Name of this fields.', 'woocommerce'),
  	  ));
  }
add_action('woocommerce_product_options_general_product_data', 'st_name_field');

function save_st_name_field($post_id) {
    $st_name_field = isset($_POST['st_name_field']) ? sanitize_text_field($_POST['st_name_field']) : '';
    update_post_meta($post_id, 'st_name_field', $st_name_field);
}
add_action('woocommerce_process_product_meta', 'save_st_name_field');

//                                               step   two

function st_charges_field() {
    woocommerce_wp_text_input(array(
        'id' => 'st_charges_field',
        'label' => __('Charges ($)', 'woocommerce'),
        'desc_tip' => 'true',
        'description' => __('Enter the charges of this fields.', 'woocommerce'),
    ));
}
add_action('woocommerce_product_options_general_product_data', 'st_charges_field');

function save_st_charges_field($post_id) {
    $st_charges_field = isset($_POST['st_charges_field']) ? sanitize_text_field($_POST['st_charges_field']) : '';
    update_post_meta($post_id, 'st_charges_field', $st_charges_field);
}
add_action('woocommerce_process_product_meta', 'save_st_charges_field');

//												  step    three

function display_st_charges_fields_checkbox(){
	echo '<div class="display_st_charges_field_checkbox">';

	$st_name_field = get_post_meta(get_the_ID(), 'st_name_field', true);
	$st_charges_field = get_post_meta(get_the_ID(), 'st_charges_field', true);
	
	echo $st_name_field . ' $ ' . $st_charges_field;

		woocommerce_form_field('display_st_charges_field_checkbox', array(
			'type' => 'checkbox',
			'class' => array('charges-checkbox'),
			'label' => __($st_name_field , 'woocommerce'),
			
		));
		echo '</div>';
}
add_action('woocommerce_before_add_to_cart_button','display_st_charges_fields_checkbox');


















        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        








































































































































































































































































































































































































































































// function st_dropdown_field() {
// ?>

<!-- // <label for="dropdown-price">Choose a Size:</label>

// <select name="st_dropdown_price" id="st_dropdown_price">
//   <option value="">Select the Size </option>  
//   <option value="2">Small $2</option>
//   <option value="5">Medium $5</option>
//   <option value="10">Large $10</option>
//   <option value="20">Extra Large $20</option>
// </select> -->
 <?php
// }
// add_action('woocommerce_before_add_to_cart_button', 'st_dropdown_field', 10, 2);



// function product_page_data_save($product_id){

//     $product_id = get_the_ID();

//     $price = sanitize_text_field($_POST['st_dropdown_price']);
//     update_post_meta($product_id, 'st_dropdown_price' ,$price);
// }

// add_filter('woocommerce_add_cart_item_data', 'product_page_data_save', 10, 2);




// function save_st_dropdown_field($cart_item_data , $product_id){
//     if(isset($_POST['st_dropdown_price'])) {
//             $cart_item_data['save_st_dropdown_price'] = true;
//     }
// return $cart_item_data;
// }
// add_filter('woocommerce_add_cart_item_data', 'save_st_dropdown_field', 10, 2);



// function st_dropdown_field() {
// 	woocommerce_wp_select( 	array(
// 			'id' => 'st_dropdown_field',
// 			'label' => __('Product Size', 'woocommerce'),
// 			'options' => array(
// 		 		   '' => __('Select Size','woocommerce'),
// 				  '2' => 'Small $2',
// 				  '5' => 'Medium $5',
// 				 '10' => 'Large $10',
// 				 '20' => 'Extra Large $20',
// 			)
// 		)
// 	);
// }
// add_action('woocommerce_product_options_general_product_data', 'st_dropdown_field', 10, 2);
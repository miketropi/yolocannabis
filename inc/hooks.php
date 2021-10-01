<?php 
/**
 * Hooks
 * 
 */

add_filter('post_age_gate_custom_fields', 'age_gate_custom_fields', 10, 1);

function age_gate_custom_fields($fields){
    $fields .= '<div class="custom-field-location">
                    <label>Select your location</label>
                    <select name="custom-location" id="custom_location">
                        <option value="">Select province</option>
                        <option value="AB">Alberta</option>
                        <option value="BC">British Columbia</option>
                        <option value="MB">Manitoba</option>
                        <option value="NB">New Brunswick</option>
                        <option value="NL">Newfoundland and Labrador</option>
                        <option value="NS">Nova Scotia</option>
                        <option value="ON">Ontario</option>
                        <option value="PE">Prince Edward Island</option>
                        <option value="QC">Quebec</option>
                        <option value="SK">Saskatchewan</option>
                        <option value="NT">Northwest Territories</option>
                        <option value="NU">Nunavut</option>
                        <option value="YT">Yukon</option>
                    </select>
                    <div class="location-error"></div>
                </div>';
    $fields .= '<div class="custom-field-term">
                    <label><input type="checkbox" name="ag_field_terms" value="1" /> I acknowledge that I must be <b>19</b> or older to enter this website and to buy and receive products from yolocannabis.ca</label>
                    <div class="term-error"></div>
                </div>';
    
    return $fields;
}
<?php

//convert country code to name -------------------------------------------------------//
//------------------------------------------------------------------------------------//

function dc_country_code_to_name( $code ){
    $country = '';
    if( $code == 'af' ) $country = 'Afghanistan';
    if( $code == 'ax' ) $country = 'Aland Islands';
    if( $code == 'al' ) $country = 'Albania';
    if( $code == 'dz' ) $country = 'Algeria';
    if( $code == 'as' ) $country = 'American Samoa';
    if( $code == 'ad' ) $country = 'Andorra';
    if( $code == 'ao' ) $country = 'Angola';
    if( $code == 'ai' ) $country = 'Anguilla';
    if( $code == 'aq' ) $country = 'Antarctica';
    if( $code == 'ag' ) $country = 'Antigua and Barbuda';
    if( $code == 'ar' ) $country = 'Argentina';
    if( $code == 'am' ) $country = 'Armenia';
    if( $code == 'aw' ) $country = 'Aruba';
    if( $code == 'au' ) $country = 'Australia';
    if( $code == 'at' ) $country = 'Austria';
    if( $code == 'az' ) $country = 'Azerbaijan';
    if( $code == 'bs' ) $country = 'Bahamas the';
    if( $code == 'bh' ) $country = 'Bahrain';
    if( $code == 'bd' ) $country = 'Bangladesh';
    if( $code == 'bb' ) $country = 'Barbados';
    if( $code == 'by' ) $country = 'Belarus';
    if( $code == 'be' ) $country = 'Belgium';
    if( $code == 'bz' ) $country = 'Belize';
    if( $code == 'bj' ) $country = 'Benin';
    if( $code == 'bm' ) $country = 'Bermuda';
    if( $code == 'bt' ) $country = 'Bhutan';
    if( $code == 'bo' ) $country = 'Bolivia';
    if( $code == 'ba' ) $country = 'Bosnia and Herzegovina';
    if( $code == 'bw' ) $country = 'Botswana';
    if( $code == 'bv' ) $country = 'Bouvet Island (Bouvetoya)';
    if( $code == 'br' ) $country = 'Brazil';
    if( $code == 'io' ) $country = 'British Indian Ocean Territory (Chagos Archipelago)';
    if( $code == 'vg' ) $country = 'British Virgin Islands';
    if( $code == 'bn' ) $country = 'Brunei Darussalam';
    if( $code == 'bg' ) $country = 'Bulgaria';
    if( $code == 'bf' ) $country = 'Burkina Faso';
    if( $code == 'bi' ) $country = 'Burundi';
    if( $code == 'kh' ) $country = 'Cambodia';
    if( $code == 'cm' ) $country = 'Cameroon';
    if( $code == 'ca' ) $country = 'Canada';
    if( $code == 'cv' ) $country = 'Cape Verde';
    if( $code == 'ky' ) $country = 'Cayman Islands';
    if( $code == 'cf' ) $country = 'Central African Republic';
    if( $code == 'td' ) $country = 'Chad';
    if( $code == 'cl' ) $country = 'Chile';
    if( $code == 'cn' ) $country = 'China';
    if( $code == 'cx' ) $country = 'Christmas Island';
    if( $code == 'cc' ) $country = 'Cocos (Keeling) Islands';
    if( $code == 'co' ) $country = 'Colombia';
    if( $code == 'km' ) $country = 'Comoros the';
    if( $code == 'cd' ) $country = 'Congo';
    if( $code == 'cg' ) $country = 'Congo the';
    if( $code == 'ck' ) $country = 'Cook Islands';
    if( $code == 'cr' ) $country = 'Costa Rica';
    if( $code == 'ci' ) $country = 'Cote d\'Ivoire';
    if( $code == 'hr' ) $country = 'Croatia';
    if( $code == 'cu' ) $country = 'Cuba';
    if( $code == 'cy' ) $country = 'Cyprus';
    if( $code == 'cz' ) $country = 'Czech Republic';
    if( $code == 'dk' ) $country = 'Denmark';
    if( $code == 'dj' ) $country = 'Djibouti';
    if( $code == 'dm' ) $country = 'Dominica';
    if( $code == 'do' ) $country = 'Dominican Republic';
    if( $code == 'ec' ) $country = 'Ecuador';
    if( $code == 'eg' ) $country = 'Egypt';
    if( $code == 'sv' ) $country = 'El Salvador';
    if( $code == 'gq' ) $country = 'Equatorial Guinea';
    if( $code == 'er' ) $country = 'Eritrea';
    if( $code == 'ee' ) $country = 'Estonia';
    if( $code == 'et' ) $country = 'Ethiopia';
    if( $code == 'fo' ) $country = 'Faroe Islands';
    if( $code == 'fk' ) $country = 'Falkland Islands (Malvinas)';
    if( $code == 'fj' ) $country = 'Fiji the Fiji Islands';
    if( $code == 'fi' ) $country = 'Finland';
    if( $code == 'fr' ) $country = 'France, French Republic';
    if( $code == 'gf' ) $country = 'French Guiana';
    if( $code == 'pf' ) $country = 'French Polynesia';
    if( $code == 'tf' ) $country = 'French Southern Territories';
    if( $code == 'ga' ) $country = 'Gabon';
    if( $code == 'gm' ) $country = 'Gambia the';
    if( $code == 'ge' ) $country = 'Georgia';
    if( $code == 'de' ) $country = 'Germany';
    if( $code == 'gh' ) $country = 'Ghana';
    if( $code == 'gi' ) $country = 'Gibraltar';
    if( $code == 'gr' ) $country = 'Greece';
    if( $code == 'gl' ) $country = 'Greenland';
    if( $code == 'gd' ) $country = 'Grenada';
    if( $code == 'gp' ) $country = 'Guadeloupe';
    if( $code == 'gu' ) $country = 'Guam';
    if( $code == 'gt' ) $country = 'Guatemala';
    if( $code == 'gg' ) $country = 'Guernsey';
    if( $code == 'gn' ) $country = 'Guinea';
    if( $code == 'gw' ) $country = 'Guinea-Bissau';
    if( $code == 'gy' ) $country = 'Guyana';
    if( $code == 'ht' ) $country = 'Haiti';
    if( $code == 'hm' ) $country = 'Heard Island and McDonald Islands';
    if( $code == 'va' ) $country = 'Holy See (Vatican City State)';
    if( $code == 'hn' ) $country = 'Honduras';
    if( $code == 'hk' ) $country = 'Hong Kong';
    if( $code == 'hu' ) $country = 'Hungary';
    if( $code == 'is' ) $country = 'Iceland';
    if( $code == 'in' ) $country = 'India';
    if( $code == 'id' ) $country = 'Indonesia';
    if( $code == 'ir' ) $country = 'Iran';
    if( $code == 'iq' ) $country = 'Iraq';
    if( $code == 'ie' ) $country = 'Ireland';
    if( $code == 'im' ) $country = 'Isle of Man';
    if( $code == 'il' ) $country = 'Israel';
    if( $code == 'it' ) $country = 'Italy';
    if( $code == 'jm' ) $country = 'Jamaica';
    if( $code == 'jp' ) $country = 'Japan';
    if( $code == 'je' ) $country = 'Jersey';
    if( $code == 'jo' ) $country = 'Jordan';
    if( $code == 'kz' ) $country = 'Kazakhstan';
    if( $code == 'ke' ) $country = 'Kenya';
    if( $code == 'ki' ) $country = 'Kiribati';
    if( $code == 'kp' ) $country = 'Korea';
    if( $code == 'kr' ) $country = 'Korea';
    if( $code == 'kw' ) $country = 'Kuwait';
    if( $code == 'kg' ) $country = 'Kyrgyz Republic';
    if( $code == 'la' ) $country = 'Lao';
    if( $code == 'lv' ) $country = 'Latvia';
    if( $code == 'lb' ) $country = 'Lebanon';
    if( $code == 'ls' ) $country = 'Lesotho';
    if( $code == 'lr' ) $country = 'Liberia';
    if( $code == 'ly' ) $country = 'Libyan Arab Jamahiriya';
    if( $code == 'li' ) $country = 'Liechtenstein';
    if( $code == 'lt' ) $country = 'Lithuania';
    if( $code == 'lu' ) $country = 'Luxembourg';
    if( $code == 'mo' ) $country = 'Macao';
    if( $code == 'mk' ) $country = 'Macedonia';
    if( $code == 'mg' ) $country = 'Madagascar';
    if( $code == 'mw' ) $country = 'Malawi';
    if( $code == 'my' ) $country = 'Malaysia';
    if( $code == 'mv' ) $country = 'Maldives';
    if( $code == 'ml' ) $country = 'Mali';
    if( $code == 'mt' ) $country = 'Malta';
    if( $code == 'mh' ) $country = 'Marshall Islands';
    if( $code == 'mq' ) $country = 'Martinique';
    if( $code == 'mr' ) $country = 'Mauritania';
    if( $code == 'mu' ) $country = 'Mauritius';
    if( $code == 'yt' ) $country = 'Mayotte';
    if( $code == 'mx' ) $country = 'Mexico';
    if( $code == 'fm' ) $country = 'Micronesia';
    if( $code == 'md' ) $country = 'Moldova';
    if( $code == 'mc' ) $country = 'Monaco';
    if( $code == 'mn' ) $country = 'Mongolia';
    if( $code == 'me' ) $country = 'Montenegro';
    if( $code == 'ms' ) $country = 'Montserrat';
    if( $code == 'ma' ) $country = 'Morocco';
    if( $code == 'mz' ) $country = 'Mozambique';
    if( $code == 'mm' ) $country = 'Myanmar';
    if( $code == 'na' ) $country = 'Namibia';
    if( $code == 'nr' ) $country = 'Nauru';
    if( $code == 'np' ) $country = 'Nepal';
    if( $code == 'an' ) $country = 'Netherlands Antilles';
    if( $code == 'nl' ) $country = 'Netherlands the';
    if( $code == 'nc' ) $country = 'New Caledonia';
    if( $code == 'nz' ) $country = 'New Zealand';
    if( $code == 'ni' ) $country = 'Nicaragua';
    if( $code == 'ne' ) $country = 'Niger';
    if( $code == 'ng' ) $country = 'Nigeria';
    if( $code == 'nu' ) $country = 'Niue';
    if( $code == 'nf' ) $country = 'Norfolk Island';
    if( $code == 'mp' ) $country = 'Northern Mariana Islands';
    if( $code == 'no' ) $country = 'Norway';
    if( $code == 'om' ) $country = 'Oman';
    if( $code == 'pk' ) $country = 'Pakistan';
    if( $code == 'pw' ) $country = 'Palau';
    if( $code == 'ps' ) $country = 'Palestinian Territory';
    if( $code == 'pa' ) $country = 'Panama';
    if( $code == 'pg' ) $country = 'Papua New Guinea';
    if( $code == 'py' ) $country = 'Paraguay';
    if( $code == 'pe' ) $country = 'Peru';
    if( $code == 'ph' ) $country = 'Philippines';
    if( $code == 'pn' ) $country = 'Pitcairn Islands';
    if( $code == 'pl' ) $country = 'Poland';
    if( $code == 'pt' ) $country = 'Portugal, Portuguese Republic';
    if( $code == 'pr' ) $country = 'Puerto Rico';
    if( $code == 'qa' ) $country = 'Qatar';
    if( $code == 're' ) $country = 'Reunion';
    if( $code == 'ro' ) $country = 'Romania';
    if( $code == 'ru' ) $country = 'Russian Federation';
    if( $code == 'rw' ) $country = 'Rwanda';
    if( $code == 'bl' ) $country = 'Saint Barthelemy';
    if( $code == 'sh' ) $country = 'Saint Helena';
    if( $code == 'kn' ) $country = 'Saint Kitts and Nevis';
    if( $code == 'lc' ) $country = 'Saint Lucia';
    if( $code == 'mf' ) $country = 'Saint Martin';
    if( $code == 'pm' ) $country = 'Saint Pierre and Miquelon';
    if( $code == 'vc' ) $country = 'Saint Vincent and the Grenadines';
    if( $code == 'ws' ) $country = 'Samoa';
    if( $code == 'sm' ) $country = 'San Marino';
    if( $code == 'st' ) $country = 'Sao Tome and Principe';
    if( $code == 'sa' ) $country = 'Saudi Arabia';
    if( $code == 'sn' ) $country = 'Senegal';
    if( $code == 'rs' ) $country = 'Serbia';
    if( $code == 'sc' ) $country = 'Seychelles';
    if( $code == 'sl' ) $country = 'Sierra Leone';
    if( $code == 'sg' ) $country = 'Singapore';
    if( $code == 'sk' ) $country = 'Slovakia (Slovak Republic)';
    if( $code == 'si' ) $country = 'Slovenia';
    if( $code == 'sb' ) $country = 'Solomon Islands';
    if( $code == 'so' ) $country = 'Somalia, Somali Republic';
    if( $code == 'za' ) $country = 'South Africa';
    if( $code == 'gs' ) $country = 'South Georgia and the South Sandwich Islands';
    if( $code == 'es' ) $country = 'Spain';
    if( $code == 'lk' ) $country = 'Sri Lanka';
    if( $code == 'sd' ) $country = 'Sudan';
    if( $code == 'sr' ) $country = 'Suriname';
    if( $code == 'sj' ) $country = 'Svalbard & Jan Mayen Islands';
    if( $code == 'sz' ) $country = 'Swaziland';
    if( $code == 'se' ) $country = 'Sweden';
    if( $code == 'ch' ) $country = 'Switzerland, Swiss Confederation';
    if( $code == 'sy' ) $country = 'Syrian Arab Republic';
    if( $code == 'tw' ) $country = 'Taiwan';
    if( $code == 'tj' ) $country = 'Tajikistan';
    if( $code == 'tz' ) $country = 'Tanzania';
    if( $code == 'th' ) $country = 'Thailand';
    if( $code == 'tl' ) $country = 'Timor-Leste';
    if( $code == 'tg' ) $country = 'Togo';
    if( $code == 'tk' ) $country = 'Tokelau';
    if( $code == 'to' ) $country = 'Tonga';
    if( $code == 'tt' ) $country = 'Trinidad and Tobago';
    if( $code == 'tn' ) $country = 'Tunisia';
    if( $code == 'tr' ) $country = 'Turkey';
    if( $code == 'tm' ) $country = 'Turkmenistan';
    if( $code == 'tc' ) $country = 'Turks and Caicos Islands';
    if( $code == 'tv' ) $country = 'Tuvalu';
    if( $code == 'ug' ) $country = 'Uganda';
    if( $code == 'ua' ) $country = 'Ukraine';
    if( $code == 'ae' ) $country = 'United Arab Emirates';
    if( $code == 'gb' ) $country = 'United Kingdom';
    if( $code == 'us' ) $country = 'United States of America';
    if( $code == 'um' ) $country = 'United States Minor Outlying Islands';
    if( $code == 'vi' ) $country = 'United States Virgin Islands';
    if( $code == 'uy' ) $country = 'Uruguay, Eastern Republic of';
    if( $code == 'uz' ) $country = 'Uzbekistan';
    if( $code == 'vu' ) $country = 'Vanuatu';
    if( $code == 've' ) $country = 'Venezuela';
    if( $code == 'vn' ) $country = 'Vietnam';
    if( $code == 'wf' ) $country = 'Wallis and Futuna';
    if( $code == 'eh' ) $country = 'Western Sahara';
    if( $code == 'ye' ) $country = 'Yemen';
    if( $code == 'zm' ) $country = 'Zambia';
    if( $code == 'zw' ) $country = 'Zimbabwe';
//    if( $country == '') $country = $code;
    if( $country == '') $country = null;
    return $country;
}





//convert state code to name -------------------------------------------------------//
//------------------------------------------------------------------------------------//

function dc_state_code_to_name($name, $to='name') {
// set $to='name' or $to='abbrev' depending on what kind of conversion you want
	$states = array(
	array('name'=>'Alabama', 'abbrev'=>'AL'),
	array('name'=>'Alaska', 'abbrev'=>'AK'),
	array('name'=>'Arizona', 'abbrev'=>'AZ'),
	array('name'=>'Arkansas', 'abbrev'=>'AR'),
	array('name'=>'California', 'abbrev'=>'CA'),
	array('name'=>'Colorado', 'abbrev'=>'CO'),
	array('name'=>'Connecticut', 'abbrev'=>'CT'),
	array('name'=>'Delaware', 'abbrev'=>'DE'),
	array('name'=>'Florida', 'abbrev'=>'FL'),
	array('name'=>'Georgia', 'abbrev'=>'GA'),
	array('name'=>'Hawaii', 'abbrev'=>'HI'),
	array('name'=>'Idaho', 'abbrev'=>'ID'),
	array('name'=>'Illinois', 'abbrev'=>'IL'),
	array('name'=>'Indiana', 'abbrev'=>'IN'),
	array('name'=>'Iowa', 'abbrev'=>'IA'),
	array('name'=>'Kansas', 'abbrev'=>'KS'),
	array('name'=>'Kentucky', 'abbrev'=>'KY'),
	array('name'=>'Louisiana', 'abbrev'=>'LA'),
	array('name'=>'Maine', 'abbrev'=>'ME'),
	array('name'=>'Maryland', 'abbrev'=>'MD'),
	array('name'=>'Massachusetts', 'abbrev'=>'MA'),
	array('name'=>'Michigan', 'abbrev'=>'MI'),
	array('name'=>'Minnesota', 'abbrev'=>'MN'),
	array('name'=>'Mississippi', 'abbrev'=>'MS'),
	array('name'=>'Missouri', 'abbrev'=>'MO'),
	array('name'=>'Montana', 'abbrev'=>'MT'),
	array('name'=>'Nebraska', 'abbrev'=>'NE'),
	array('name'=>'Nevada', 'abbrev'=>'NV'),
	array('name'=>'New Hampshire', 'abbrev'=>'NH'),
	array('name'=>'New Jersey', 'abbrev'=>'NJ'),
	array('name'=>'New Mexico', 'abbrev'=>'NM'),
	array('name'=>'New York', 'abbrev'=>'NY'),
	array('name'=>'North Carolina', 'abbrev'=>'NC'),
	array('name'=>'North Dakota', 'abbrev'=>'ND'),
	array('name'=>'Ohio', 'abbrev'=>'OH'),
	array('name'=>'Oklahoma', 'abbrev'=>'OK'),
	array('name'=>'Oregon', 'abbrev'=>'OR'),
	array('name'=>'Pennsylvania', 'abbrev'=>'PA'),
	array('name'=>'Rhode Island', 'abbrev'=>'RI'),
	array('name'=>'South Carolina', 'abbrev'=>'SC'),
	array('name'=>'South Dakota', 'abbrev'=>'SD'),
	array('name'=>'Tennessee', 'abbrev'=>'TN'),
	array('name'=>'Texas', 'abbrev'=>'TX'),
	array('name'=>'Utah', 'abbrev'=>'UT'),
	array('name'=>'Vermont', 'abbrev'=>'VT'),
	array('name'=>'Virginia', 'abbrev'=>'VA'),
	array('name'=>'Washington', 'abbrev'=>'WA'),
	array('name'=>'West Virginia', 'abbrev'=>'WV'),
	array('name'=>'Wisconsin', 'abbrev'=>'WI'),
	array('name'=>'Wyoming', 'abbrev'=>'WY')
	);

	$return = false;
	foreach ($states as $state) {
		if ($to == 'name') {
			if (strtolower($state['abbrev']) == strtolower($name)){
				$return = $state['name'];
				break;
			}
		} else if ($to == 'abbrev') {
			if (strtolower($state['name']) == strtolower($name)){
				$return = strtoupper($state['abbrev']);
				break;
			}
		}
	}
	return $return;
}




//helper functions----------------------------------------------------------------//
//------------------------------------------------------------------------------------//

function strip_html_the_content() {
    ob_start();
    the_content();
    $old_content = ob_get_clean();
    $new_content = strip_tags($old_content);
    echo $new_content;
}

function dc_shorten($string, $length)
{
    // By default, an ellipsis will be appended to the end of the text.
    $suffix = '&hellip;';
    // Convert 'smart' punctuation to 'dumb' punctuation, strip the HTML tags,
    // and convert all tabs and line-break characters to single spaces.
    $short_desc = trim(str_replace(array("\r","\n", "\t"), ' ', strip_tags($string)));
    // Cut the string to the requested length, and strip any extraneous spaces 
    // from the beginning and end.
    $desc = trim(substr($short_desc, 0, $length));
    // Find out what the last displayed character is in the shortened string
    $lastchar = substr($desc, -1, 1);
    // If the last character is a period, an exclamation point, or a question 
    // mark, clear out the appended text.
    // Append the text.
    $desc .= $suffix;
    // Send the new description back to the page.
    return $desc;
}

function dc_strip_http ($input) {
 //$input  = 'www.google.co.uk/';
// in case scheme relative URI is passed, e.g., //www.google.com/
$input = trim($input, '/');
// If scheme not included, prepend it
if (!preg_match('#^http(s)?://#', $input)) {
    $input = 'http://' . $input;
}
$urlParts = parse_url($input);
// remove www
$domain = preg_replace('/^www\./', '', $urlParts['host']);
echo $domain;
// output: google.co.uk
}

//display attachment image
function dc_display_attachment_img ($post_ID, $img_size) {
    $args_attachments = array('post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post_ID);
    $attachments = get_posts($args_attachments);
    foreach ($attachments as $attachment) {
        echo wp_get_attachment_image( $attachment->ID, $img_size );
    }
}




// output: google.co.uk

//for testing purposes----------------------------------------------------------------//
//------------------------------------------------------------------------------------//

// add the action
add_action( 'testhook_output', 'test_output' );

//create custom testing hook -delete-me
function test_output() {
    
}

//put this in the template file:
//do_action('testhook_output');
?>

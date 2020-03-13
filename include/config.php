<?php
###############################
## ResourceSpace
## Local Configuration Script
###############################

# All custom settings should be entered in this file.
# Options may be copied from config.default.php and configured here.

# MySQL database settings
$mysql_server = 'localhost';
$mysql_username = 'root';
$mysql_password = '';
$mysql_db = 'resourcespace';

# Base URL of the installation
$baseurl = 'http://localhost/resourcespace';

# Email settings
$email_notify = 'bala2920@gmail.com';
$email_from = '';
# Secure keys
$spider_password = 'e247f8ad90b87235b9ba2ecfc97e257673a6cda13a57d66044f6584109e44e87';
$scramble_key = '4fb16a64adba4bd865d3ef108af4bf146892baa69fcdf41d067d53852d55abbc';
$api_scramble_key = '77a370a1b7bcd6e6b700aa4a6038b656c8b0ed55a058a22adf69420e32ee5071';

# Paths
$enable_remote_apis = true;
$config_windows = true;

#Design Changes
$slimheader=true;



/*

New Installation Defaults
-------------------------

The following configuration options are set for new installations only.
This provides a mechanism for enabling new features for new installations without affecting existing installations (as would occur with changes to config.default.php)

*/
                                
// Set imagemagick default for new installs to expect the newer version with the sRGB bug fixed.
$imagemagick_colorspace = "sRGB";

// No "contact us" link for new installations
$contact_link=false;

$slideshow_big=true;
$home_slideshow_width=1400;
$home_slideshow_height=900;

$homeanim_folder = 'filestore/system/slideshow';


$themes_simple_view=true;
$themes_category_split_pages=true;
$theme_category_levels=8;

$simple_search_pills_view = true;

$stemming=true;

# gdpr-addon-updater
This repo will be used to update wp-gdpr addon plugins.

# How to use it

1. Load composer vendor autoload
    *      include "vendor/autoload.php";
    
2. Set Edd Model
    *      $edd = new Edd();
           $edd->item_name = 'Edd download name';
           $edd->item_id = 1; //Post ID
           $edd->store_url = 'https://wp-gdpr.eu/'; (optional: default = https://wp-gdpr.eu/)
           $edd->license_option = 'Option key for the plugin to save the value in options database table';
           $edd->plugin_name = 'Plugins name';
           $edd->plugin_file = '__FILE__ of the main plugin file';
           $edd->plugin_version = '2.0.1';
           $edd->plugin_author = 'Appsaloon';
           
3. Initialize Updater class with edd model
        *      $updater = new Updater( $edd );
                   
4. Output License key form
    *      $updater->display_license_form();
    
5. Validate all and check for version update
    *      $updater->validate();

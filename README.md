# gdpr-addon-updater
This repo will be used to update wp-gdpr addon plugins.

# How to use it

1. Load composer vendor autoload
    *      include "vendor/autoload.php";
2. Initialize Updater class
    *      $updater = new Updater();
3. Set Bitbucket model
    *      $bitbucket = new Bitbucket()
           $bitbucket->plugin_file = 'Full DIR path to main file of the plugin';
           $bitbucket->plugin_slug = 'Plugin DIR name';
           $bitbucket->bb_host = 'https://api.bitbucket.org'; (optional: default = https://api.bitbucket.org)
           $bitbucket->bb_download_host = 'http://bitbucket.org'; (optional: default = http://bitbucket.org)
           $bitbucket->bb_owner = 'Bitbucket username';
           $bitbucket->bb_password = 'Bitbucket password';
           $bitbucket->bb_project_name = 'Bitbucket Project name';
           $bitbucket->bb_repo_name = 'Bitbucket Repo name';
           
4. Push Bitbucket model to the Updater class
    *      $updater->set_bitbucket( $bitbucket );
5. Set Edd Model
    *      $edd = new Edd();
           $edd->item_name = 'Edd download name';
           $edd->store_url = 'https://wp-gdpr.eu/'; (optional: default = https://wp-gdpr.eu/)
           $edd->license_option = 'Option key for the plugin to save the value in options database table';
           $edd->plugin_name = 'Plugins name';
6. Push Edd model to the Updater class
    *      $updater->set_edd( $edd );
7. Output License key form
    *      $updater->display_license_form();
8. Validate all and check for version update
    *      $updater->validate();

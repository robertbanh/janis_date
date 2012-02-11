<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(  'pi_name' => 'Janis Date',
    'pi_version' => '1.0',
    'pi_author' => 'Janis Gonser',
    'pi_author_url' => 'http://',
    'pi_description' => 'Custom plugin that compares 2 dates',
    'pi_usage' => janis_date::usage());

class Janis_Date
{
    var $return_data;

    function Janis_Date()
    {
        $this->EE =& get_instance();

        $date = $this->EE->TMPL->fetch_param('date','');

        $expired = true;

        if (!empty($date))
        {
            // yyyy-mm-dd
            if (strtotime($date) > strtotime('now'))
                $expired = false;
        }
        
        // update tags and return 
        $variables[] = array(
            'is_expired'       => ($expired ? 'true' : 'false')
            );

        $output = $this->EE->TMPL->parse_variables($this->EE->TMPL->tagdata, $variables);

        $this->return_data = $output;
    }


    // ----------------------------------------
    //  Plugin Usage
    // ----------------------------------------
    // This function describes how the plugin is used.
    //  Make sure and use output buffering
    function usage()
    {
        ob_start();
        ?>
Example:
----------------
{exp:janis_date date="{subscription_expired}"}
    {if '{is_expired}' == 'true'}
        I'm expired.
    {if:else}
        I'm NOT expired.
    {/if}
{/exp:janis_date}

Parameters:
----------------
date=""
Check to see if this date has expired to current date.

----------------
CHANGELOG:

1.0
* 1st version for EE 2.0



        <?php
        $buffer = ob_get_contents();
        ob_end_clean();
        return $buffer;
    }
      /* END */

}

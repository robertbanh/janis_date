<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
========================================================
Plugin TruncHTML
--------------------------------------------------------
Copyright: Oliver Heine
License: Freeware
http://utilitees.de/ee.php/trunchtml
--------------------------------------------------------
This addon may be used free of charge. Should you
employ it in a commercial project of a customer or your
own I'd appreciate a small donation.
========================================================
File: pi.trunchtml.php
--------------------------------------------------------
Purpose: Truncates HTML to the specified length without
leaving open tags.
========================================================
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF
ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO
EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE
FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN
AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE
OR OTHER DEALINGS IN THE SOFTWARE.
========================================================
*/


$plugin_info = array(  'pi_name' => 'Janis Date',
    'pi_version' => '1.0',
    'pi_author' => 'Janis Gonser',
    'pi_author_url' => '',
    'pi_description' => 'Custom plugin that compares 2 dates',
    'pi_usage' => trunchtml::usage());

class Janis_Date
{
    var $return_data;

    function Janis_Date()
    {
        $this->EE =& get_instance();

        $date = $this->EE->TMPL->fetch_param('date','');

        if (empty($date))
            return $this->return_data = $this->EE->TMPL->tagdata;
        
        $expired = true;

        // yyyy-mm-dd
        if (strtotime($date) > strtotime('now'))
            $expired = false;

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
    {if '{is_expired}'' == 'true'}
        YEAH
    {if:else}
        NOOO
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

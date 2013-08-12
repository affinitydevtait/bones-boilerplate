<?
class WP_Debug {
    private $developer_IPs = array();


    public function WP_Debug() {
        $this->clean_developer_IPs();     

        $this->add_debug_actions();   
    }



    public function add_debug_actions() {
        // Adds debugging stuff to footer
        add_action('wp_footer', array($this,'affinity_debugging'));
    }

    /**
     * Affinity debugging class
     */
    public function affinity_debugging() {
        
        
        if( get_option('developer_mode') == "true" && in_array($_SERVER['REMOTE_ADDR'], $this->developer_IPs) ):
            //define('SAVEQUERIES', true);
            
            $this->affinity_debugging_footer();
        endif;
    }

    /**
     * Some basic debugging stuff - ideally be it's own class or plugin when more complete
     * @author Trystan
     */ 
    public function affinity_debugging_footer( ) {
        global $wpdb;        
        
        ?>
        <fieldset style="border:1px solid #0000FF;padding:6px 10px 10px 10px; margin:50px 20px;background-color:#eee">
            <legend style="color:#0000FF;">
                &nbsp;&nbsp;Affinity New Media Debugging&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Queries: 
                <?=$wpdb->num_queries?>&nbsp;&nbsp;&nbsp;
            </legend>
            <style>
            td {
                padding:4px;
            }
            </style>
            <table width="100%" cellspacing="1" cellpadding="4" border="0" style="border-collapse: separate; border-spacing:1px;">
            <tbody>
                <tr>
                    <td width="200" valign="top" style="color:#990000;font-weight:normal;background-color:#ddd;">Template&nbsp;&nbsp;</td>
                    <td style="color:#000;font-weight:normal;background-color:#ddd;"><code><?=$GLOBALS['template']?></code></td>
                    <td style="color:#000;font-weight:normal;background-color:#ddd;">&nbsp;</td>
                </tr>

                
                
                <?php
                //echo "<pre>" . var_export($wpdb, true) . "</pre>";
                if( is_array($wpdb->queries) ) {
                    foreach( $wpdb->queries as $key => $queryArray ) {
                        ?>
                        <tr>
                            <td valign="top" style="color:#990000;font-weight:normal;background-color:#ddd;"><?=$queryArray[1]?>&nbsp;&nbsp;</td>
                            <td style="color:#000;font-weight:normal;background-color:#ddd;"><code><?=$queryArray[0]?></code></td>
                            <td style="color:#000;font-weight:normal;background-color:#ddd;"><code><?=$queryArray[2]?></code></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td valign="top" style="color:#990000;font-weight:normal;background-color:#ddd;">Queries</td>
                        <td style="color:#000;font-weight:normal;background-color:#ddd;">To view queries, add <code>define('SAVEQUERIES', true);</code> to wp-config.php</td>
                        <td style="color:#000;font-weight:normal;background-color:#ddd;">&nbsp;</td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
            </table>
        </fieldset>
    
        <fieldset style="border:1px solid #0000FF;padding:6px 10px 10px 10px; margin:50px 20px;background-color:#eee">
            <legend style="color:#0000FF;">
                &nbsp;&nbsp;Affinity New Media Debugging&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GLOBALS
            </legend>
            
            <style>
            td {
                padding:4px;
            }
            </style>
            <table width="100%" cellspacing="1" cellpadding="4" border="0" style="border-collapse: separate; border-spacing:1px;">
            <tbody>
                <?php
                if ( $_GET['anm'] == "globals") {
                    // Output globals
                    
                    foreach( $GLOBALS as $key => $value ) {
                        ?>
                        <tr>
                            <td valign="top" style="color:#990000;font-weight:normal;background-color:#ddd;"><?=$key?>&nbsp;&nbsp;</td>
                            <td style="color:#000;font-weight:normal;background-color:#ddd;"><code><pre><? print_r($value); ?></pre></code></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td width="200" valign="top" style="color:#990000;font-weight:normal;background-color:#ddd;">Globals</td>
                        <td style="color:#000;font-weight:normal;background-color:#ddd;">To view globals, <a href="?anm=globals">click here</a> (Warning: Slow to load)</td>
                        <td style="color:#000;font-weight:normal;background-color:#ddd;">&nbsp;</td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
            </table>
            
        </fieldset>

        <fieldset style="border:1px solid #0000FF;padding:6px 10px 10px 10px; margin:50px 20px;background-color:#eee">
            <legend style="color:#0000FF;">
                &nbsp;&nbsp;Affinity New Media Debugging&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PHP INFO
            </legend>
            
            <style>
            td {
                padding:4px;
            }
            </style>
            <table width="100%" cellspacing="1" cellpadding="4" border="0" style="border-collapse: separate; border-spacing:1px;">
            <tbody>
                <?php
                if ( $_GET['anm'] == "phpinfo") {
                    // Output phpinfo
                    phpinfo();
                } else {
                    ?>
                    <tr>
                        <td width="200" valign="top" style="color:#990000;font-weight:normal;background-color:#ddd;">Globals</td>
                        <td style="color:#000;font-weight:normal;background-color:#ddd;">To view phpinfo, <a href="?anm=phpinfo">click here</a> (Warning: Messes with styles)</td>
                        <td style="color:#000;font-weight:normal;background-color:#ddd;">&nbsp;</td>
                    </tr>
                    <?
                }
                ?>
            </tbody>
            </table>
            
        </fieldset>
        <?        
    }

    private function clean_developer_IPs() {
        $this->developer_IPs = explode(",", get_option('developer_IP'));

        foreach($this->developer_IPs as $key => $val) {
            $this->developer_IPs[$key] = trim($val);
        }

        // Local development
        array_push($this->developer_IPs, "::1");
    }
}
?>
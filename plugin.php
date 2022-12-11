<?php

class pluginStatimize extends Plugin {
  
        public function init() {
          
                $this->dbFields = array(
                        'concealItems' => '',
                        'supplementItems' => '',
                        'additionalText' => ''
                );
          
        }
  
  
        public function form() {

                // ----------
                // Save files
                // ----------

                // Prepare target path
                $folder = explode('/', __FILE__);
                $folder = $folder[count($folder)-2];

                // Prepare navbar (CSS)
                $concealItems = preg_split("/\r\n|\n|\r/", $this->getValue("concealItems"));
                foreach ($concealItems as $value) {
                        $entry .= '.nav-link[href*="'.trim($value).'"]{display: none;} ';
                }

                // Save navbar content (CSS)
                $file = PATH_PLUGINS.$folder.'/remove.css';
                file_put_contents($file, $entry);

                // Prepare footer links (JS)
                $item .= 'items = [';
                $supplementItems = preg_split("/\r\n|\n|\r/", $this->getValue("supplementItems"));
                foreach ($supplementItems as $value) {
                        $item .= '"'.trim($value).'", ';
                }
                $item = rtrim($item, ', ');
                $item .= ']; ';

                // Prepare footer text (JS)
                $item .= 'text = "';
                $item .= trim( $this->getValue("additionalText") );
                $item .= '";';

                // Save footer parts (JS)
                $fileJs = PATH_PLUGINS.$folder.'/add.js';
                file_put_contents($fileJs, $item);

                // ----------
                // Create DOM
                // ----------

                // Prepare navbar
                global $L;
                $html = '<h4>'.$L->get('remove-header').'</h4>';
                $html .= '<p>'.$L->get('remove-l1').'<br>';
                $html .= $L->get('remove-l2').'</p>';
                $html .= '<textarea class="form-control" rows="3" name="concealItems" id="concealItems">'
                        .$this->getValue('concealItems').'</textarea>';
                $html .= '<sub>'.$L->get('remove-tip').'</sub>';

                // Prepare footer links
                $html .= '<hr><h4>'.$L->get('links-header').'</h4>';
                $html .= '<p>'.$L->get('links-l1').'<br>';
                $html .= $L->get('links-l2').'</p>';
                $html .= '<textarea class="form-control" rows="3" name="supplementItems" id="supplementItems">'
                        .$this->getValue('supplementItems').'</textarea>';
                $html .= '<sub>'.$L->get('links-tip').'</sub>';

                // Prepare footer text
                $html .= '<hr><h4>'.$L->get('text-header').'</h4>';
                $html .= '<p>'.$L->get('text-l1');
                $html .= '<textarea class="form-control" rows="3" name="additionalText" id="additionalText">'
                        .$this->getValue('additionalText').'</textarea>';

                // Return DOM tree
                return $html;

        }


        public function siteHead() {

                // Load CSS and JS

                $folder = explode('/', __FILE__);
                $folder = $folder[count($folder)-2];
                $file = HTML_PATH_PLUGINS.$folder;

                $html = '<link rel="stylesheet" type="text/css" href="..'.$file.'/remove.css"/>';
                $html .= '<script src="..'.$file.'/add.js"/></script>';
                $html .= '<script src="..'.$file.'/statimize.js"/></script>';

                return $html;

        }


        public function afterSiteLoad() {

                // Call function for preparing footer

                global $site;
                $html .= '<script>prepareFooter("'.$site->theme().'");</script>';

                return $html;
        }

  
}

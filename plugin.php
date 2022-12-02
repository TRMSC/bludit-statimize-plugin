<?php

class pluginStatimize extends Plugin {
  
        public function init() {
          
                $this->dbFields = array(
                        'concealItems' => ''
                );
          
        }
  
  
        public function form() {

                $concealItems = preg_split("/\r\n|\n|\r/", $this->getValue("concealItems"));
                foreach ($concealItems as $value) {
                    $entry .= '.nav-link[href*="'.$value.'"]{display = none;} ';
                }
                $file = $this->workspace().'remove.css';
                file_put_contents($file, $entry);

                global $L;
                $html = '<label for="concealItems">'.$L->get('remove').'</label>';
                $html .= '<textarea class="form-control" rows="3" name="concealItems" id="concealItems">'.$this->getValue('concealItems').'</textarea>';
        
                return $html;
        }
  
        public function siteBodyEnd() {

                $html = '<script src="'.HTML_PATH_PLUGINS.'statimize/statimize.js"></script>';
                $concealItems = preg_split("/\r\n|\n|\r/", $this->getValue("concealItems"));
                foreach ($concealItems as $value) {
                    $html .= '<script>removeEntries("'.$value.'");</script>';
                }
                $html .= '<script>showNavbar();</script>;';
          
                return $html;

       }
}

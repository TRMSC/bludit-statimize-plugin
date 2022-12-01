<?php

class pluginStatimize extends Plugin {
  
        public function init() {
          
                $this->dbFields = array(
                        'concealItems'=>''
                );
          
        }
  
  
        public function form() {

                global $L;
                $html = '<label for="statimize-remove">'.$L->get('remove').'</label>';
                $html .= '<textarea class="form-control" rows="3" name="statimize-remove" id="statimize-remove">'.$this->getValue('concealItems').'</textarea>';
        
                return $html;
        }
  
  
        public function siteBodyEnd() {
  
                $concealItems = preg_split("/\r\n|\n|\r/", $this->getValue("concealItems"));

                $html = '<script src="'.HTML_PATH_PLUGINS.'statimize/statimize.js"></script>';
                foreach ($concealItems as $value) {
                    $html .= '<script>removeEntries("'.$value.'");</script>';
                }
          
                return $html;

       }
}

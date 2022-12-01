<?php

class pluginStatimize extends Plugin {
  
        public function init() {
          
                $this->dbFields = array(
                        'concealItems'=>''
                );
          
        }
  
  
        public function form() {
                
                $html = '<textarea class="form-control" rows="3" name="concealItems" id="concealItems">'.$this->getValue('concealItems').'</textarea>';
        
                return $html;
        }
  
  
        public function siteBodyEnd() {
  
                $x = 
                  '<p>Hallo</p>' +
                  '<script>' +
                  'console.log("check");' +
                  'let bin = document.getElementsByClassName("nav-link");' +
                  'for (let i=0; i<bin.length; i++) {' +
                      'if (bin[i].text == $this.getValue("concealItems")) {' +
                          'bin[i].parentElement.style.display = "none";' +
                      '}' +
                  '}'+
                  '</script>';
                $y = $this->getValue("concealItems");

                $html = '<script src="'.HTML_PATH_PLUGINS.'statimize/statimize.js"></script>';
          
                return $html;

       }
}

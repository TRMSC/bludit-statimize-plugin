<?php

class Statimize extends Plugin {
  
        public function afterPageCreate() {
          
                $this->dbFields = array(
                        'concealItems'=>''
                );
          
        }
  
  
        public function form() {
                
                $html = '<textarea class="form-control" rows="3" name="concealItems" id="concealItems">'.$this->getValue('concealItems').'</textarea>';
        
                return $htmml;
        }
  
  
        public function concealItems() {
  
                $html = 
                  'let bin = document.getElementsByClassName('nav-link');' +
                  'for (let i=0; i<bin.length; i++) {' +
                      'if (bin[i].text == $this.getValue('concealItems')) {' +
                          'bin[i].parentElement.style.display = 'none';' +
                      '}' +
                  '}';
          
                return $html;

       }

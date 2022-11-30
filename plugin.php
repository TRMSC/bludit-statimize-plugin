<?php

class Statimize extends Plugin {
  
        public function afterPageCreate() {
          
                $this->dbFields = array(
                        'concealItems'=>''
                );
          
        }
  
  
        public function form() {
          
        }
  
  
        public function concealItems() {
  
                $conceal = 
                  'let bin = document.getElementsByClassName('nav-link');' +
                  'for (let i=0; i<bin.length; i++) {' +
                      'if (bin[i].text == 'XXX') {' + // variable is needed
                          'bin[i].parentElement.style.display = 'none';' +
                      '}' +
                  '}';

       }

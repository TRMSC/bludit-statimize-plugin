<?php

class pluginStatimize extends Plugin {
  
        public function init() {
          
                $this->dbFields = array(
                        'concealItems' => '',
                        'supplementItems' => ''
                );
          
        }
  
  
        public function form() {

                // NAVBAR FILE

                $concealItems = preg_split("/\r\n|\n|\r/", $this->getValue("concealItems"));
                foreach ($concealItems as $value) {
                        $entry .= '.nav-link[href*="'.trim($value).'"]{display: none;} ';
                }

                $folder = explode('/', __FILE__);
                $folder = $folder[count($folder)-2];
                $file = PATH_PLUGINS.$folder.'/remove.css';
                file_put_contents($file, $entry);

                // NAVBAR STORE

                global $L;
                $html = '<h4>'.$L->get('remove-header').'</h4>';
                $html .= '<p>'.$L->get('remove-l1').'<br>';
                $html .= $L->get('remove-l2').'</p>';
                $html .= '<textarea class="form-control" rows="3" name="concealItems" id="concealItems">'
                        .$this->getValue('concealItems').'</textarea>';
                $html .= '<sub>'.$L->get('remove-tip').'</sub>';

                // FOOTER FILE

                //$item = 'const re = /\[([^\[]*)\]\((.*)\)/; ';
                //$item .= 'window.onload = funtion () { ';
                $item .= 'items = [';

                $supplementItems = preg_split("/\r\n|\n|\r/", $this->getValue("supplementItems"));
                foreach ($supplementItems as $value) {
                        $item .= '"'.trim($value).'", ';
                        //.pregmatch($re);
                }
                $item = rtrim($item, ', ');
                $item .= ']; ';
                //$item .= '}';

                $fileJs = PATH_PLUGINS.$folder.'/add.js';
                file_put_contents($fileJs, $item);

                // FOOTER STORE

                $html .= '<hr><h4>'.$L->get('add-header').'</h4>';
                $html .= '<p>'.$L->get('add-l1').'<br>';
                $html .= $L->get('add-l2').'</p>';
                $html .= '<textarea class="form-control" rows="3" name="supplementItems" id="supplementItems">'
                        .$this->getValue('supplementItems').'</textarea>';
                $html .= '<sub>'.$L->get('add-tip').'</sub>';

                return $html;

        }


        public function siteHead() {

                // LOAD CSS AND JAVASCRIPTS

                $folder = explode('/', __FILE__);
                $folder = $folder[count($folder)-2];
                $file = HTML_PATH_PLUGINS.$folder;

                $html = '<link rel="stylesheet" type="text/css" href="..'.$file.'/remove.css"/>';
                $html .= '<script src="..'.$file.'/add.js"/></script>';
                $html .= '<script src="..'.$file.'/statimize.js"/></script>';

                return $html;

        }

  
}

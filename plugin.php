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
                        $entry .= '.nav-link[href*="'.trim($value).'"]{display: none;} ';
                }

                $folder = explode('/', __FILE__);
                $folder = $folder[count($folder)-2];
                $file = PATH_PLUGINS.$folder.'/remove.css';
                file_put_contents($file, $entry);

                global $L;
                $html = '<h4>'.$L->get('remove-header').'</h4>';
                $html .= '<p>'.$L->get('remove-l1').'<br>';
                $html .= $L->get('remove-l2').'</p>';
                $html .= '<textarea class="form-control" rows="3" name="concealItems" id="concealItems">'
                        .$this->getValue('concealItems').'</textarea>';
                $html .= '<sub>'.$L->get('remove-tip').'</sub>';

                return $html;

        }


        public function siteHead() {

                $folder = explode('/', __FILE__);
                $folder = $folder[count($folder)-2];
                $file = HTML_PATH_PLUGINS.$folder.'/remove.css';

                $html = '<link rel="stylesheet" type="text/css" href="..'.$file.'"/>';

                return $html;

        }
  
}

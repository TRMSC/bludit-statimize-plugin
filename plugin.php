<?php

class pluginStatimize extends Plugin {
  
        public function init() {
          
                $this->dbFields = array(
                        'removeNavLinks' => '',
                        'addFooterLinks' => '',
                        'addFooterText' => ''
                );
          
        }

  
  
        public function form() {

                // ----------
                // Save files
                // ----------

                // Prepare target path
                $folder = explode('/', __FILE__);
                $folder = $folder[count($folder)-2];
                if (!is_dir(PATH_PLUGINS.$folder.'/data')) {
                        mkdir(PATH_PLUGINS.$folder.'/data');
                }

                // Prepare navbar (CSS)
                $removeNavLinks = preg_split("/\r\n|\n|\r/", $this->getValue("removeNavLinks"));
                foreach ($removeNavLinks as $value) {
                        $entry .= '.nav-link[href*="'.trim($value).'"]{display: none;} ';
                }

                // Save navbar content (CSS)
                $file = PATH_PLUGINS.$folder.'/data/remove.css';
                file_put_contents($file, $entry);

                // Prepare footer links (JS)
                $item .= 'items = [';
                $addFooterLinks = preg_split("/\r\n|\n|\r/", $this->getValue("addFooterLinks"));
                foreach ($addFooterLinks as $value) {
                        $item .= '"'.trim($value).'", ';
                }
                $item = rtrim($item, ', ');
                $item .= ']; ';

                // Prepare footer text (JS)
                $item .= 'text = "<span>';
                $prepare = addslashes(html_entity_decode($this->getValue("addFooterText")));
                $split = preg_split("/\r\n|\n|\r/", $prepare);
                foreach ($split as $value) {
                        $item .= $value.'<br>';
                }
                $item = rtrim($item, '<br>');
                $item .= '</span>";';

                // Save footer parts (JS)
                $fileJs = PATH_PLUGINS.$folder.'/data/add.js';
                file_put_contents($fileJs, $item);

                // ----------
                // Create DOM
                // ----------

                // Handle variables
                global $site;
                global $L;
                $supported = array(
                        "smart",
                        "alternative",
                        "blogx",
                        "darktheme"
                ); 
                $inofficialSupport = '';
                $noSupport = '';
                $readonly = '';
                if (!in_array($site->theme(), $supported)) {
                        $inofficialSupport = 
                                '<div class="alert alert-warning">'.$L->get('support-1').$site->theme().$L->get('support-2')
                                .' <a href="https://github.com/TRMSC/bludit-statimize-plugin/issues" target="_blank"><button type="button" class="btn btn-light btn-sm">'
                                .$L->get('support-btn-1').'</button></a></div>';
                        $noSupport = 
                                '<div class="alert alert-warning">'.$L->get('support-3').$site->theme().$L->get('support-4')
                                .' <a href="https://github.com/TRMSC/bludit-statimize-plugin/issues" target="_blank"><button type="button" class="btn btn-light btn-sm">'
                                .$L->get('support-btn-2').'</button></a></div>';
                        $readonly = 'readonly';
                }

                // Create settings for navbar
                $html = '<h4>'.$L->get('remove-header').'</h4>';
                $html .= '<p>'.$L->get('remove-l1').'<br>';
                $html .= $L->get('remove-l2').'</p>';
                $html .= '<textarea class="form-control" rows="3" name="removeNavLinks" id="removeNavLinks">'
                        .$this->getValue('removeNavLinks').'</textarea>';
                $html .= '<sub>'.$L->get('remove-tip').'</sub>';
                $html .= $inofficialSupport;

                // Create settings for footer links
                $html .= '<hr><h4>'.$L->get('links-header').'</h4>';
                $html .= '<p>'.$L->get('links-l1').'<br>';
                $html .= $L->get('links-l2').'</p>';
                $html .= '<textarea class="form-control" rows="3" name="addFooterLinks" id="addFooterLinks" '.$readonly.'>'
                        .$this->getValue('addFooterLinks').'</textarea>';
                $html .= '<sub>'.$L->get('links-tip').'</sub>';
                $html .= $noSupport;

                // Create settings for footer text
                $html .= '<hr><h4>'.$L->get('text-header').'</h4>';
                $html .= '<p>'.$L->get('text-l1');
                $html .= '<textarea class="form-control" rows="3" name="addFooterText" id="addFooterText" '.$readonly.'>'
                        .$this->getValue('addFooterText').'</textarea>';
                $html .= '<sub>'.$L->get('text-tip').'</sub>';
                $html .= $noSupport;

                // Return DOM tree
                return $html;

        }



        public function siteHead() {

                // Get path for sources
                $folder = explode('/', __FILE__);
                $folder = $folder[count($folder)-2];
                $file = HTML_PATH_PLUGINS.$folder;

                // Load CSS and JS
                $html = '<link rel="stylesheet" type="text/css" href="..'.$file.'/data/remove.css"/>';
                $html .= '<script src="..'.$file.'/data/add.js"/></script>';
                $html .= '<script src="..'.$file.'/statimize.js"/></script>';

                // Return DOM tree
                return $html;

        }



        public function afterSiteLoad() {

                // Create function call for preparing footer
                global $site;
                $html .= '<script>prepareFooter("'.$site->theme().'");</script>';

                // Return DOM tree
                return $html;

        }

  
}

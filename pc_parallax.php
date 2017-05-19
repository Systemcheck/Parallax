<?php
/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;


class Pc_Parallax extends Module implements WidgetInterface
{
    private $templateFile;

    public function __construct()
    {
        $this->name = 'pc_parallax';
        $this->author = 'PrestaCode';
        $this->version = '1.7.0';
        $this->need_instance = 0;

        $this->ps_versions_compliancy = [
            'min' => '1.7.0.0',
            'max' => _PS_VERSION_,
        ];

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->trans('PC - Parallax', array(), 'Modules.Parallax.Admin');
        $this->description = $this->trans('Displays an Image Block with Parallax Effect.', array(), 'Modules.Parallax.Admin');

        $this->templateFile = 'module:pc_parallax/views/templates/hook/pc_parallax.tpl';
    }

    public function install()
    {
        $this->_clearCache('*');

        Configuration::updateValue('PC_PARALLAX_H1', 'Sample');
        Configuration::updateValue('PC_PARALLAX_H4', '"This is a sample underline text"');
        Configuration::updateValue('PC_PARALLAX_IMGURL', '/modules/'.$this->name.'/assets/img/parallax.jpg');
        Configuration::updateValue('PC_PARALLAX_TEXTCOLOR', '#ffffff');
        Configuration::updateValue('PC_PARALLAX_FULLWIDTH', '1');
        Configuration::updateValue('PC_PARALLAX_HEIGHT', '350px');
           
        return parent::install()
            
            && $this->registerHook('displayHome')
            && $this->registerHook('displayHeader')
        ;
    }

    public function uninstall()
    {
        $this->_clearCache('*');

        return parent::uninstall();
    }

    public function hookAddProduct($params)
    {
        $this->_clearCache('*');
    }

    public function _clearCache($template, $cache_id = null, $compile_id = null)
    {
        parent::_clearCache($this->templateFile);
    }

    public function getContent()
    {
        $output = '';
        $errors = array();

        if (Tools::isSubmit('submitParallax')) {
            $nbr = Tools::getValue('PC_PARALLAX_H1');
            $cat = Tools::getValue('PC_PARALLAX_H4');
            $img = Tools::getValue('PC_PARALLAX_IMGURL');
            
            
            if (isset($errors) && count($errors)) {
                $output = $this->displayError(implode('<br />', $errors));
            } else {
                Configuration::updateValue('PC_PARALLAX_H1', $nbr);
                Configuration::updateValue('PC_PARALLAX_H4', $cat);
                Configuration::updateValue('PC_PARALLAX_IMGURL', $img);
                

                $this->_clearCache('*');

                $output = $this->displayConfirmation($this->trans('The settings have been updated.', array(), 'Admin.Notifications.Success'));
            }
        }
        if (Tools::isSubmit('submitParallaxCSS')) {
            
            $color = Tools::getValue('PC_PARALLAX_TEXTCOLOR');
            $ml = Tools::getValue('PC_PARALLAX_FULLWIDTH');
            $mr = Tools::getValue('PC_PARALLAX_HEIGHT');
            
            if (isset($errors) && count($errors)) {
                $output = $this->displayError(implode('<br />', $errors));
            } else {
                
                Configuration::updateValue('PC_PARALLAX_TEXTCOLOR', $color);
                Configuration::updateValue('PC_PARALLAX_FULLWIDTH', $ml);
              Configuration::updateValue('PC_PARALLAX_HEIGHT', $mr);

                $this->_clearCache('*');

                $output = $this->displayConfirmation($this->trans('The settings have been updated.', array(), 'Admin.Notifications.Success'));
            }
        }

        return $output.$this->renderForm().$this->renderForm2();
    }

    public function renderForm()
    {
        $fields_form = array(
            'form' => array(
                    
                'legend' => array(
                    'title' => $this->trans('Basic Settings', array(), 'Admin.Global'),
                    'icon' => 'icon-cogs',
                ),

                
                'input' => array(
                    
                    array(
                        'type' => 'text',
                        'label' => $this->trans('Header Text', array(), 'Modules.Parallax.Admin'),
                        'name' => 'PC_PARALLAX_H1',
                        'class' => 'fixed-width-xl',
                        'desc' => $this->trans('Set the Heading text or leave blank.', array(), 'Modules.Parallax.Admin'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->trans('Underline Text', array(), 'Modules.Parallax.Admin'),
                        'name' => 'PC_PARALLAX_H4',
                        'class' => 'fixed-width-xxl',
                        'desc' => $this->trans('Set the underline text or leave blank.', array(), 'Modules.Parallax.Admin'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->trans('Image Url', array(), 'Modules.Parallax.Admin'),
                        'name' => 'PC_PARALLAX_IMGURL',
                        'display_image' => TRUE,
                        'class' => 'fixed-width-xxl',
                        'required' => true,
                        'desc' => $this->trans('Set your image url.', array(), 'Modules.Parallax.Admin'),
                    ),
                    
                ),
                'submit' => array(
                    'title' => $this->trans('Save', array(), 'Admin.Actions'),
                ),
            ),
        );

        $lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));

        $helper = new HelperForm();
        $helper->show_toolbar = true;
        $helper->table = $this->table;
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->id = (int) Tools::getValue('id_carrier');
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitParallax';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($fields_form));
    }
    public function renderForm2()
    {
        $fields_form = array(
            'form' => array(
                    
                'legend' => array(
                    'title' => $this->trans('CSS Settings', array(), 'Admin.Global'),
                    'icon' => 'icon-cogs',
                ),

                
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->trans('Text Color:', array(), 'Modules.Parallax.Admin'),
                        'name' => 'PC_PARALLAX_TEXTCOLOR',
                        'class' => 'fixed-width-sm',
                        'desc' => $this->trans('Setup the text color. (Default: #ffffff)', array(), 'Modules.Parallax.Admin'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->trans('Fullsize', array(), 'Modules.FeaturedProducts.Admin'),
                        'name' => 'PC_PARALLAX_FULLWIDTH',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->trans('Enable/Disable Fullsize Mode for Classic Theme.', array(), 'Modules.FeaturedProducts.Admin'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->trans('Yes', array(), 'Admin.Global'),
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->trans('No', array(), 'Admin.Global'),
                            ),
                        ),
                    ),
                    
                    array(
                        'type' => 'text',
                        'label' => $this->trans('Parallax Height', array(), 'Modules.Parallax.Admin'),
                        'name' => 'PC_PARALLAX_HEIGHT',
                        'class' => 'fixed-width-sm',
                        'desc' => $this->trans('Setup the parallax height. (Default: "350px").', array(), 'Modules.Parallax.Admin'),
                    ),
                    
                    
                ),
                'submit' => array(
                    'title' => $this->trans('Save Css', array(), 'Admin.Actions'),
                ),
            ),
        );

        $lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->id = (int) Tools::getValue('id_carrier');
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitParallaxCSS';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($fields_form));
    }
    
    public function getConfigFieldsValues()
    {
        return array(
            'PC_PARALLAX_H1' => Tools::getValue('PC_PARALLAX_H1', Configuration::get('PC_PARALLAX_H1')),
            'PC_PARALLAX_H4' => Tools::getValue('PC_PARALLAX_H4', Configuration::get('PC_PARALLAX_H4')),
            'PC_PARALLAX_IMGURL' => Tools::getValue('PC_PARALLAX_IMGURL', Configuration::get('PC_PARALLAX_IMGURL')),
            'PC_PARALLAX_TEXTCOLOR' => Tools::getValue('PC_PARALLAX_TEXTCOLOR', Configuration::get('PC_PARALLAX_TEXTCOLOR')),
            'PC_PARALLAX_FULLWIDTH' => Tools::getValue('PC_PARALLAX_FULLWIDTH', Configuration::get('PC_PARALLAX_FULLWIDTH')),
            'PC_PARALLAX_HEIGHT' => Tools::getValue('PC_PARALLAX_HEIGHT', Configuration::get('PC_PARALLAX_HEIGHT')),
        );
    }
    public function hookdisplayHeader($params)
    {
        $this->context->controller->registerJavascript('modules-pc_parallax', 'modules/'.$this->name.'/assets/js/parallax.js', ['position' => 'bottom', 'priority' => 200]);
        $this->context->controller->registerStylesheet('modules-pc_parallax', 'modules/'.$this->name.'/assets/css/parallax.css', ['media' => 'all', 'priority' => 200 ]);
    }
    
    public function renderWidget($hookName = null, array $configuration = [])
    {
        if (!$this->isCached($this->templateFile, $this->getCacheId('pc_parallax'))) {
            $variables = $this->getWidgetVariables($hookName, $configuration);

            if (empty($variables)) {
                return false;
            }

            $this->smarty->assign($variables);
        }

        return $this->fetch($this->templateFile, $this->getCacheId('pc_parallax'));
    }

    public function getWidgetVariables($hookName = null, array $configuration = [])
    {
         $class = '';
         if(Configuration::get('PC_PARALLAX_FULLWIDTH') == 1) {
         $class = 'fullwidth'; }
         return array(
             'color' => Configuration::get('PC_PARALLAX_TEXTCOLOR'), 
             'pcparallax_h1' => Configuration::get('PC_PARALLAX_H1'), 
             'pcparallax_h4' => Configuration::get('PC_PARALLAX_H4'),
			       'image_url' => Configuration::get('PC_PARALLAX_IMGURL'),
             'class' => $class,
             'height' => Configuration::get('PC_PARALLAX_HEIGHT'),
             
        );
       
    }

}

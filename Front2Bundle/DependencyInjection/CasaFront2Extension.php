<?php

namespace Casa\Front2Bundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use JF\CoreBundle\DependencyInjection\Interfaces\IExtension;
use JF\CoreBundle\DependencyInjection\Traits\CoreExtension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CasaFront2Extension extends Extension implements IExtension {

    use CoreExtension;

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $this->configure($container);
        
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');        
        $loader2 = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader2->load('services.xml');
    }

    public function setInstall(ContainerBuilder $container) {
        
    }

    public function setMenu(ContainerBuilder $container) {
         $menu = array();

         $menu[] = array(
            'label' => 'menu.home',
            'route' => 'home',
            'show' => array('always' => true),
            'order' => 1,
        );
         $menu['admin'] = array(
            'label' => 'menu.admin',
            'submenu' => array(),
            'show' => array('in_role' => array('R_SUPER', 'G_SUPER')),
            'order' => 990,
        );
        //SUBMENU ADMIN
        {
            $menu['admin']['submenu'][] = array(
                'label' => 'menu.admin.sub.catalog',
                'route' => 'catalogo',
                'show' => array(
                    'in_role' => array('R_SUPER'),
                ),
                'order' => 1,
            );

            $menu['admin']['submenu'][] = array(
                'label' => 'menu.admin.sub.permission',
                'route' => 'index',
                'show' => array('in_role' => array('G_SUPER')),
                'order' => 20,
                'a' => array('class' => 'todo'),
            );
        }
        $menu['admin']['submenu'][] = array(
            'label' => 'menu.admin.sub.agency',
            'route' => 'reg_admin',
            'show' => array('in_role' => array('G_SUPER')),
            'order' => 1,
        );
        $menu['admin']['submenu'][] = array(
            'label' => 'menu.admin.sub.gruppi',
            'route' => 'configurazione_gruppi',
            'show' => array('in_role' => array('G_SUPER')),
            'order' => 5,
        );
        
        $menu['admin']['submenu'][] = array(
            'label' => 'menu.admin.sub.tipodocumenti',
            'route' => 'gestione_tipo-documenti',
            'show' => array('in_role' => array('G_SUPER')),
            'order' => 7,
        );
        
        $menu['admin']['submenu'][] = array(
            'label' => 'menu.admin.sub.tipologie',
            'route' => 'configurazione_tipologie',
            'show' => array('in_role' => array('G_SUPER')),
            'order' => 2,
        );
        
        $menu['admin']['submenu'][] = array(
            'label' => 'menu.admin.sub.categorie',
            'route' => 'configurazione_categorie',
            'show' => array('in_role' => array('G_SUPER')),
            'order' => 1,
        );
         $menu['profilo'] = array(
            'label' => 'menu.user',
            'submenu' => array(),
            'show' => array('logged' => true),
            'order' => 999,
            'a' => array('class' => 'blyellow'),
            'icon' => 'user',
        );

        $menu['profilo']['submenu'][] = array(
            'label' => 'menu.user.sub.profile',
            'route' => 'fos_user_profile_show',
            'order' => 1,
        );

        $menu['profilo']['submenu'][] = array(
            'label' => 'menu.user.sub.change_password',
            'route' => 'fos_user_change_password',
            'order' => 25,
        );

        $menu['profilo']['submenu'][] = array(
            'label' => 'menu.user.sub.logout',
            'route' => 'fos_user_security_logout',
            'order' => 99,
        );
        $menu['chi'] = array(
            'label' => 'menu.chi',
            'route' => 'chi',
            'show' => array('logged' => false),
            'order' => 20,
        );
        $menu['mappa'] = array(
            'label' => 'menu.mappe',
            'route' => 'mappe',
            'show' => array('in_role' => array('R_SUPER', 'G_SUPER')),
            'order' => 21,
        );
        
        $menu['dove'] = array(
            'label' => 'menu.dove',
            'route' => 'dove',
            'show' => array('always' => false),
            'order' => 900,
        );
        
        $menu['immobili'] = array(
            'label' => 'menu.immobili',
            'route' => 'scheda',
            'show' => array('logged' => true),
            'order' => 10,
            'a' => array('class' => 'blyellow'),
            'icon' => 'building',
        );
        
        $menu['contatti'] = array(
            'label' => 'menu.contatti',
            'route' => 'gestione-contatti',
            'show' => array('logged' => true),
            'order' => 15,
            'a' => array('class' => 'blyellow'),
            'icon' => 'group',
        );
    
        
        $menu['annunci'] = array(
            'label' => 'menu.annunci',
            'submenu' => array(),
            'order' => 15,
        );
        $container->setParameter('jf.menu2', $menu);
    }

    public function setPackage(ContainerBuilder $container) {
        
    }

    public function setRoles(ContainerBuilder $container) {
        
    }

    public function setWidgets(ContainerBuilder $container) {
        
    }

}

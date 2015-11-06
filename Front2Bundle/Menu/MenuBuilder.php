<?php

namespace Casa\Front2Bundle\Menu;

use Doctrine\ORM\EntityManager;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Menu\MenuItem;
use Symfony\Component\Security\Core\SecurityContextInterface;
use JF\UtilityBundle\Utility\Debug;

class MenuBuilder {

    /**
     * @var FactoryInterface 
     */
    private $factory;

    /**
     * @var Request 
     */
    private $request;

    /**
     * @var SecurityContextInterface 
     */
    private $sc;

    /**
     * @var \Ephp\ACLBundle\Model\BaseUser 
     */
    private $user;
    
    /**
     * @var EntityManager
     */
    private $em;
    
    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, SecurityContextInterface $sc, EntityManager $em) {
        $this->factory = $factory;
        $this->em = $em;
        $this->sc = $sc;
        if ($this->sc) {
            if (null !== $token = $this->sc->getToken()) {
                if (is_object($user = $token->getUser())) {
                    $this->user = $user;
                }
            }
        }
    }
    
    public function addVoci(&$menu) {
        
        if ($this->user && $this->user->getAgenzia()) {
            $tipi = $this->em->getRepository('CasaFront2Bundle:Categoria')->findAll();
        } else {
            $tipi = $this->em->getRepository('CasaFront2Bundle:Categoria')->findAll();
        }

        $i = 1;
        foreach ($tipi as $tipo) {
            /* @var $tipo \Casa\Front2Bundle\Entity\Categoria */
            $menu['annunci']['submenu']['cat'.$tipo->getId()] = array(
                'label' => 'menu.annunci.sub.'.strtolower($tipo->getCategoria()),
                'route' => 'annunci',
                'routeParameters' => array('id' => $tipo->getId()),
//                'show' => array('logged' => false),
                'order' => 10+$i++,
            );
        }
    }

    public function createHeaderMenu(Request $request, $voci) {
        $this->addVoci($voci);
        $this->request = $request->getUser();
        $menu = $this->factory->createItem('root');
        $menu->setAttribute('id', 'menu_sidebar')->setAttribute('class', 'navigation bordered');

        $this->buildHeaderMenu($menu, $voci, $request->get('_route'));
        $menu->setExtra('user', $this->user);
        
        return $menu;
    }

    private function buildHeaderMenu(MenuItem $menu, $voci, $route, $level = 0) {
        usort($voci, function($a, $b) {
                    if (!isset($a['order'])) {
                        $a['order'] = 1000;
                    }
                    if (!isset($b['order'])) {
                        $b['order'] = 1000;
                    }
                    return $a['order'] > $b['order'];
                });
        foreach ($voci as $voce) {
            if (!isset($voce['show'])) {
                $voce['show'] = array('always' => true);
            }
            if ($this->show($voce['show'])) {
                if (isset($voce['route'])) {
    if (isset($voce['routeParameters'])) {
        $vm = $menu->addChild($voce['label'] . '.lbl', array('route' => $voce['route'], 'routeParameters' => $voce['routeParameters']));
    } else {
        $vm = $menu->addChild($voce['label'] . '.lbl', array('route' => $voce['route']));
    }
    if (strpos($route, $voce['route']) === 0) {
        $this->active($vm);
    }
} else {
    if (isset($voce['submenu'])) {
        if (!isset($voce['label'])) {
            Debug::pr($voce);
        }
        $vm = $menu->addChild($voce['label'] . '.lbl', array('url' => 'javascript:void(0);'));
        $this->buildHeaderMenu($vm, $voce['submenu'], $route, $level + 1);
        $vm->setChildrenAttribute('class', 'sub-menu');
        if (!$vm->hasChildren()) {
            $vm->setDisplay(false);
        }
    } else {
        if (isset($voce['url'])) {
            $vm = $menu->addChild($voce['label'] . '.lbl', array('uri' => $voce['url']));
        } else {
            $vm = $menu->addChild($voce['label'] . '.lbl');
        }
    }
}
                if ($level == 0) {
                    if (!isset($voce['a']['class'])) {
                        $voce['a']['class'] = $voce['label'].'.class';
                    }
                } else {
                    if (!isset($voce['a']['class'])) {
                        $voce['a']['class'] = $voce['label'].'.class';
                    }
                }
                if (isset($voce['a'])) {
                    foreach ($voce['a'] as $attr => $val) {
                        $vm->setLinkAttribute($attr, $val);
                    }
                }
                if (!isset($voce['icon'])) {
                    $voce['icon'] = $voce['label'].'.icon';
                }
                if (isset($voce['icon'])) {
                    $vm->setExtra('icon', $voce['icon']);
                }
            }
        }
    }
    public function createSidebarMenu(Request $request, $voci) {
        $this->addVoci($voci);
        $this->request = $request->getUser();
        $menu = $this->factory->createItem('root');
        $menu->setAttribute('id', 'menu_sidebar')->setAttribute('class', 'navigation bordered');

        $this->buildSidebarMenu($menu, $voci, $request->get('_route'));

        return $menu;
    }

    private function buildSidebarMenu(MenuItem $menu, $voci, $route) {
        usort($voci, function($a, $b) {
                    if (!isset($a['order'])) {
                        $a['order'] = 1000;
                    }
                    if (!isset($b['order'])) {
                        $b['order'] = 1000;
                    }
                    return $a['order'] > $b['order'];
                });
        foreach ($voci as $voce) {
            if (!isset($voce['show'])) {
                $voce['show'] = array('always' => true);
            }
            if ($this->show($voce['show'])) {
                if (isset($voce['route'])) {
                    if (isset($voce['routeParameters'])) {
                        $vm = $menu->addChild($voce['label'].'.lbl', array('route' => $voce['route'], 'routeParameters' => $voce['routeParameters']));
                    } else {
                        $vm = $menu->addChild($voce['label'].'.lbl', array('route' => $voce['route']));
                    }
                    if(strpos($route, $voce['route']) === 0) {
                        $this->active($vm);
                    }
                } else {
                    if (isset($voce['submenu'])) {
                        $vm = $menu->addChild($voce['label'], array('url' => 'javascript:void(0);'));
                        $vm->setAttribute('class', 'submenu');
                        $this->buildSidebarMenu($vm, $voce['submenu'], $route);
                        if(!$vm->hasChildren()) {
                            $vm->setDisplay(false);
                        }
                    } else {
                        $vm = $menu->addChild($voce['label']);
                    }
                }
                if (isset($voce['a'])) {
                    foreach ($voce['a'] as $attr => $val) {
                        $vm->setLinkAttribute($attr, $val);
                    }
                }
                if (isset($voce['icon'])) {
                    $vm->setExtra('icon', $voce['icon']);
                }
            }
        }
    }

    private function active(\Knp\Menu\MenuItem $vm) {
        if(!$vm->isRoot()) {
            $vm->setExtra('active', true);
            $vm->setAttribute('class', 'active');
            $this->active($vm->getParent());
        }
    }

    private function show($rules) {
        $out = false;
        if (isset($rules['always'])) {
            $out = $rules['always'];
        }
        if (isset($rules['logged'])) {
            $out = $rules['logged'] ? is_object($this->user) : !is_object($this->user);
        }
        if (is_object($this->user) && isset($rules['in_role'])) {
            if (!is_array($rules['in_role'])) {
                $rules['in_role'] = array($rules['in_role']);
            }
            foreach ($rules['in_role'] as $role) {
                $out |= $this->user->hasRole($role);
            }
        }
        if (is_object($this->user)) {
            if (isset($rules['out_role'])) {
                if (!is_array($rules['out_role'])) {
                    $rules['out_role'] = array($rules['out_role']);
                }
                $test = true;
                foreach ($rules['out_role'] as $role) {
                    $test &=!$this->user->hasRole($role);
                }
                $out = $test;
            }
            if (isset($rules['license'])) {
                $active = $this->user->getActiveLicenses();
                foreach ($rules['license'] as $gruppo => $licenses) {
                    if(isset($active[$gruppo])) {
                        $out &= in_array($active[$gruppo], $licenses);
                    } else {
                        $out = false;
                    }
                }
            }
        }

        return $out;
    }
    

}
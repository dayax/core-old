<?php

/*
 * This file is part of the dayax project.
 *
 * (c) Anthonius Munthi <toni.dayax@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dayax\core;

use dayax\core\Message;

/**
 * Exception Class.
 *
 * @author Anthonius Munthi <toni.dayax@gmail.com>
 */
class Exception extends \Exception {

    static private $_splClasses = null;
    static private $_packages = array(
        'dayax',
    );
    
    private $message_code = null;
    
    public function __construct() {
        $args = func_get_args();
        $this->message_code = $args[0];
        $message = Message::translateMessage(func_get_args());        
        parent::__construct($message);
    }

    static public function registerAutoload() {
        $autoloads = spl_autoload_functions();        
        $callback = array('dayax\core\Exception', 'loadClass');
        if (!in_array($callback, $autoloads)) {
            spl_autoload_register($callback);
        }
    }

    static public function addPackage($name) {
        if (!in_array($name, self::$_packages)) {
            self::$_packages[] = $name;
        }
    }

    static public function loadClass($class) {
                
        if (false === strpos($class, "\\") || false === strpos($class, 'Exception')) {
            return;
        }        
        $exp = explode("\\", $class);        
        if (!in_array($exp[0], self::$_packages)) {
            return;
        }        
        if (is_null(self::$_splClasses)) {
            self::$_splClasses = array();
            foreach (spl_classes() as $splClass) {
                if (false !== strpos($splClass, 'Exception')) {
                    if (!in_array($splClass, self::$_splClasses)) {
                        self::$_splClasses[] = $splClass;
                    }
                }
            }
        }
        
        $pos = strrpos($class, '\\');
        $exception = substr($class, $pos + 1);
        $namespace = substr($class, 0, $pos);
        $extends = in_array($exception, self::$_splClasses) ? '\\' . $exception : "\\Exception";
        $tpl = <<<EOC

    namespace $namespace{
    use dayax\core\Message;
    class $exception extends $extends
    {
        public function __construct()
        {
            \$message = Message::translateMessage(func_get_args());            
            parent::__construct(\$message);
        }
    }
    }//end of namespace;
EOC;
        
        eval($tpl);        
    }
        
    public function getMessageCode()
    {
        return $this->message_code;
    }
    
}

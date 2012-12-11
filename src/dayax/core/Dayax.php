<?php

/*
 * This file is part of the dayax project.
 *
 * (c) Anthonius Munthi <toni.munthi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dayax\core;
class Dayax
{    

    static private $_cacheDir;
    static private $loader;
    
    static public function getVendorDir()
    {
        return realpath(__DIR__.'/../../../vendors');
    }

    static public function setCacheDir($dir)
    {
        self::$_cacheDir = $dir;
    }

    static public function getCacheDir()
    {
        if(is_null(self::$_cacheDir)){
            self::$_cacheDir = __DIR__.'/../../../cache';
        }
        return self::$_cacheDir;
    }

    static public function serialize($data,$file=null)
    {
        $serialized = serialize(array($data));
        if(!is_null($file)){
            file_put_contents($file, $serialized,LOCK_EX);
        }
        return $serialized;
    }

    static public function unserialize($data)
    {
        if(is_file($data)){
            $unserialized = file_get_contents($data,LOCK_EX);
            $unserialized = unserialize($unserialized);
            return $unserialized[0];
        }
        $data = unserialize($data);

        return $data[0];
    }

    static public function jsonDecode($source,$assoc=null,$depth=null)
    {
        if(is_file($source)){
            $source = file_get_contents($source);
        }
        $args = func_get_args();
        array_shift($args);
        $params = array_merge(array($source),$args);
        return call_user_func_array('json_decode', $params);
    }
    
    static public function getPathOfNamespace($namespace)
    {
        $pos = strrpos($namespace, "\\");
        $ns = substr($namespace, 0, $pos);
        $class = substr($namespace, $pos + 1);
        
        $prefixes = self::getLoader()->getPrefixes();        
        foreach ($prefixes as $package => $paths) {
            if (false !== strpos($ns, $package)) {
                foreach ($paths as $path) {                    
                    $dir = $path.DIRECTORY_SEPARATOR . $ns . DIRECTORY_SEPARATOR . $class;                    
                    $dir = str_replace("\\", DIRECTORY_SEPARATOR, $dir);                    
                    if (is_file($file = $dir . '.php')) {
                        return $file;
                    } elseif (is_dir($dir)) {
                        return $dir;
                    }
                }// end for paths loop
            }
        }// end for namespaces loop
    }
    
    /**     
     * @return \Composer\Autoload\ClassLoader
     */
    static public function getLoader()
    {                
        return self::$loader;     
    }
    
    static public function setLoader($loader)
    {
        self::$loader = $loader;
    }
}
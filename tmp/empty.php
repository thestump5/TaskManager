<?php
final class DependencyContainer 
{
    const EXCEPTION_NO_CLASS_NAME = 'There is no such class name: %s';
    const EXCEPTION_INVALID_CONFIG = 'Config file is invalid: %s';
    const CONFIG_PATH = '/../Config/dependencyContainer.php';

    /**      
     * @var DependencyContainer      
     */     

    private static $instance;     
    private $config = array();      
    
    private final function __construct($configPath) 
    {
        $this->loadConfig($configPath);
    }      

    private final function __clone() {}      

    /**      
     * @return DependencyContainer
     */     

    public static function getInstance() 
    {         
        if (null === self::$instance) 
        {             
            self::$instance = new self(self::CONFIG_PATH);         
        }         

        return self::$instance;     
    }      
    
    private function loadConfig($configPath) 
    {         
        $config = require __DIR__ . $configPath;         
        if (!is_array($config)) 
        {             
            throw new \InvalidArgumentException(sprintf(self::EXCEPTION_INVALID_CONFIG, $configPath));         
        }         
        
        $this->config = $config;     
    }      
    
    public function set($className, $fullPath) 
    {
        $this->config[$className] = $fullPath;
    }
    
    public function __call($name, $arguments)
    {
        $className = substr($name, strlen('new'));
        if (isset($this->config[$className]))
        {
            return new $this->config[$className]($arguments);
        }
        
        throw new \InvalidArgumentException(sprintf(self::EXCEPTION_NO_CLASS_NAME, $className));
    }
}
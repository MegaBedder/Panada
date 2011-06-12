<?php defined('THISPATH') or die('Can\'t access directly!');
/**
 * Panada Memcached API Driver.
 *
 * @package	Driver
 * @subpackage	Cache
 * @author	Iskandar Soesman
 * @since	Version 0.1
 */

/**
 * EN: Makesure Memcache extension is enabled
 */
if( ! extension_loaded('memcache') )
    Library_error::_500('Memcache extension that required by Library_memcached is not available.');

class Drivers_cache_memcached extends Memcache {
    
    public $port = 11211;
    
    /**
     * EN: Load configuration from config file.
     * @return void
     */
    
    public function __construct( $config_instance ){
        
	$config_instance->host = (array) $config_instance->host;
	
        foreach($config_instance->host as $host)
	    $this->addServer($host, $this->port);
	
	/**
	 * EN: If you need compression Threshold, you can uncomment this
	 */
	//$this->setCompressThreshold(20000, 0.2);
    }
    
    /**
     * @param string $key
     * @param mix $value
     * @param int $expire
     * @return void
     */
    public function set_value( $key, $value, $expire = 0 ){
        
        return $this->set($key, $value, 0, $expire);
    }
    
    /**
     * Cached the value if the key doesn't exists,
     * other wise will false.
     *
     * @param string $key
     * @param mix $value
     * @param int $expire
     * @return void
     */
    public function add_value( $key, $value, $expire = 0 ){
        
	return $this->add($key, $value, 0, $expire); 
    }
    
    /**
     * Update cache value base on the key given.
     *
     * @param string $key
     * @param mix $value
     * @param int $expire
     * @return void
     */
    public function update_value( $key, $value, $expire = 0 ){
        
	return $this->replace($key, $value, 0, $expire);
    }
    
    /**
     * @param string $key
     * @return mix
     */
    public function get_value( $key ){
        
        return $this->get($key);
    }
    
    /**
     * @param string $key
     * @return void
     */
    public function delete_value( $key ){
        
        return $this->delete($key);
    }
    
    /**
     * Flush all cached object.
     * @return bool
     */
    public function flush_values(){
        
	return $this->flush();
    }
    
} // End Drivers_cache_memcached
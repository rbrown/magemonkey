<?php

/**
 * Module's cache model
 *
 */
class Ebizmarts_MageMonkey_Model_Cache
{

    /**
     * @var bool Store if cache type is enabled
     */
    protected $_isEnabled;

    /**
     * @var array Store cache tags
     */
    protected $_cacheTags;

    /**
     * @var int|null Cache lifetime in seconds or NULL for infinite lifetime
     */
	protected $_cacheLifetime = NULL;

	/**
	 * @const CACHE_TAG General cache tag
	 */
    const CACHE_TAG = 'MONKEY_GENERAL_CACHE_TAG';

	/**
	 * @const CACHE_ID Cache ID
	 */
    const CACHE_ID  = 'monkey';

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->_isEnabled = Mage::app()->useCache(self::CACHE_ID);
        $this->_cacheTags = array(self::CACHE_TAG);
    }

    /**
     * Check if <monkey> cache is enabled
     *
     * @return bool
     */
    public function isCacheEnabled()
    {
        return $this->_isEnabled;
    }

    /**
     * Return cache tags
     *
     * @return array Cache tags
     */
    public function getCacheTags()
    {
        return $this->_cacheTags;
    }

    /**
     * Return cache lifetime
     *
     * @return null|int
     */
    public function getCacheLifetime()
    {
    	return $this->_cacheLifetime;
    }

    /**
     * Save page body to cache storage
     *
     * @param Varien_Event_Observer $observer
     * @return Enterprise_PageCache_Model_Observer
     */
    public function cacheData(Varien_Event_Observer $observer)
    {
        if (!$this->isCacheEnabled()) {
            return $this;
        }

		//$data must be a string
        Mage::app()->saveCache($data, $cacheId, $this->getCacheTags(), $this->getCacheLifetime());

        return $this;
    }

	/**
	 * Retrieve data from Cache
	 *
	 * @param string $cacheId Cache ID
	 * @return mixed Cache data
	 */
	public function loadCacheData($cacheId)
	{
		return Mage::app()->loadCache($cacheId);
	}

    /**
     * Clean <monkey> cache
     *
     * @return Ebizmarts_MageMonkey_Model_Cache
     */
    public function cleanCache()
    {
        Mage::app()->cleanCache(self::CACHE_TAG);
        return $this;
    }

    /**
     * Invalidate <monkey> cache
     *
     * @return Ebizmarts_MageMonkey_Model_Cache
     */
    public function invalidateCache()
    {
        Mage::app()->getCacheInstance()->invalidateType(self::CACHE_ID);
        return $this;
    }

}
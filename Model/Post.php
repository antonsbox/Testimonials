<?php

namespace Test\Testimonials\Model;

use Test\Testimonials\Api\Data\PostInterface;
use Magento\Framework\DataObject\IdentityInterface;

class Post extends \Magento\Framework\Model\AbstractModel implements PostInterface, IdentityInterface {
    /*
     * #@+
     * Post's Statuses
     */

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    /*
     * #@+
     * CMS page cache tag
     */
    const CACHE_TAG = 'testimonials_post';

    /**
     * @var string
     */
    protected $_cacheTag = 'testimonials_post';
    /*
     * Prefix for model events name
     * @var string
     */
    protected $_eventPrefix = 'testimonials_post';

    /*
     * Initialiaze resource model
     * @return void
     */

    protected function _construct() {
        $this->_init('Test\Testimonials\Model\ResourceModel\Post');
    }

    /**
     * Check if post url key exists
     * return post id if post exists
     *
     * @param string $url_key
     * @return int
     */
    public function checkUrlKey($url_key) {
        return $this->_getResource()->checkUrlKey($url_key);
    }

    /**
     * Prepare post's statuses.
     * Available event testimonials_post_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses() {

        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities() {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /*
     * Get ID
     * @return int|null
     */

    public function getId() {
        return $this->getData(self::POST_ID);
    }

    /**
     * Get URL Key
     *
     * @return string
     */
    public function getUrlKey() {
        return $this->getData(self::URL_KEY);
    }

    /*
     * Get Name
     * @return string
     */

    public function getName() {
        return $this->getData(self::NAME);
    }

    /*
     * Get Text
     * @return string
     */

    public function getText() {
        return $this->getData(self::TEXT);
    }

    /*
     * Get Photo URL
     * @return string|null
     */

    public function getPhotoUrl() {
        return $this->getData(self::PHOTO_URL);
    }

    /*
     * Get  post's status 
     * @return bool|null
     */

    public function isActive() {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime() {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime() {
        return $this->getData(self::UPDATE_TIME);
    }

    /*
     * Set ID
     * @param int $id
     * @return \Test\Testmonials\Api\Data\PostInterface
     */

    public function setId($id) {
        return $this->setData(self::POST_ID, $id);
    }

    /**
     * Set URL Key
     *
     * @param string $url_key
     * @return \Test\Testmonials\Api\Data\PostInterface
     */
    public function setUrlKey($url_key) {
        return $this->setData(self::URL_KEY, $url_key);
    }

    /*
     * Set Name
     * @param string $name
     * @return \Test\Testmonials\Api\Data\PostInterface
     */

    public function setName($name) {
        return $this->setData(self::NAME, $name);
    }

    /*
     * Set Text
     * @param string|null @Text
     * @return \Test\Testmonials\Api\Data\PostInterface
     */

    public function setText($text) {
        return $this->setData(self::TEXT, $text);
    }

    /*
     * Set Photo URL
     * @param string|null
     * @return \Test\Testmonials\Api\Data\PostInterface
     */

    public function setPhotoUrl($photo_url) {
        return $this->setData(self::PHOTO_URL, $photo_url);
    }

    /**
     * Set post active
     *
     * @param int|bool $isActive
     * @return \Test\Testmonials\Api\Data\PostInterface
     */
    public function setIsActive($isActive) {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Set creation time
     *
     * @param string $creation_time
     * @return \\Test\Testmonials\Api\Data\PostInterface
     */
    public function setCreationTime($creation_time) {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }

    /**
     * Set update time
     *
     * @param string $update_time
     * @return \Test\Testmonials\Api\Data\PostInterface
     */
    public function setUpdateTime($update_time) {
        return $this->setData(self::UPDATE_TIME, $update_time);
    }

}

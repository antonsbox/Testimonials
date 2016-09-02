<?php

namespace Test\Testimonials\Api\Data;

interface PostInterface {
    /*
     * Constanst for keys of data array. Identical to the name of getter in snake case
     */

    const POST_ID = 'post_id';
    const URL_KEY = 'url_key';
    const NAME = 'name';
    const TEXT = 'text';
    const PHOTO_URL = 'photo_url';
    const IS_ACTIVE = 'is_active';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME = 'update_time';

    /*
     * Get ID
     * 
     * @return int|null
     */

    public function getId();

    /**
     * Get URL Key
     *
     * @return string
     */
    public function getUrlKey();

    /*
     * Get Name
     * @return string
     */

    public function getName();
    /*
     * Get Text
     * @return string
     */

    public function getText();
    /*
     * Get Photo URL
     * @return string|null
     */

    public function getPhotoUrl();
    /*
     * Get  post's status 
     * @return bool|null
     */

    public function isActive();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /*
     * Set ID
     * @param int $id
     * @return \test\Testmonials\Api\Data\PostInterface
     */

    public function setId($id);

    /**
     * Set URL Key
     *
     * @param string $url_key
     * @return \test\Testmonials\Api\Data\PostInterface
     */
    public function setUrlKey($url_key);
    /*
     * Set Name
     * @param string $name
     * @return \test\Testmonials\Api\Data\PostInterface
     */

    public function setName($name);
    /*
     * Set Text
     * @param string|null @Text
     * @return \test\Testmonials\Api\Data\PostInterface
     */

    public function setText($text);
    /*
     * Set Photo URL
     * @param string|null
     * @return \test\Testmonials\Api\Data\PostInterface
     */

    public function setPhotoUrl($photo_url);

    /**
     * Set post active
     *
     * @param int|bool $isActive
     * @return \test\Testmonials\Api\Data\PostInterface
     */
    public function setIsActive($isActive);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return \test\Testmonials\Api\Data\PostInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return \test\Testmonials\Api\Data\PostInterface
     */
    public function setUpdateTime($updateTime);
}

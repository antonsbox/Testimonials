<?php
namespace test\testimonials\Model\Post\Source;

class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \test\testimonials\Model\Post
     */
    protected $post;

    /**
     * Constructor
     *
     * @param \test\testimonials\Model\Post $post
     */
    public function __construct(\test\testimonials\Model\Post $post)
    {
        $this->post = $post;
           
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->post->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}

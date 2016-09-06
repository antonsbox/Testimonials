<?php
namespace Test\Testimonials\Model\Post\Source;

class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Test\testimonials\Model\Post
     */
    protected $post;

    /**
     * Constructor
     *
     * @param \Test\testimonials\Model\Post $post
     */
    public function __construct(\Test\Testimonials\Model\Post $post)
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

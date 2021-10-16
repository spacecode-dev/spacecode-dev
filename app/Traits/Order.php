<?php

namespace App\Traits;

trait Order {

    /**
     * @return array
     */
    public function websites(): array
    {
        return [
            'landing_page' => __('Landing Page'),
            'one_page_website' => __('One Page Website'),
            'corporate_website' => __('Corporate Website'),
            'blog' => __('Blog'),
            'promo_website' => __('Promo Website'),
            'personal_website' => __('Personal Website'),
            'website_for_small_business' => __('Website for Small Business'),
            'individual_development' => __('Individual Development'),
            'online_portal' => __('Online Portal'),
            'ecommerce' => __('Ecommerce'),
        ];
    }

    /**
     * @return array
     */
    public function webdesign(): array
    {
        return [
            'yes_unique' => __('Yes, I have a unique design'),
            'yes_template' => __('Yes, I have a template design'),
            'no_need' => __('No, I need a web design service'),
            'no_template' => __('No, I want to buy a template'),
            'underway' => __('Underway'),
            'other' => __('Other'),
        ];
    }
}
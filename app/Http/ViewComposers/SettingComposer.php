<?php

namespace App\Http\ViewComposers;

use App\Models\Setting;
use Illuminate\View\View;

class SettingComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $settings = [
            'site_title' => Setting::getValue('site_title', 'Mubar Creative Hub'),
            'site_description' => Setting::getValue('site_description', 'Pusat Kreativitas Ekonomi Kreatif Muna Barat'),
            'site_logo' => Setting::getValue('site_logo'),
            'frontend_logo' => Setting::getValue('frontend_logo'), // New frontend logo setting
            'site_favicon' => Setting::getValue('site_favicon'),
            'contact_address' => Setting::getValue('contact_address'),
            'contact_phone' => Setting::getValue('contact_phone'),
            'contact_email' => Setting::getValue('contact_email'),
        ];

        $view->with('settings', $settings);
    }
}
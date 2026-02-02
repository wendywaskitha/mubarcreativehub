<?php

if (!function_exists('formatPhoneNumber')) {
    /**
     * Format phone number for WhatsApp API
     * Converts Indonesian format (08xx) to international format (628xx)
     *
     * @param string $phone
     * @return string
     */
    function formatPhoneNumber($phone)
    {
        // Remove all non-digit characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Convert from Indonesian format to international format
        if (substr($phone, 0, 2) === '08') {
            $phone = '62' . substr($phone, 1);
        } elseif (substr($phone, 0, 1) === '8' && strlen($phone) >= 10) {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
}

if (!function_exists('createWhatsAppMessage')) {
    /**
     * Create a properly encoded WhatsApp message
     *
     * @param string $message
     * @return string
     */
    function createWhatsAppMessage($message)
    {
        return urlencode($message);
    }
}
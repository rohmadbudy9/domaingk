<?php

if (!function_exists('wp_total_posts')) {

    function wp_total_posts(string $url): int
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => true,
            CURLOPT_NOBODY         => false,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_SSL_VERIFYPEER => false, // jika SSL OPD kadang bermasalah
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            curl_close($ch);
            return 0;
        }

        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header     = substr($response, 0, $headerSize);

        curl_close($ch);

        preg_match('/X-WP-Total:\s*(\d+)/i', $header, $matches);

        return isset($matches[1]) ? (int) $matches[1] : 0;
    }
}

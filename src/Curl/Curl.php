<?php

namespace Bjos\Curl;

/**
 * A class that manages curl requests.
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class Curl
{

    /**
     * Curl method.
     *
     * @return array|void $res
     */
    public function curlApi(string $url = null)
    {
        $res = null;

        if ($url) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($curl);
            curl_close($curl);
            $res = json_decode($output, true);
        }

        return $res;
    }

    /**
     * multicurl method
     *
     * @return array
     */
    public function multiCurlApi(array $urls) : array
    {
        $response = [];

        if (count($urls) !== 0) {
            $options = [
                CURLOPT_RETURNTRANSFER => true,
            ];

            // Add all curl handlers and remember them
            // Initiate the multi curl handler
            $mh = curl_multi_init();
            $chAll = [];
            foreach ($urls as $url) {
                $ch = curl_init("$url");
                curl_setopt_array($ch, $options);
                curl_multi_add_handle($mh, $ch);
                $chAll[] = $ch;
            }

            // Execute all queries simultaneously,
            // and continue when all are complete
            $running = null;
            do {
                curl_multi_exec($mh, $running);
            } while ($running);

            // Close the handles
            foreach ($chAll as $ch) {
                curl_multi_remove_handle($mh, $ch);
            }
            curl_multi_close($mh);

            // All of our requests are done, we can now access the results
            foreach ($chAll as $ch) {
                $data = curl_multi_getcontent($ch);
                $response[] = json_decode($data, true);
            }
        }

        return $response;
    }
}

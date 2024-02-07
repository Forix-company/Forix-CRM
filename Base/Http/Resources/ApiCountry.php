<?php

namespace Modules\Base\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
class ApiCountry extends JsonResource
{
    public static $wrap = false;

    public function toArray($request)
    {
        $cacheKey = 'api_country';
        $Country = null;
        if (Cache::has($cacheKey)) {
            $Country = Cache::get($cacheKey);
        }
        return $Country;
    }
}

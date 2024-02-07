<?php

namespace Modules\Base\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
class ApiStatesCountry extends JsonResource
{
    public static $wrap = false;

    public function toArray($request)
    {

        $cacheKey = 'api_states';
        if (Cache::has($cacheKey)) {

            $GetCitie = Cache::get($cacheKey);

            $expected = array_filter($GetCitie, function ($value) use ($request) {
                if (strpos($value['country_name'], $request->id) !== false) {
                    return $value['country_name'];
                }
            });

            foreach ($expected as $value) {
                $estados[] = $value["name"];
            }
            return $estados;
        }

    }
}

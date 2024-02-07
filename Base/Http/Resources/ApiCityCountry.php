<?php

namespace Modules\Base\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;
class ApiCityCountry extends JsonResource
{
    public static $wrap = false;

    public function toArray($request)
    {

        $cacheKey = 'api_city';
        if (Cache::has($cacheKey)) {

            $GetCitie = Cache::get($cacheKey);

            $expected = array_filter($GetCitie, function ($value) use ($request) {

                if (strpos($value['state_name'], $request->id) !== false) {
                    return $value['state_name'];
                }
            });

            foreach ($expected as $key => $value) {
                $ciudades[] = $value["name"];
            }

            return $ciudades;
        }
    }
}

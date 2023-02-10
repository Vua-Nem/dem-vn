<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\ProductVariant;
use App\Models\Promotion;
use App\Models\SeoContent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 12/21/2020
 * Time: 5:50 PM
 */
Class SeoContentService
{
    /**
     * @param $entity_id
     * @param $entity_type
     * @return mixed
     */
    public static function getSeoContent($entity_type, $entity_id = 0)
    {
        $key = 'cache_key_seo_content_' . $entity_id . "_" . $entity_type;
        $content = Cache::remember($key, 84600, function () use ($entity_id, $entity_type) {
            $query = SeoContent::where("entity_type", $entity_type);
            if ($entity_id)
                $query = $query->where("entity_id", $entity_id);

            return $query->first();
        });

        return $content;
    }
}
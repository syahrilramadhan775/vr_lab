<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Content;
use Illuminate\Http\Request;

class ContentFilteredController extends Controller
{
    /**
     * Filtered of the resource.
     */
    static public function getOrder($order)
    {
        return Content::whereHas('SubcriptionType', function ($query) use ($order) {
            $query->where('order', '>=', $order);
        })->get();
    }

    /**
     * Filtered of the resource.
     */
    static public function getContentFiltered($order, $category)
    {
        return Content::whereHas('SubcriptionType', function ($query) use ($order) {
            $query->where('order', '>=', $order);
        })->WhereHas('Category', function ($query) use ($category) {
            $query->where('title', $category);
        })->get();
    }
}

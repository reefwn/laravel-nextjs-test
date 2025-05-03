<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with(['geoLocation', 'photoSet']);

        // 🔍 Filtering
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->filled('location')) {
            $query->whereHas('geoLocation', function ($q) use ($request) {
                $q->where('province', 'like', '%' . $request->input('location') . '%');
            });
        }

        // ↕️ Sorting
        $sortField = in_array($request->input('sort_by'), ['price', 'created_at']) ? $request->input('sort_by') : 'created_at';
        $sortDir = $request->input('sort_dir') === 'asc' ? 'asc' : 'desc';
        $query->orderBy($sortField, $sortDir);

        // 📄 Pagination
        $perPage = $request->input('per_page', 25); // Default to 25 items per page
        $page = $request->input('page', 1); // Default to page 1 if not provided

        // If the page is provided, paginate with the given page and perPage
        $properties = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json($properties);
    }
}

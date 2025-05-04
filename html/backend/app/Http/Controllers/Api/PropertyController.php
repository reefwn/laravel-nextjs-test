<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // Validate search inputs
        $validated = $request->validate([
            'title' => 'nullable|string',
            'location' => 'nullable|string',
            'sort_by' => 'nullable|in:price,created_at',
            'sort_order' => 'nullable|in:asc,desc',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
        ]);

        try {
            // Build query for properties
            $query = Property::with(['geoLocation', 'photoSet']);

            if ($request->has('title')) {
                $query->where('title', 'like', '%' . $validated['title'] . '%');
            }

            if ($request->has('location')) {
                $query->whereHas('geoLocation', function ($q) use ($validated) {
                    $q->where('province', 'like', '%' . $validated['location'] . '%');
                });
            }

            $sortField = $validated['sort_by'] ?? 'created_at';
            $sortOrder = $validated['sort_order'] ?? 'desc';
            $page = $validated['page'] ?? 1;
            $perPage = $validated['per_page'] ?? 25;

            // Sort the results if sorting is provided
            if ($request->has('sort_by')) {
                $sortBy = $validated['sort_by'];
                $sortOrder = $validated['sort_order'] ?? 'asc';
                $query->orderBy($sortBy, $sortOrder);
            }

            // Apply pagination
            $properties = $query->paginate($perPage, ['*'], 'page', $page);

            if ($properties->isEmpty()) {
                return response()->json(['message' => 'No properties found'], 404);
            }

            return response()->json($properties);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json(['error' => 'An unexpected error occurred', 'message' => $e->getMessage()], 500);
        }
    }
}

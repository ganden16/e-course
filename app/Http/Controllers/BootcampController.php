<?php

namespace App\Http\Controllers;

use App\Models\Bootcamp;
use App\Models\Category;
use Illuminate\Http\Request;

class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $locale = app()->getLocale();
        $translations = include lang_path("{$locale}/bootcamp.php");

        $query = Bootcamp::with(['category', 'mentors'])
            ->where('is_active', true);

        // Filter by category
        if ($request->has('category') && $request->category !== '') {
            $query->where('category_id', $request->category);
        }

        // Sort
        if ($request->has('sort')) {
            switch($request->sort) {
                case 'price-low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'duration':
                    $query->orderByRaw('CAST(duration AS UNSIGNED)');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Get total count before applying pagination/limit
        $totalBootcamps = $query->count();

        // Handle AJAX request for load more functionality
        if ($request->ajax()) {
            $page = $request->get('page', 1);
            $offset = ($page - 1) * 6; // Load 6 items per click
            $bootcamps = $query->skip($offset)->take(6)->get();
            $bootcamp_details = $translations['bootcamp_details'];

            return response()->json([
                'html' => view('partials.bootcamp-items', compact('bootcamps', 'bootcamp_details'))->render(),
                'hasMore' => $totalBootcamps > ($offset + 6)
            ]);
        }

        // Initial load - show first 6 items
        $bootcamps = $query->take(6)->get();
        $categories = Category::where('is_active', true)->orderBy('updated_at', 'desc')->get();
        $bootcamp_details = $translations['bootcamp_details'];

        return view('bootcamp-new', compact('categories', 'bootcamps', 'totalBootcamps', 'bootcamp_details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($locale, $id)
    {
        $bootcamp = Bootcamp::with(['category', 'mentors', 'modules' => function($query) {
            $query->orderBy('week_number');
        }])->findOrFail($id);

        // Get related bootcamps (same category, excluding current bootcamp)
        $relatedBootcamps = Bootcamp::where('category_id', $bootcamp->category_id)
            ->where('id', '!=', $bootcamp->id)
            ->where('is_active', true)
            ->limit(2)
            ->get();

        // Get other bootcamps (excluding current bootcamp and related bootcamps)
        $excludedIds = [$bootcamp->id];
        foreach ($relatedBootcamps as $relatedBootcamp) {
            $excludedIds[] = $relatedBootcamp->id;
        }

        $otherBootcamps = Bootcamp::whereNotIn('id', $excludedIds)
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(2)
            ->get();

        return view('bootcamp-detail-new', compact('bootcamp', 'relatedBootcamps', 'otherBootcamps'));
    }

    /**
     * Display the specified resource.
     */
    public function showNew($locale, $id)
    {
        $bootcamp = Bootcamp::with(['category', 'mentors', 'modules' => function($query) {
            $query->orderBy('week_number');
        }])->findOrFail($id);

        // Get related bootcamps (same category, excluding current bootcamp)
        $relatedBootcamps = Bootcamp::where('category_id', $bootcamp->category_id)
            ->where('id', '!=', $bootcamp->id)
            ->where('is_active', true)
            ->limit(2)
            ->get();

        // Get other bootcamps (excluding current bootcamp and related bootcamps)
        $excludedIds = [$bootcamp->id];
        foreach ($relatedBootcamps as $relatedBootcamp) {
            $excludedIds[] = $relatedBootcamp->id;
        }

        $otherBootcamps = Bootcamp::whereNotIn('id', $excludedIds)
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit(2)
            ->get();

        return view('bootcamp-detail-new', compact('bootcamp', 'relatedBootcamps', 'otherBootcamps'));
    }
}

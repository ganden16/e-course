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
        $bootcamp_details = $translations['bootcamp_details'];

        // Bangun query dasar
        $baseQuery = Bootcamp::with(['category', 'mentors'])->where('is_active', true);

        // Filter kategori
        if ($request->filled('category')) {
            $baseQuery->where('category_id', $request->category);
        }

        // Sort
        switch ($request->get('sort', 'default')) {
            case 'price-low':
                $baseQuery->orderBy('price', 'asc');
                break;
            case 'price-high':
                $baseQuery->orderBy('price', 'desc');
                break;
            case 'rating':
                $baseQuery->orderBy('rating', 'desc');
                break;
            case 'duration':
                $baseQuery->orderByRaw('CAST(duration AS UNSIGNED)');
                break;
            default:
                $baseQuery->orderBy('created_at', 'desc');
        }

        // Hitung total tanpa pagination
        $totalBootcamps = (clone $baseQuery)->count();

        // AJAX: Load More
        if ($request->ajax()) {
            $page = $request->get('page', 1);
            $perPage = 6;
            $offset = ($page - 1) * $perPage;

            $bootcamps = (clone $baseQuery)->skip($offset)->take($perPage)->get();

            return response()->json([
                'html' => view('partials.bootcamp-items', compact('bootcamps', 'bootcamp_details'))->render(),
                'hasMore' => $totalBootcamps > $offset + $perPage
            ]);
        }

        // Halaman awal
        $bootcamps = (clone $baseQuery)->take(6)->get();
        $categories = Category::where('is_active', true)->orderBy('updated_at', 'desc')->get();

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

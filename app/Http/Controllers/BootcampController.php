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
    public function index()
    {
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        $bootcamps = Bootcamp::with(['category', 'mentors'])
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bootcamp-new', compact('categories', 'bootcamps'));
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

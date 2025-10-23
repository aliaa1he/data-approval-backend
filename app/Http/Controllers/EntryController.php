<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEntryRequest;
use App\Http\Requests\UpdateEntryRequest;

class EntryController extends Controller
{
    public function store(StoreEntryRequest $request)
    {
        $user = $request->user();

        if (!$user || !$user->isUser()) {
            return response()->json(['message' => $user ? 'Forbidden' : 'Unauthenticated.'], $user ? 403 : 401);
        }
        // Validation
        $validated = $request->validated();

        // Check duplicate
        if (Entry::where('category', $validated['category'])
            ->where('date', $validated['date'])
            ->where('numeric_value', $validated['numeric_value'])
            ->exists()) {
            return response()->json(['message' => 'Duplicate entry'], 422);
        }

        $validated['calculated_field'] = $validated['numeric_value'] * 1.1; // 1.1 Tax
        $validated['user_id'] = $user->id;

        $entry = Entry::create($validated);

        return response()->json([
            'message' => 'Entry created successfully',
            'data' => $entry
        ]);
    }

    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $query = Entry::query();

        if ($user->isUser()) {
            $query->where('user_id', $user->id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('from') && $request->has('to')) {
            $query->whereBetween('date', [$request->from, $request->to]);
        }

        $entries = $query->with(['user', 'approvedBy'])->get();

        return response()->json($entries);
    }

    public function updateStatus(UpdateEntryRequest $request, $id)
    {
        $entry = Entry::findOrFail($id);

        $validated = $request->validated();

        $entry->update([
            'status' => $validated['status'],
            'approved_by' => $request->user()->id,
            'approved_at' => now(),
        ]);

        return response()->json([
            'message' => 'Status updated successfully',
            'data' => $entry
        ]);
    }

    public function statistics(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        
        $query = Entry::query();
        
        if ($user->isUser()) {
            $query->where('user_id', $user->id);
        }
        
        $totalCount = $query->count();
        $totalValue = $query->sum('numeric_value');
        $averageValue = $query->avg('numeric_value');
        
        $statusCounts = $query->select('status')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return response()->json([
            'total_entries' => $totalCount,
            'total_value' => $totalValue,
            'average_value' => $averageValue,
            'by_status' => $statusCounts
        ]);
    }

    public function categories()
    {
        return response()->json(['categories' => Entry::allowedCategories()]);
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        if (!$user || !$user->isAdmin()) {
            return response()->json(['message' => $user ? 'Forbidden' : 'Unauthenticated.'], $user ? 403 : 401);
        }
        $entry = Entry::findOrFail($id);
        $entry->delete();
        return response()->json(['message' => 'Entry deleted successfully']);
    }
}

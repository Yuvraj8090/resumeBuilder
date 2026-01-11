<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ResumeController extends Controller
{
    /**
     * Display the index page (The Table View).
     */
    public function index()
    {
        return view('resumes.index');
    }

    /**
     * Process DataTables AJAX request (Fast Loading).
     */
    public function data(Request $request)
    {
        if ($request->ajax()) {
            // optimized query: Select only needed columns and filter by current user
            $query = Resume::where('user_id', Auth::id())
                           ->select(['id', 'title', 'template_style', 'created_at', 'updated_at']);

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('M d, Y');
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('resumes.edit', $row->id);
                    $deleteUrl = route('resumes.destroy', $row->id);
                    $csrf = csrf_token();
                    $method = method_field('DELETE');

                    return "
                        <div class='flex items-center gap-2'>
                            <a href='{$editUrl}' class='px-3 py-1 bg-indigo-50 text-indigo-600 rounded-md hover:bg-indigo-100 text-sm font-medium transition'>
                                Edit
                            </a>
                            <form action='{$deleteUrl}' method='POST' onsubmit='return confirm(\"Are you sure?\");'>
                                {$csrf}
                                {$method}
                                <button type='submit' class='px-3 py-1 bg-rose-50 text-rose-600 rounded-md hover:bg-rose-100 text-sm font-medium transition'>
                                    Delete
                                </button>
                            </form>
                        </div>
                    ";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resume.
     */
    public function create()
    {
        return view('resumes.create');
    }

    /**
     * Store a newly created resume and all its relations in one go.
     */
    public function store(Request $request)
    {
        // 1. Validate the complex nested data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'summary' => 'nullable|string',
            'template_style' => 'nullable|string',
            
            // Validate Arrays (The Relations)
            'experiences' => 'nullable|array',
            'experiences.*.job_title' => 'required|string',
            'experiences.*.employer' => 'required|string',
            
            'education' => 'nullable|array',
            'education.*.institution' => 'required|string',
            'education.*.degree' => 'required|string',

            'skills' => 'nullable|array',
            'skills.*.name' => 'required|string',
        ]);

        try {
            // 2. Use Database Transaction for Atomicity (All or Nothing)
            DB::beginTransaction();

            // A. Create the Main Resume
            $resume = Resume::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'summary' => $validated['summary'] ?? null,
                'template_style' => $validated['template_style'] ?? 'modern',
            ]);

            // B. Bulk Insert Experiences (Performance Optimization)
            if (!empty($request->experiences)) {
                $resume->experiences()->createMany($request->experiences);
            }

            // C. Bulk Insert Education
            if (!empty($request->education)) {
                $resume->education()->createMany($request->education);
            }

            // D. Bulk Insert Skills
            if (!empty($request->skills)) {
                $resume->skills()->createMany($request->skills);
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('resumes.index')
                ->with('success', 'Resume created successfully with all details!');

        } catch (\Exception $e) {
            // Rollback if anything fails
            DB::rollBack();
            
            // Log the error for debugging
            logger($e->getMessage());

            return back()->with('error', 'Failed to create resume. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resume $resume)
    {
        // Security: Ensure user owns this resume
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }

        // Eager load relationships to prevent N+1 query problem
        $resume->load(['experiences', 'education', 'skills']);

        return view('resumes.edit', compact('resume'));
    }

    /**
     * Update the resume (Logic is similar to store, but with updates).
     */
    public function update(Request $request, Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) abort(403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $resume->update($validated);

        // Note: For updating relations (Experience/Education), 
        // it is often better to handle them via specific AJAX endpoints 
        // or Livewire components to avoid deleting/recreating data.
        
        return back()->with('success', 'Resume updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }

        $resume->delete();

        return back()->with('success', 'Resume deleted successfully.');
    }
}
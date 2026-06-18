<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index()
    {
        return Inertia::render('Portfolio/Index', [
            'portfolios' => Inertia::scroll(fn () => Auth::user()->portfolios()->latest()->paginate(12))
        ]);
    }

    public function create()
    {
        return Inertia::render('Portfolio/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:4', 'max:255'],
            'kind' => ['required', 'string'],
            'file' => ['required', 'file', 'mimes:pdf,docx', 'max:5120']
        ]);
        
        $path = $request->file('file')->store(config('filesystems.resume_storage'));
        Auth::user()->portfolios()->create([
            'title' => $request['title'],
            'resume_path' => $path,
            'content' => "<h1>Hello, World</h1>"
        ]);

        return redirect()->route('dashboard');
    }

    public function show(Portfolio $portfolio)
    {
        return Inertia::render('Portfolio/Show', [
            'portfolio' => $portfolio
        ]);
    }

    public function update(Request $request)
    {
        Inertia::flash('toast', [
            'type' => 'info',
            'message' => 'Regenerating Portfolio'
        ]);
        return back();
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Portfolio has been deleted successfully.'
        ]);
        return redirect()->route('dashboard');
    }
}

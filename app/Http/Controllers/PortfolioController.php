<?php

namespace App\Http\Controllers;

use App\Ai\Agents\PortfolioBuilder;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index()
    {
        return Inertia::render('Portfolio/Index', [
            'portfolios' => Inertia::scroll(
                fn () => Auth::user()->portfolios()->latest()->paginate(12)
            ),
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
        $aiResponse = (new PortfolioBuilder)->prompt(
            "Kind: $request->kind", 
            attachments: [$request->file('file')]
        );

        $portfolio = Auth::user()->portfolios()->create([
            'title' => $request['title'],
            'resume_path' => $path,
            'content' => $aiResponse['content'],
        ]);

        return redirect()->route('portfolio.show', ['portfolio' => $portfolio]);
    }

    public function show(Portfolio $portfolio)
    {
        Gate::authorize('access', $portfolio);

        return Inertia::render('Portfolio/Show', [
            'portfolio' => $portfolio
        ]);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        Gate::authorize('access', $portfolio);

        Inertia::flash('toast', [
            'type' => 'info',
            'message' => 'Regenerating Portfolio'
        ]);
        return back();
    }

    public function destroy(Portfolio $portfolio)
    {
        Gate::authorize('access', $portfolio);

        $portfolio->delete();
        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Portfolio has been deleted successfully.'
        ]);
        return redirect()->route('portfolio.index');
    }
}

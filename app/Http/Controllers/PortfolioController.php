<?php

namespace App\Http\Controllers;

use App\Ai\Agents\PortfolioBuilder;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Laravel\Ai\Files;
use Throwable;

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
            'file' => ['required', 'file', 'mimes:pdf,docx', 'max:5120'],
        ]);

        $path = $request->file('file')->store(config('filesystems.resume_storage'));

        try {
            $response = (new PortfolioBuilder)->prompt(
                "Kind: $request->kind",
                attachments: [Files\Document::fromStorage($path)]
            );
        } catch (Throwable $e) {
            Inertia::flash('toast', [
                'type' => 'error',
                'text' => 'Failed to generate portfolio. Please try again.',
            ]);

            return redirect()->route('dashboard');
        }

        $portfolio = Auth::user()->portfolios()->create([
            'title' => $request->title,
            'resume_path' => $path,
            'content' => $response['content'],
        ]);

        Inertia::flash('toast', [
            'type' => 'success',
            'text' => 'Portfolio Created Successfully!',
        ]);

        return redirect()->route('portfolio.show', ['portfolio' => $portfolio]);
    }

    public function show(Portfolio $portfolio)
    {
        Gate::authorize('access', $portfolio);

        return Inertia::render('Portfolio/Show', [
            'portfolio' => $portfolio,
        ]);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        Gate::authorize('access', $portfolio);

        $resume = Files\Document::fromStorage($portfolio->resume_path);
        try {
            $response = PortfolioBuilder::make(action: 'update')
                ->prompt(
                    "Generated Previous HTML: $request->content",
                    attachments: [$resume]
                );
        } catch (Throwable $e) {
            Inertia::flash('toast', [
                'type' => 'error',
                'text' => 'Failed to generate portfolio. Please try again.',
            ]);

            return redirect()->route('dashboard');
        }

        $portfolio->update(['content' => $response['content']]);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Regenerated Portfolio',
        ]);

        return back();
    }

    public function destroy(Portfolio $portfolio)
    {
        Gate::authorize('access', $portfolio);

        $portfolio->delete();
        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Portfolio has been deleted successfully.',
        ]);

        return redirect()->route('portfolio.index');
    }
}

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
        return Inertia::render('Dashboard', [
            'portfolios' => Auth::user()->portfolios
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
        dd($request->all());
    }

    public function show(Portfolio $portfolio)
    {
        return Inertia::render('Portfolio/Show', [
            'portfolio' => $portfolio
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Portfolio has been deleted successfully.'
        ]);
        return back();
    }
}

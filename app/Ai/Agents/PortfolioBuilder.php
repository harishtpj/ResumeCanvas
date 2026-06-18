<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Attributes\UseCheapestModel;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Promptable;
use Laravel\Ai\Enums\Lab;
use Stringable;

#[Provider(Lab::Gemini)]
#[UseCheapestModel]
class PortfolioBuilder implements Agent, HasStructuredOutput
{
    use Promptable;

    public function instructions(): Stringable|string
    {
        return <<<PROMPT
        You're an expert Portfolio Builder who builds interactive, fully designed portfolios in HTML.

        Build a single-page portfolio (SPA) using HTML + CSS (DaisyUI via CDN) + Alpine.js (via CDN) for interactivity.
        DO NOT use any other frameworks, libraries, or tools. Output must be a single self-contained HTML file.

        You will receive:
        - Resume: The user's resume. Extract ALL sections (education, experience, projects, skills, certifications, etc.)
        and include every one of them. DO NOT add any information not present in the resume.
        - Kind: One of the following styles — adapt the palette and layout to suit the user's field, but stay within the chosen kind:
            => modern: High contrast display typography, generous white space, glassmorphic details. For designers & modern startups.
            => developer: Clean layouts, monospace accents, dark mode contrasts, code-friendly project presentation. For engineers.
            => corporate: Serif styles, ultra-clean grids, deep navy accents. For executives, consultants & finance leaders.

        RETURN ONLY structured data matching the schema. No markdown fences, no explanation, no preamble.
        PROMPT;
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'content' => $schema->string()->required(),
        ];
    }
}

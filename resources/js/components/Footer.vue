<template>
    <footer
        class="w-full py-8 md:py-10 bg-slate-50 border-t border-slate-100 select-none text-xs text-on-surface-variant mt-auto">
        <div
            class="max-w-[1280px] mx-auto px-6 md:px-8 flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
            <div class="flex flex-col gap-1 items-center md:items-start">
                <span class="font-bold text-sm text-on-surface font-sans">ResumeCanvas</span>
                <p class="text-on-surface-variant font-sans">© {{ new Date().getFullYear() }} ResumeCanvas. Developed
                    with ❤️ by <strong>Harish Kumar</strong>.
                </p>
            </div>
            <div class="flex flex-wrap justify-center gap-6 font-semibold font-sans">
                <a class="hover:text-primary transition-all cursor-pointer underline"
                   href="https://github.com/harishtpj/ResumeCanvas">View Project</a>
                <a class="hover:text-primary transition-all cursor-pointer underline font-sans"
                   href="https://harishtpj.netlify.app">About the developer</a>
            </div>
        </div>
    </footer>
</template>

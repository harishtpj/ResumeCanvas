<template>
    <footer
        class="w-full py-8 md:py-10 bg-slate-50 border-t border-slate-100 select-none text-xs text-on-surface-variant mt-auto">
        <div
            class="max-w-[1280px] mx-auto px-6 md:px-8 flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
            <div class="flex flex-col gap-1 items-center md:items-start">
                <span class="font-bold text-sm text-on-surface font-sans">ResumeCanvas AI</span>
                <p class="text-on-surface-variant font-sans">© {{ new Date().getFullYear() }} ResumeCanvas. Built with ♥ by M.V.Harish Kumar.
                </p>
            </div>
            <div class="flex flex-wrap justify-center gap-6 font-semibold font-sans">
                <span @click="emit('alert', 'Our Privacy Policy ensures your resume files remain 100% secure.', 'info')"
                    class="hover:text-primary transition-all cursor-pointer underline">Privacy Policy</span>
                <span @click="emit('alert', 'Rendering secure Terms of Service agreement.', 'info')"
                    class="hover:text-primary transition-all cursor-pointer underline">Terms of Service</span>
                <span @click="emit('alert', 'Email support tickets active at support@resumecanvas.ai.', 'info')"
                    class="hover:text-primary transition-all cursor-pointer underline font-sans">Contact Support</span>
            </div>
        </div>
    </footer>
</template>
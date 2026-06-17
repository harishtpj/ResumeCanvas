<script setup>
import {dashboard, index, login, logout, register} from '@/routes/index';
import {ref, computed} from 'vue';
import {FileBadge, LogOut, Menu, X} from '@lucide/vue';
import {Link, usePage} from '@inertiajs/vue3';

const page = usePage();
const isLoggedIn = computed(() => page.props.auth.loggedIn);
const user = computed(() => page.props.auth.user);

const mobileMenuOpen = ref(false);
</script>

<template>
    <nav
        class="fixed top-4 left-1/2 -translate-x-1/2 w-[92%] max-w-[1280px] rounded-full z-50 glass-panel shadow-[0_10px_30px_rgba(62,85,190,0.06)] flex justify-between items-center px-4 md:px-8 py-3 transition-all duration-300">
        <Link :href="index()" as="div" class="flex items-center gap-2 cursor-pointer group select-none">
      <span
          class="bg-primary text-white p-1.5 rounded-full flex items-center justify-center shadow-md shadow-primary/20 group-hover:rotate-12 transition-transform duration-300">
        <FileBadge class="w-5 h-5 text-surface-container-lowest"/>
      </span>
            <span class="font-bold text-lg md:text-xl text-primary tracking-tight font-sans">ResumeCanvas</span>
        </Link>

        <!-- Desktop Links -->
        <div class="hidden lg:flex items-center gap-8 font-sans">
            <Link :class="currentView === 'dashboard' ? 'text-primary' : 'text-on-surface-variant'" :href="dashboard()"
                  as="span"
                  class="cursor-pointer transition-colors text-sm font-semibold hover:text-primary">Dashboard
            </Link>
        </div>

        <!-- Action buttons -->
        <div class="hidden md:flex items-center gap-4">
            <Link v-if="!isLoggedIn" :href="login()" as="button"
                  class="text-on-surface-variant text-sm font-semibold hover:text-primary px-4 py-2 hover:bg-slate-100/50 rounded-full transition-all">
                Sign In
            </Link>
            <Link v-if="!isLoggedIn" :href="register()" as="button"
                  class="bg-primary text-white text-sm font-bold px-6 py-2.5 rounded-full transition-all active:scale-95 shadow-md shadow-primary/10 hover:bg-primary/95">
                Get Started
            </Link>
            <div v-else class="flex items-center gap-3">
                <Link :href="dashboard()" as="div"
                      class="cursor-pointer flex items-center gap-2 border border-outline-variant/30 px-3 py-1.5 rounded-full hover:bg-slate-50 transition-colors">
                    <div
                        class="w-6 h-6 rounded-full bg-secondary text-white font-bold flex items-center justify-center text-[10px] uppercase">
                        {{ user.initials }}
                    </div>
                    <span class="text-xs font-semibold max-w-[80px] truncate">{{ user.name }}</span>
                </Link>
                <Link as="button" class="hover:text-red-600 transition-colors hover:bg-red-50 p-2 rounded-full"
                      :href="logout()"
                      method="delete" title="Logout">
                    <LogOut class="w-4.5 h-4.5"/>
                </Link>
            </div>
        </div>

        <!-- Mobile toggle menu -->
        <button
            class="lg:hidden flex items-center justify-center w-10 h-10 rounded-full hover:bg-slate-100 transition-all text-on-surface"
            @click="mobileMenuOpen = !mobileMenuOpen">
            <Menu v-if="!mobileMenuOpen" class="w-6 h-6"/>
            <X v-else class="w-6 h-6"/>
        </button>
    </nav>

    <!-- Mobile Navigation Drawer Overlay Menu -->
    <transition name="fade">
        <div v-if="mobileMenuOpen"
             class="fixed inset-0 bg-white/95 backdrop-blur-2xl z-40 lg:hidden flex flex-col pt-24 px-6 gap-6">
            <div class="flex flex-col gap-4 text-center mt-6">
                <Link :href="dashboard()" as="span"
                      class="text-on-surface font-sans text-xl py-3 border-b border-slate-100 cursor-pointer">My
                    Dashboard
                </Link>
            </div>
            <hr class="border-slate-100"/>
            <div v-if="!isLoggedIn" class="flex flex-col gap-3 mt-4">
                <Link :href="login()" as="button"
                      class="w-full text-on-surface font-semibold py-3 border border-outline-variant/50 rounded-2xl">
                    Sign
                    In
                </Link>
                <Link :href="register()" as="button"
                      class="w-full bg-primary text-white font-bold py-3 rounded-2xl shadow-lg shadow-primary/10">Get
                    Started
                </Link>
            </div>
            <div v-else class="flex flex-col gap-3 mt-4 text-center">
                <div class="p-4 bg-slate-50 rounded-2xl flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                        {{ user.initials }}
                    </div>
                    <div class="text-left">
                        <p class="font-bold text-sm">{{ user.name }}</p>
                        <p class="text-xs text-on-surface-variant">{{ user.email }}</p>
                    </div>
                </div>
                <Link as="button" class="w-full text-red-600 font-bold py-3 rounded-2xl border border-red-200 mt-4"
                      :href="logout()"
                      method="delete">Sign Out
                </Link>
            </div>
        </div>
    </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.25s ease-out;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(-8px);
}
</style>

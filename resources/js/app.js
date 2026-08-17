import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import { animate, stagger, inView, hover } from 'framer-motion/dom';

window.Motion = { animate, stagger, inView, hover };
window.Alpine = Alpine;
Alpine.start();

/**
 * ======================================================
 * NUTRIGEN GLOBAL ALERT & TOAST SYSTEM (NutriAlert)
 * ======================================================
 * Unified, startup-grade notification & modal system.
 * Standardized across all roles (Kader, Puskesmas, Ibu).
 */

const baseSwal = Swal.mixin({
    customClass: {
        popup: '!rounded-[24px] !shadow-[0_20px_50px_rgba(0,0,0,0.14)] !border !border-slate-100 !p-6 sm:!p-7 !max-w-md',
        title: '!text-[18px] !font-bold !text-slate-800 !tracking-tight !mt-2',
        htmlContainer: '!text-[14px] !font-medium !text-slate-500 !mt-2 !mb-6 !leading-relaxed',
        actions: '!gap-3 !mt-4 !w-full !flex !justify-end !items-center',
        confirmButton: '!px-5 !py-2.5 !text-[13px] !font-semibold !text-white !bg-teal-600 hover:!bg-teal-700 !rounded-xl !transition-all !shadow-sm focus:!ring-4 focus:!ring-teal-100',
        cancelButton: '!px-5 !py-2.5 !text-[13px] !font-semibold !text-slate-600 hover:!text-slate-800 !bg-slate-100 hover:!bg-slate-200 !rounded-xl !transition-all !border-0 focus:!ring-4 focus:!ring-slate-100 !mr-2'
    },
    buttonsStyling: false
});

const toastSwal = Swal.mixin({
    toast: true,
    position: window.innerWidth >= 768 ? 'top-end' : 'top',
    showConfirmButton: false,
    showCloseButton: false,
    timer: 4000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

window.NutriAlert = {
    /**
     * Show a standardized, perfectly structured Toast Notification
     * @param {string} message - Message text
     * @param {string} type - 'success' | 'error' | 'warning' | 'info'
     * @param {string} title - Optional title
     */
    toast(message, type = 'success', title = null) {
        const typeTitles = {
            success: 'Berhasil',
            error: 'Terjadi Kesalahan',
            warning: 'Perhatian',
            info: 'Informasi'
        };

        const displayTitle = title || typeTitles[type] || 'Notifikasi';
        const progressColor = type === 'error' ? '!bg-rose-500' : (type === 'warning' ? '!bg-amber-500' : '!bg-teal-500');

        toastSwal.fire({
            icon: type,
            html: `
                <div class="flex flex-col text-left pl-1 pr-2">
                    <span class="text-[13px] font-bold text-slate-800 leading-snug">${displayTitle}</span>
                    <span class="text-[12px] font-medium text-slate-500 mt-0.5 leading-snug">${message}</span>
                </div>
            `,
            customClass: {
                popup: '!rounded-[18px] !shadow-[0_12px_36px_rgba(0,0,0,0.12)] !border !border-slate-200/80 !bg-white/95 !backdrop-blur-md !p-3.5 !mt-3 !w-auto !min-w-[300px] !max-w-[400px] !flex !items-center !gap-2',
                htmlContainer: '!m-0 !p-0 !text-left',
                timerProgressBar: `${progressColor} !h-1 !rounded-b-[18px]`
            }
        });
    },

    /**
     * Show a Success Alert Modal
     */
    success(title, text) {
        return baseSwal.fire({
            icon: 'success',
            title: title,
            text: text,
            confirmButtonText: 'Tutup'
        });
    },

    /**
     * Show an Error Alert Modal
     */
    error(title, text) {
        return baseSwal.fire({
            icon: 'error',
            title: title,
            text: text,
            confirmButtonText: 'Tutup',
            customClass: {
                popup: '!rounded-[24px] !shadow-[0_20px_50px_rgba(0,0,0,0.14)] !border !border-slate-100 !p-6 sm:!p-7 !max-w-md',
                title: '!text-[18px] !font-bold !text-slate-800 !tracking-tight !mt-2',
                htmlContainer: '!text-[14px] !font-medium !text-slate-500 !mt-2 !mb-6 !leading-relaxed',
                actions: '!gap-3 !mt-4 !w-full !flex !justify-end !items-center',
                confirmButton: '!px-5 !py-2.5 !text-[13px] !font-semibold !text-white !bg-rose-600 hover:!bg-rose-700 !rounded-xl !transition-all !shadow-sm focus:!ring-4 focus:!ring-rose-100'
            }
        });
    },
    
    /**
     * Show a Warning Alert Modal
     */
    warning(title, text) {
        return baseSwal.fire({
            icon: 'warning',
            title: title,
            text: text,
            confirmButtonText: 'Mengerti',
            customClass: {
                popup: '!rounded-[24px] !shadow-[0_20px_50px_rgba(0,0,0,0.14)] !border !border-slate-100 !p-6 sm:!p-7 !max-w-md',
                title: '!text-[18px] !font-bold !text-slate-800 !tracking-tight !mt-2',
                htmlContainer: '!text-[14px] !font-medium !text-slate-500 !mt-2 !mb-6 !leading-relaxed',
                actions: '!gap-3 !mt-4 !w-full !flex !justify-end !items-center',
                confirmButton: '!px-5 !py-2.5 !text-[13px] !font-semibold !text-white !bg-amber-600 hover:!bg-amber-700 !rounded-xl !transition-all !shadow-sm focus:!ring-4 focus:!ring-amber-100'
            }
        });
    },

    /**
     * Show a Confirmation Modal for Destructive/Important Actions
     */
    confirm(title, text, confirmText = 'Ya, Lanjutkan', cancelText = 'Batal') {
        return baseSwal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: cancelText,
            reverseButtons: true,
            customClass: {
                popup: '!rounded-[24px] !shadow-[0_20px_50px_rgba(0,0,0,0.14)] !border !border-slate-100 !p-6 sm:!p-7 !max-w-md',
                title: '!text-[18px] !font-bold !text-slate-800 !tracking-tight !mt-2',
                htmlContainer: '!text-[14px] !font-medium !text-slate-500 !mt-2 !mb-6 !leading-relaxed',
                actions: '!gap-3 !mt-4 !w-full !flex !justify-end !items-center',
                cancelButton: '!px-5 !py-2.5 !text-[13px] !font-semibold !text-slate-600 hover:!text-slate-800 !bg-slate-100 hover:!bg-slate-200 !rounded-xl !transition-all !border-0 focus:!ring-4 focus:!ring-slate-100 !mr-2',
                confirmButton: '!px-5 !py-2.5 !text-[13px] !font-semibold !text-white !bg-rose-600 hover:!bg-rose-700 !rounded-xl !transition-all !shadow-sm focus:!ring-4 focus:!ring-rose-100'
            }
        });
    },
    
    /**
     * Show a generic action confirm Modal (non-destructive)
     */
    action(title, text, confirmText = 'Konfirmasi', cancelText = 'Batal') {
        return baseSwal.fire({
            title: title,
            text: text,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: cancelText,
            reverseButtons: true,
        });
    }
};

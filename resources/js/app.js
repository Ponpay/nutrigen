import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
Alpine.start();

/**
 * ======================================================
 * NUTRIGEN GLOBAL ALERT SERVICE (NutriAlert)
 * ======================================================
 * Centralized service for Alerts, Confirmations, and Toasts.
 * Styled completely with Tailwind CSS to match Ocean & Mint.
 */

const baseSwal = Swal.mixin({
    customClass: {
        popup: 'rounded-2xl shadow-xl border border-[#E2E8F0] p-6',
        title: 'text-xl font-extrabold text-[#1E293B]',
        htmlContainer: 'text-[14px] font-medium text-[#64748B] mt-2 mb-6',
        confirmButton: 'px-5 py-2.5 text-sm font-bold text-white bg-[#10B981] hover:bg-[#059669] rounded-xl transition-colors shadow-sm focus:ring-4 focus:ring-[#A7F3D0]',
        cancelButton: 'px-5 py-2.5 text-sm font-bold text-[#64748B] hover:text-[#1E293B] bg-[#F8FAFC] hover:bg-[#E2E8F0] rounded-xl transition-colors border border-[#E2E8F0] focus:ring-4 focus:ring-slate-100 mr-3',
        actions: 'gap-3 mt-4 w-full justify-end'
    },
    buttonsStyling: false
});

const toastSwal = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
    customClass: {
        popup: 'rounded-xl shadow-lg border border-[#E2E8F0] px-4 py-3 mt-4 mr-4',
        title: 'text-sm font-bold text-[#1E293B] ml-2',
    },
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

window.NutriAlert = {
    /**
     * Show a simple Toast Notification
     */
    toast(title, type = 'success') {
        const icons = {
            success: 'success',
            error: 'error',
            info: 'info',
            warning: 'warning'
        };
        toastSwal.fire({
            icon: icons[type] || 'success',
            title: title
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
                popup: 'rounded-2xl shadow-xl border border-[#E2E8F0] p-6',
                title: 'text-xl font-extrabold text-[#1E293B]',
                htmlContainer: 'text-[14px] font-medium text-[#64748B] mt-2 mb-6',
                cancelButton: 'px-5 py-2.5 text-sm font-bold text-[#64748B] hover:text-[#1E293B] bg-[#F8FAFC] hover:bg-[#E2E8F0] rounded-xl transition-colors border border-[#E2E8F0] focus:ring-4 focus:ring-slate-100 mr-3',
                actions: 'gap-3 mt-4 w-full justify-end',
                confirmButton: 'px-5 py-2.5 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-xl transition-colors shadow-sm focus:ring-4 focus:ring-red-100'
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
            confirmButtonText: 'Tutup'
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
            reverseButtons: true, // Cancel on left, Confirm on right
            customClass: {
                popup: 'rounded-2xl shadow-xl border border-[#E2E8F0] p-6',
                title: 'text-xl font-extrabold text-[#1E293B]',
                htmlContainer: 'text-[14px] font-medium text-[#64748B] mt-2 mb-6',
                cancelButton: 'px-5 py-2.5 text-sm font-bold text-[#64748B] hover:text-[#1E293B] bg-[#F8FAFC] hover:bg-[#E2E8F0] rounded-xl transition-colors border border-[#E2E8F0] focus:ring-4 focus:ring-slate-100 mr-3',
                actions: 'gap-3 mt-4 w-full justify-end',
                confirmButton: 'px-5 py-2.5 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-xl transition-colors shadow-sm focus:ring-4 focus:ring-red-100'
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

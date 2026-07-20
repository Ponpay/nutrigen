@if(session()->has('success') || session()->has('error') || session()->has('warning') || session()->has('info'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session()->has('success'))
            if(window.NutriAlert) window.NutriAlert.toast("{{ session('success') }}", 'success');
        @endif
        
        @if(session()->has('error'))
            if(window.NutriAlert) window.NutriAlert.error("Terjadi Kesalahan", "{{ session('error') }}");
        @endif
        
        @if(session()->has('warning'))
            if(window.NutriAlert) window.NutriAlert.warning("Peringatan", "{{ session('warning') }}");
        @endif
        
        @if(session()->has('info'))
            if(window.NutriAlert) window.NutriAlert.toast("{{ session('info') }}", 'info');
        @endif
    });
</script>
@endif

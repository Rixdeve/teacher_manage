{{-- resources/views/partials/theme.blade.php --}}
<script>
    // Apply theme early before tailwind loads
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
    }

    // Fix Back button not applying theme due to bfcache
    window.addEventListener('pageshow', () => {
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    });
</script>

<script>
    function toggleTheme() {
        const isDark = document.documentElement.classList.toggle('dark');
        const theme = isDark ? 'dark' : 'light';

        localStorage.setItem('theme', theme);

        fetch('/toggle-theme', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ theme: theme })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                alert("Failed to update theme preference.");
            }
        })
        .catch(() => alert("Theme update failed."));
    }
</script>

@include('layouts.header')


<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content {
        flex: 1;
    }
</style>

<div class="wrapper">
    <div class="content">
        <!-- Your page content here -->
        @yield('content')

    </div>
    {{-- <footer class="bg-light py-5">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">Copyright &copy; 2023 - Library</div>
        </div>
    </footer> --}}
    @include('layouts.footer')

</div>

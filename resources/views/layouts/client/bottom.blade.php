<!-- Bottom Navigation -->
<nav class="bottom-nav">
    <div class="row text-center g-0">
        <a class="col text-dark text-decoration-none" href="{{ route('client.home') }}">
            <i class="bi bi-house-door nav-icon d-block"></i>
            <small>Home</small>
        </a>
        <a class="col text-dark text-decoration-none" href="{{ route('client.market') }}">
            <i class="bi bi-graph-up nav-icon d-block"></i>
            <small>Markets</small>
        </a>
        <a class="col text-dark text-decoration-none" href="{{ route('client.holdings') }}">
            <i class="bi bi-coin nav-icon d-block"></i>
            <small>Holdings</small>
        </a>
        <a class="col text-dark text-decoration-none" href="{{ route('client.account') }}">
            <i class="bi bi-person-circle nav-icon d-block"></i>
            <small>Account</small>
        </a>
    </div>
</nav>

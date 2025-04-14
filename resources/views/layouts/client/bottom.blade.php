<!-- Bottom Navigation -->
<nav class="bottom-nav">
    <div class="row text-center g-0">
        <a class="col text-dark text-decoration-none" href="{{ route('client.home') }}">
            <i class="bi bi-house-door nav-icon d-block"></i>
            <small>Início</small>
        </a>
        <a class="col text-dark text-decoration-none" href="{{ route('client.market') }}">
            <i class="bi bi-graph-up nav-icon d-block"></i>
            <small>Mercado</small>
        </a>
        <a class="col text-dark text-decoration-none" href="{{ route('client.holdings') }}">
            <i class="bi bi-coin nav-icon d-block"></i>
            <small>Ativos</small>
        </a>
        <a class="col text-dark text-decoration-none" href="{{ route('client.account') }}">
            <i class="bi bi-person-circle nav-icon d-block"></i>
            <small>Conta</small>
        </a>
    </div>
</nav>

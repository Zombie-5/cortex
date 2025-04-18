@extends('layouts.client.app')

@section('content')
    <div class="container mt-5 pt-4">
        <!-- Banner Section -->
        <div id="carouselExampleIndicators" class="carousel slide mb-2 rounded" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.prismic.io/contrary-research/65834bbe531ac2845a26d51b_4.png?auto=format,compress"
                        class="d-block w-100 rounded" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.cifinancial.com/ci-gam/ca/en/expert-insights/articles/what-is-bitcoin/_jcr_content/root/responsivegrid/custom_container_left/custom_container_main/container_1320966451/image_copy.coreimg.jpeg/1629384723085/what-is-bitcoin.jpeg"
                        class="d-block w-100 rounded" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.jacksms.it/wp-content/uploads/2024/03/etoro-social-trading.jpg"
                        class="d-block w-100 rounded" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Feature Grid -->
        <div class="feature-grid">
            <a class="feature-card text-dark text-decoration-none" href="{{ route('client.market') }}">
                <i class="bi bi-graph-up feature-icon"></i>
                <h5>Mercado</h5>
            </a>
            <a class="feature-card text-dark text-decoration-none" href="https://www.etoro.com/about/">
                <i class="bi bi-info-circle feature-icon"></i>
                <h5>Sobre Nós</h5>
            </a>
            <a class="feature-card text-dark text-decoration-none" href="{{ route('client.team') }}">
                <i class="bi bi-people feature-icon"></i>
                <h5>Equipe</h5>
            </a>
            <a class="feature-card text-dark text-decoration-none" href="{{ route('client.holdings') }}">
                <i class="bi bi-coin feature-icon"></i>
                <h5>Ativos</h5>
            </a>
        </div>

        <!-- News Section -->
        <div class="news-section">
            <h4 class="mb-4">Notícias</h4>

            @forelse($notices as $notice)
                <div class="news-card d-flex align-items-center mb-3">
                    <div class="flex-grow-1">
                       {{$notice->notice}}
                    </div>
                </div>
            @empty
                <p>Nenhuma notícia encontrada.</p>
            @endforelse
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade show" id="inviteModal" tabindex="-1" aria-labelledby="inviteModalLabel" aria-hidden="true"
        style="display: block; background-color: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered custom-modal-beta">
            <div class="modal-content rounded shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="inviteModalLabel">Bem-vindo à Etoro!</h5>
                    <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <a href={{ $links->link_manager ?? '#' }} target="_blank" class="btn btn-success form-control mb-3">
                        <i class="bi bi-whatsapp"></i> Fale com o Gerente
                    </a>
                    <a href={{ $links->link_customer_service ?? '#' }} target="_blank"
                        class="btn btn-success form-control mb-3">
                        <i class="bi bi-whatsapp"></i> Fale com o apoio ao ciente
                    </a>
                    <a href={{ $links->link_group ?? '#' }} target="_blank" class="btn btn-success form-control mb-3">
                        <i class="bi bi-whatsapp"></i> Faça parte do grupo
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function closeModal() {
            const modal = document.getElementById('inviteModal');
            modal.style.display = 'none';
        }
    </script>
@endsection

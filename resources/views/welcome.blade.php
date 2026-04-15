<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Baldub') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        :root {
            color-scheme: light;
            --ink: #141414;
            --muted: #5f6268;
            --line: #d9dde3;
            --brand: #c4171f;
            --brand-dark: #8f1218;
            --panel: #f4f6f8;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Instrument Sans", Arial, sans-serif;
            color: var(--ink);
            background: var(--white);
        }

        .topbar {
            border-bottom: 1px solid var(--line);
            background: var(--white);
        }

        .topbar__inner {
            width: min(1120px, calc(100% - 32px));
            min-height: 76px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0;
        }

        .brand__mark {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            color: var(--white);
            background: var(--brand);
            font-weight: 700;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 18px;
            color: var(--muted);
            font-size: 15px;
        }

        .nav a {
            color: inherit;
            text-decoration: none;
        }

        .hero {
            min-height: calc(100vh - 76px);
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(360px, 520px);
            align-items: stretch;
        }

        .hero__content {
            padding: clamp(48px, 8vw, 104px) max(32px, calc((100vw - 1120px) / 2));
            padding-right: clamp(32px, 6vw, 80px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 28px;
        }

        .eyebrow {
            margin: 0;
            color: var(--brand);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0;
        }

        h1 {
            max-width: 760px;
            margin: 0;
            font-size: clamp(40px, 7vw, 82px);
            line-height: 0.98;
            letter-spacing: 0;
        }

        .intro {
            max-width: 720px;
            margin: 0;
            color: var(--muted);
            font-size: clamp(18px, 2vw, 22px);
            line-height: 1.6;
        }

        .values {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1px;
            max-width: 720px;
            border: 1px solid var(--line);
            background: var(--line);
        }

        .value {
            min-height: 112px;
            padding: 22px;
            background: var(--white);
        }

        .value strong {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .value span {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.45;
        }

        .cta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px;
        }

        .button {
            display: inline-flex;
            min-height: 48px;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            padding: 0 22px;
            color: var(--white);
            background: var(--brand);
            text-decoration: none;
            font-weight: 700;
        }

        .button:hover {
            background: var(--brand-dark);
        }

        .phone {
            color: var(--ink);
            font-weight: 700;
            text-decoration: none;
        }

        .hero__image {
            position: relative;
            min-height: 520px;
            overflow: hidden;
            background: var(--panel);
        }

        .hero__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: saturate(0.95) contrast(1.02);
        }

        .hero__image::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(20, 20, 20, 0.04), rgba(20, 20, 20, 0.2));
        }

        .stock {
            padding: 56px max(32px, calc((100vw - 1120px) / 2));
            background: var(--panel);
        }

        .stock__inner {
            width: min(1120px, 100%);
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
        }

        .stock h2 {
            margin: 0;
            font-size: clamp(28px, 4vw, 44px);
            line-height: 1.1;
            letter-spacing: 0;
        }

        .stock p {
            max-width: 520px;
            margin: 0;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.55;
        }

        .references {
            padding: clamp(56px, 8vw, 96px) max(32px, calc((100vw - 1120px) / 2));
            background: var(--white);
        }

        .references__inner {
            width: min(1120px, 100%);
            margin: 0 auto;
        }

        .section-head {
            display: grid;
            grid-template-columns: minmax(0, 0.95fr) minmax(280px, 0.7fr);
            gap: 36px;
            align-items: end;
            margin-bottom: 34px;
        }

        .section-head h2 {
            margin: 8px 0 0;
            font-size: clamp(32px, 5vw, 58px);
            line-height: 1.02;
            letter-spacing: 0;
        }

        .section-head p {
            margin: 0;
            color: var(--muted);
            font-size: 18px;
            line-height: 1.6;
        }

        .reference-proof {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            border: 1px solid var(--line);
            margin-bottom: 34px;
        }

        .reference-proof__item {
            min-height: 132px;
            padding: 24px;
            border-right: 1px solid var(--line);
        }

        .reference-proof__item:last-child {
            border-right: 0;
        }

        .reference-proof__item strong {
            display: block;
            margin-bottom: 9px;
            font-size: 17px;
        }

        .reference-proof__item span {
            display: block;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.5;
        }

        .reference-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .reference-card {
            display: flex;
            min-height: 100%;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--white);
        }

        .reference-card__media {
            position: relative;
            width: 100%;
            aspect-ratio: 4 / 3;
            border: 0;
            padding: 0;
            cursor: pointer;
            background: var(--panel);
            overflow: hidden;
        }

        .reference-card__media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 180ms ease;
        }

        .reference-card__media:hover img {
            transform: scale(1.03);
        }

        .reference-card__badge {
            position: absolute;
            right: 12px;
            bottom: 12px;
            border-radius: 8px;
            padding: 7px 10px;
            color: var(--white);
            background: rgba(20, 20, 20, 0.76);
            font-size: 13px;
            font-weight: 700;
        }

        .reference-card__body {
            display: flex;
            flex: 1;
            flex-direction: column;
            gap: 14px;
            padding: 20px;
        }

        .reference-card h3 {
            margin: 0;
            font-size: 21px;
            line-height: 1.2;
        }

        .reference-card p {
            margin: 0;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.55;
        }

        .reference-card__action {
            align-self: flex-start;
            margin-top: auto;
            border: 1px solid var(--ink);
            border-radius: 8px;
            padding: 10px 14px;
            color: var(--ink);
            background: var(--white);
            cursor: pointer;
            font: inherit;
            font-weight: 700;
        }

        .reference-card__action:hover {
            color: var(--white);
            background: var(--ink);
        }

        .references-empty {
            border: 1px dashed var(--line);
            padding: 28px;
            color: var(--muted);
            text-align: center;
        }

        .modal {
            position: fixed;
            inset: 0;
            z-index: 50;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: rgba(20, 20, 20, 0.78);
        }

        .modal.is-open {
            display: flex;
        }

        .modal__dialog {
            width: min(1040px, 100%);
            max-height: min(860px, calc(100vh - 48px));
            display: grid;
            grid-template-rows: auto minmax(0, 1fr) auto;
            overflow: hidden;
            border-radius: 8px;
            background: var(--white);
        }

        .modal__head,
        .modal__foot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--line);
        }

        .modal__foot {
            border-top: 1px solid var(--line);
            border-bottom: 0;
        }

        .modal__title {
            min-width: 0;
        }

        .modal__title strong {
            display: block;
            font-size: 18px;
            line-height: 1.25;
        }

        .modal__title span {
            display: block;
            margin-top: 4px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.4;
        }

        .modal__close,
        .modal__nav {
            min-width: 44px;
            min-height: 44px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--white);
            cursor: pointer;
            font: inherit;
            font-weight: 700;
        }

        .modal__body {
            position: relative;
            min-height: 280px;
            background: #101010;
        }

        .modal__body img {
            width: 100%;
            height: min(62vh, 620px);
            display: block;
            object-fit: contain;
        }

        .modal__controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal__counter {
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
        }

        .modal__thumbs {
            display: flex;
            min-width: 0;
            gap: 8px;
            overflow-x: auto;
        }

        .modal__thumb {
            width: 58px;
            height: 44px;
            flex: 0 0 auto;
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 0;
            background: var(--panel);
            cursor: pointer;
            overflow: hidden;
        }

        .modal__thumb.is-active {
            border-color: var(--brand);
        }

        .modal__thumb img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        @media (max-width: 860px) {
            .topbar__inner {
                align-items: flex-start;
                flex-direction: column;
                justify-content: center;
                padding: 16px 0;
            }

            .nav {
                width: 100%;
                justify-content: space-between;
            }

            .hero {
                grid-template-columns: 1fr;
            }

            .hero__content {
                padding: 44px 24px;
            }

            .hero__image {
                min-height: 320px;
                order: -1;
            }

            .values {
                grid-template-columns: 1fr;
            }

            .stock {
                padding: 44px 24px;
            }

            .stock__inner {
                align-items: flex-start;
                flex-direction: column;
            }

            .section-head,
            .reference-grid,
            .reference-proof {
                grid-template-columns: 1fr;
            }

            .reference-proof__item {
                border-right: 0;
                border-bottom: 1px solid var(--line);
            }

            .reference-proof__item:last-child {
                border-bottom: 0;
            }

            .modal {
                padding: 12px;
            }

            .modal__dialog {
                max-height: calc(100vh - 24px);
            }

            .modal__head,
            .modal__foot {
                align-items: flex-start;
                flex-direction: column;
            }

            .modal__controls {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    @php
        $referencias = $referencias ?? collect();
        $referenciasPayload = $referencias->map(function ($referencia) {
            $imagenes = collect(['imagen1', 'imagen2', 'imagen3', 'imagen4', 'imagen5'])
                ->map(fn ($field) => $referencia->{$field})
                ->filter()
                ->map(fn ($path) => asset('storage/' . $path))
                ->values();

            return [
                'id' => $referencia->id,
                'publicacion' => $referencia->publicacion,
                'descripcion' => $referencia->descripcion,
                'imagenes' => $imagenes,
            ];
        })->filter(fn ($referencia) => $referencia['imagenes']->isNotEmpty())->values();
    @endphp

    <header class="topbar">
        <div class="topbar__inner">
            <div class="brand">
                <span class="brand__mark">B</span>
                <span>Baldub</span>
            </div>
            <nav class="nav" aria-label="Principal">
                <a href="#empresa">Empresa</a>
                <a href="#unidades">Camiones y acoplados</a>
                <a href="#referencias">Referencias</a>
                <a href="tel:+540000000000">Llamar</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero" id="empresa">
            <div class="hero__content">
                <p class="eyebrow">Más de 30 años en el rubro</p>
                <h1>Camiones y acoplados con respaldo familiar.</h1>
                <p class="intro">
                    Somos una empresa familiar dedicada a la venta de camiones y acoplados. Nuestra historia nace del esfuerzo, la honestidad y el compromiso: la trayectoria de un padre se combina con la energía y la mirada de una nueva generación.
                </p>
                <p class="intro">
                    Trabajamos para brindar soluciones confiables a cada cliente, acompañando cada etapa con asesoramiento personalizado, claro y transparente.
                </p>

                <div class="values" aria-label="Valores de la empresa">
                    <div class="value">
                        <strong>Experiencia</strong>
                        <span>Más de tres décadas conociendo el mercado y sus necesidades.</span>
                    </div>
                    <div class="value">
                        <strong>Compromiso</strong>
                        <span>Atención cercana y seguimiento responsable en cada operación.</span>
                    </div>
                    <div class="value">
                        <strong>Transparencia</strong>
                        <span>Información clara para decidir con confianza.</span>
                    </div>
                </div>

                <div class="cta">
                    <a class="button" href="#unidades">Ver unidades</a>
                    <a class="phone" href="tel:+540000000000">Consultar por teléfono</a>
                </div>
            </div>
            <div class="hero__image" aria-hidden="true">
                <img src="{{ asset('storage/camiones/MLKNRQbXfuRqcExlrAx4Xaol1AxKxwsv86a1iYxu.jpg') }}" alt="">
            </div>
        </section>

        <section class="stock" id="unidades">
            <div class="stock__inner">
                <h2>Unidades seleccionadas para trabajar.</h2>
                <p>Camiones y acoplados evaluados con criterio comercial, datos claros y acompañamiento directo durante la compra.</p>
            </div>
        </section>

        <section class="references" id="referencias">
            <div class="references__inner">
                <div class="section-head">
                    <div>
                        <p class="eyebrow">Referencias reales</p>
                        <h2>Mirar bien también es parte de comprar mejor.</h2>
                    </div>
                    <p>
                        Cada publicación reúne imágenes para evaluar estado, detalles y presentación antes de avanzar. No mostramos una unidad como una simple foto: ordenamos la información visual para que puedas comparar, preguntar con precisión y decidir con respaldo.
                    </p>
                </div>

                <div class="reference-proof" aria-label="Como trabajamos las referencias">
                    <div class="reference-proof__item">
                        <strong>Contexto completo</strong>
                        <span>Varias tomas por publicación para revisar exterior, estructura y puntos clave sin depender de una sola imagen.</span>
                    </div>
                    <div class="reference-proof__item">
                        <strong>Decisión más clara</strong>
                        <span>Las referencias ayudan a detectar dudas temprano y llegar a la consulta con preguntas concretas.</span>
                    </div>
                    <div class="reference-proof__item">
                        <strong>Acompañamiento directo</strong>
                        <span>Si una unidad encaja con tu trabajo, seguimos la conversación con asesoramiento personalizado.</span>
                    </div>
                </div>

                @if($referenciasPayload->isNotEmpty())
                    <div class="reference-grid">
                        @foreach($referenciasPayload as $index => $referencia)
                            <article class="reference-card">
                                <button class="reference-card__media" type="button" data-reference-open="{{ $index }}" aria-label="Ver imágenes de {{ $referencia['publicacion'] }}">
                                    <img src="{{ $referencia['imagenes'][0] }}" alt="{{ $referencia['publicacion'] }}">
                                    <span class="reference-card__badge">{{ $referencia['imagenes']->count() }} imagen{{ $referencia['imagenes']->count() === 1 ? '' : 'es' }}</span>
                                </button>
                                <div class="reference-card__body">
                                    <h3>{{ $referencia['publicacion'] }}</h3>
                                    <p>{{ $referencia['descripcion'] ?: 'Referencia visual disponible para revisar la unidad con más detalle.' }}</p>
                                    <button class="reference-card__action" type="button" data-reference-open="{{ $index }}">
                                        Ver galería
                                    </button>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="references-empty">
                        Las referencias visuales se publicarán cuando haya imágenes cargadas.
                    </div>
                @endif
            </div>
        </section>
    </main>

    <div class="modal" id="reference-modal" role="dialog" aria-modal="true" aria-labelledby="reference-modal-title" aria-hidden="true">
        <div class="modal__dialog">
            <div class="modal__head">
                <div class="modal__title">
                    <strong id="reference-modal-title"></strong>
                    <span id="reference-modal-description"></span>
                </div>
                <button class="modal__close" type="button" data-modal-close aria-label="Cerrar">Cerrar</button>
            </div>
            <div class="modal__body">
                <img id="reference-modal-image" src="" alt="">
            </div>
            <div class="modal__foot">
                <div class="modal__controls">
                    <button class="modal__nav" type="button" data-modal-prev aria-label="Imagen anterior">Ant.</button>
                    <span class="modal__counter" id="reference-modal-counter"></span>
                    <button class="modal__nav" type="button" data-modal-next aria-label="Imagen siguiente">Sig.</button>
                </div>
                <div class="modal__thumbs" id="reference-modal-thumbs" aria-label="Imágenes disponibles"></div>
            </div>
        </div>
    </div>

    <script>
        const referencias = @json($referenciasPayload);
        const modal = document.getElementById('reference-modal');
        const modalTitle = document.getElementById('reference-modal-title');
        const modalDescription = document.getElementById('reference-modal-description');
        const modalImage = document.getElementById('reference-modal-image');
        const modalCounter = document.getElementById('reference-modal-counter');
        const modalThumbs = document.getElementById('reference-modal-thumbs');
        let activeReference = 0;
        let activeImage = 0;

        function renderModal() {
            const referencia = referencias[activeReference];

            if (!referencia || !referencia.imagenes.length) {
                return;
            }

            modalTitle.textContent = referencia.publicacion;
            modalDescription.textContent = referencia.descripcion || 'Referencia visual disponible para revisar la unidad con más detalle.';
            modalImage.src = referencia.imagenes[activeImage];
            modalImage.alt = referencia.publicacion + ' - imagen ' + (activeImage + 1);
            modalCounter.textContent = (activeImage + 1) + ' / ' + referencia.imagenes.length;
            modalThumbs.innerHTML = '';

            referencia.imagenes.forEach((imagen, index) => {
                const button = document.createElement('button');
                const thumb = document.createElement('img');

                button.type = 'button';
                button.className = 'modal__thumb' + (index === activeImage ? ' is-active' : '');
                button.setAttribute('aria-label', 'Ver imagen ' + (index + 1));
                button.addEventListener('click', () => {
                    activeImage = index;
                    renderModal();
                });

                thumb.src = imagen;
                thumb.alt = '';
                button.appendChild(thumb);
                modalThumbs.appendChild(button);
            });
        }

        function openModal(referenceIndex) {
            activeReference = Number(referenceIndex);
            activeImage = 0;
            renderModal();
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        function moveImage(direction) {
            const referencia = referencias[activeReference];

            if (!referencia || !referencia.imagenes.length) {
                return;
            }

            activeImage = (activeImage + direction + referencia.imagenes.length) % referencia.imagenes.length;
            renderModal();
        }

        document.querySelectorAll('[data-reference-open]').forEach((button) => {
            button.addEventListener('click', () => openModal(button.dataset.referenceOpen));
        });

        document.querySelector('[data-modal-close]').addEventListener('click', closeModal);
        document.querySelector('[data-modal-prev]').addEventListener('click', () => moveImage(-1));
        document.querySelector('[data-modal-next]').addEventListener('click', () => moveImage(1));

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (!modal.classList.contains('is-open')) {
                return;
            }

            if (event.key === 'Escape') {
                closeModal();
            }

            if (event.key === 'ArrowLeft') {
                moveImage(-1);
            }

            if (event.key === 'ArrowRight') {
                moveImage(1);
            }
        });
    </script>
</body>
</html>
